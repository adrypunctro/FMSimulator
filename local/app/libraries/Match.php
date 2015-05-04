<?php
define('MATCH_MIN_RATIO', 4);

class Match {
	private $match_id;
	
	public function __construct($match_id)
	{
		$this->match_id = $match_id;
	}
	
	// returneaza numarul de minute trecute de la  -----------
	// inceputul partidei (minute reale)
	public function get_min()
	{
		$start_hour = DB::table('matches')
			->where('match_id', $this->match_id)
			->where('date', date('Y-m-d'))
			->pluck('hour');
		
		$firstTime = strtotime($start_hour);
		$lastTime = strtotime(date('H:i'));
		$timeDiff = $lastTime - $firstTime;

		return $timeDiff/60;
	}
	// ------------------------------------------------------
	
	// returneaza scorul final ------------------------------
	public function get_score()
	{
		$arr = DB::table('matches')
			->select('home_goals', 'away_goals')
			->where('match_id', $this->match_id)
			->first();

		return array(1=>$arr->home_goals,2=>$arr->away_goals);
	}
	// ------------------------------------------------------
	
	
	// genereaza timeline-ul --------------------------------
	public function generateTimeline()
	{
		// simuleaza meciul
		$timeline = $this->simMatch($this->match_id,1);
		
		// adauga in baza de date
		$this->save_live($timeline);
		
	}
	// ------------------------------------------------------
	
	// salveaza rezultatul meciului -------------------------
	public function saveResult()
	{
		$timeline = $this->getTimeline();
		
		if($timeline !== -1)// -1(nu exista timeline)
		{
			$timeline = json_decode($timeline);
			
			// extrage rezultatul
			$last_min = end($timeline);
			$home_goals=$last_min->score->{1};
			$away_goals=$last_min->score->{2};
			
			// salveaza rezultatul
			DB::table('matches')
			->where('match_id', $this->match_id)
			->update(array('home_goals'=>$home_goals,'away_goals'=>$away_goals));
			
			// sterge timeline-ul
			DB::table('matches_live')
			->where('match_id', $this->match_id)
			->delete();
			
			// TODO: salveaza statistica jucatorilor
			
			// salveaza punctele in competitie
			$arr = DB::table('matches')
			->select('team_id1', 'team_id2')
			->where('match_id', $this->match_id)
			->first();
			
			$home_arr = DB::table('competitions_table')
			->where('competition_id', Match::matchid2compid($this->match_id))
			->where('team_id', $arr->team_id1)
			->first();
			
			DB::table('competitions_table')
			->where('competition_id', $home_arr->competition_id)
			->where('team_id', $home_arr->team_id)
			->update(array(
				'pld'=>($home_arr->pld+1),
				'won'=>($home_arr->won+(($home_goals>$away_goals)?1:0)),
				'drn'=>($home_arr->drn+(($home_goals==$away_goals)?1:0)),
				'lst'=>($home_arr->lst+(($home_goals<$away_goals)?1:0)),
				'for'=>($home_arr->{'for'}+$home_goals),
				'ag'=>($home_arr->ag+$away_goals),
				'pts'=>($home_arr->pts+(($home_goals>$away_goals)?3:(($home_goals==$away_goals)?1:0)))
			));
			
			$away_arr = DB::table('competitions_table')
			->where('competition_id', Match::matchid2compid($this->match_id))
			->where('team_id', $arr->team_id2)
			->first();
			
			DB::table('competitions_table')
			->where('competition_id', $away_arr->competition_id)
			->where('team_id', $away_arr->team_id)
			->update(array(
				'pld'=>($away_arr->pld+1),
				'won'=>($away_arr->won+(($away_goals>$home_goals)?1:0)),
				'drn'=>($away_arr->drn+(($away_goals==$home_goals)?1:0)),
				'lst'=>($away_arr->lst+(($away_goals<$home_goals)?1:0)),
				'for'=>($away_arr->{'for'}+$away_goals),
				'ag'=>($away_arr->ag+$home_goals),
				'pts'=>($away_arr->pts+(($away_goals>$home_goals)?3:(($away_goals==$home_goals)?1:0)))
			));
			
			// adauga in baza de date
			$this->save_live($this->match_id, $timeline);
		}
	}
	// ------------------------------------------------------
	
