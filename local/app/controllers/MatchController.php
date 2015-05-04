<?php

class MatchController extends BaseController {
    protected $layout = 'layouts.master';
	
	public function showLive($match_id)
	{
		$Match = new Match($match_id);
		$MyUser = new MyUser();
		$Team = new Team($MyUser->get_team_id());
		$team_tactic_players = $Team->get_tactic_players();
		
		$players_pos_name = array();
		foreach($team_tactic_players as $pl)
		{
			if($pl->player_id != NULL)
				$players_pos_name[$pl->player_id] = $pl->pos_no_name;
		}
		
		$score = $Match->get_score();
		
		View::share('team_players', $Team->get_players());
		View::share('team_tactic_players', $team_tactic_players);
		View::share('players_pos_name', $players_pos_name);
		View::share('Match', $Match);
		View::share('home_goals', $score[1]);
		View::share('away_goals', $score[2]);
		
		if(!$Match->finish())
		{
			$this->layout->title = "Vizualizarea meciului";
			$this->layout->content = View::make('pages.match_split');
		}
		else
		{
			$this->layout->title = "Vizualizarea meciului";
			$this->layout->content = View::make('pages.match_result');
		}
	}
}