	// returneaza timeline-ul meciului ----------------------
	// timeline-ul din baza de date
	public function getTimeline()
	{
		$count = DB::table('matches_live')
			->where('match_id', $this->match_id)
			->count();
		
		if($count == 0)
			return -1;// nu exista timeline
		
		return DB::table('matches_live')
			->where('match_id', $this->match_id)
			->pluck('timeline');
		
	}
	// ------------------------------------------------------
	
	public function finish()
	{
		$home_goals = DB::table('matches')
			->where('match_id', $this->match_id)
			->pluck('home_goals');
		
		return ($home_goals !== NULL);
	}
	
	private function save_live($timeline)
	{
		// previnem insertul daca meciul a fost salvat
		if($this->finish())
			return false;
		
		// Verificam daca exista pentru insert/update
		$count = DB::table('matches_live')
			->where('match_id', $this->match_id)
			->count();
		
		if($count == 0)
		{
			// insert
			DB::table('matches_live')
			->insert(array('match_id'=>$this->match_id,'timeline'=>json_encode($timeline)));
		}
		else
		{
			// update
			DB::table('matches_live')
			->where('match_id', $this->match_id)
			->update(array('timeline'=>json_encode($timeline)));
		}
	}
	
		// simuleaza tot meciul
	// si returneaza un desfasurator
	private function simMatch($match_id, $min_start)
	{
		// minutul => array(id jucator => optiune (1-gol,2-assist,3-red,4-yellow))
		$timeline = array();
		for($i=1;$i<=93;++$i)
			$timeline[$i] = array('score'=>array(),'event'=>array());
		
		$team1_score=0;
		$team2_score=0;
		
		// simulam meciul
		foreach($timeline as $min => $even)
		{
			$team1_goal=false;
			$team2_goal=false;
			if(mt_rand(1,5) == 1)// sansele sa se intample un eveniment
			{
				$who_player = mt_rand(1,16);// ce jucator
				$who_sit = mt_rand(1,4);// ce situatie (1-sansa de gol,2-penalty,3-lovitura libera,4-sansa de corner)
				switch($who_sit)
				{
					case 1: $succ = mt_rand(1,6); break;// rata de succes
					case 2: $succ = mt_rand(1,2); break;// rata de succes
					case 3: $succ = mt_rand(1,5); break;// rata de succes
					case 4: $succ = mt_rand(1,8); break;// rata de succes
				}
				// save event
				$timeline[$min]['event'][$who_player][$who_sit] = ($succ == 1);
				
				$team1_goal = (in_array($who_player, array(1,2,3,4,5,6,7,8,9,10,11)) && ($succ == 1));
				$team2_goal = (in_array($who_player, array(12,13,14,15,16)) && ($succ == 1));
			}
			$team1_score = ($team1_goal) ? ++$team1_score : $team1_score;
			$team2_score = ($team2_goal) ? ++$team2_score : $team2_score;
			
			$timeline[$min]['score'][1] = $team1_score;
			$timeline[$min]['score'][2] = $team2_score;
		}
		
		return $timeline;
	}
	
	
	// Static metods --------------------------------------
	
	// returneaza meciurile din ziua curenta --------------
	public static function today_matches()
	{
		return DB::table('matches')
			->select('match_id')
			->where('date', date('Y-m-d'))
			->get();
	}
	// ------------------------------------------------------
	
	
	// transformarea minutelor reale in minute de joc -------
	public static function min2mmin($min)
	{
		return $min*MATCH_MIN_RATIO;
  	}
	// ------------------------------------------------------
	
	// transformarea minutelor reale in minute de joc -------
	public static function matchid2compid($match_id)
	{
		return DB::table('matches')
			->select('competition_id')
			->join('competitions_rounds', 'competitions_rounds.round_id', '=', 'matches.round_id')
			->where('match_id', $match_id)
			->pluck('competition_id');
  	}
	// ------------------------------------------------------
}