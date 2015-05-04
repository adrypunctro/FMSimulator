<?php

class Team {
	
	public $team_id;
	public $current_match_index;
	
	function __construct($team_id)
	{
		$this->team_id = $team_id;
		$this->current_match_index = NULL;
	}
	
	public function get_fixtures()
	{
		$table_row = DB::table('matches')
			->select('matches.*','competitions.competition_id','competitions.name AS competitions_name')
			->join('competitions_rounds', 'matches.round_id', '=', 'competitions_rounds.round_id')
			->join('competitions', 'competitions_rounds.competition_id', '=', 'competitions.competition_id')
			->where('team_id1', $this->team_id)
			->orWhere('team_id2', $this->team_id)
			->orderBy('date', 'asc')
			->get();
		
		$current = 0;
		foreach($table_row as $k => $v)
		{
			$table_row[$k]->side = ($v->team_id1 == $this->team_id) ? 'H' : 'A';
			$table_row[$k]->team_name1 = DB::table('teams')->where('team_id', $v->team_id1)->pluck('name');
			$table_row[$k]->team_name2 = DB::table('teams')->where('team_id', $v->team_id2)->pluck('name');
			
			$dt = new DateTime($v->date);
			
			// Calculeaza diferenta in zile si data detaliata
			$dDiff = $dt->diff(new DateTime(date('Y-m-d')));
			$table_row[$k]->date_long = $dt->format('l jS F Y');
			$table_row[$k]->date_long .= ' ('.($v->date == date('Y-m-d')?'Today':(($dDiff->days==1)?'Tomorrow':$dDiff->days.' days')).')';
			
			// Scorul meciului / sau data
			$table_row[$k]->score = ($v->home_goals == NULL) ? $dt->format('d.m') : $v->home_goals.':'.$v->away_goals;
			
			// current match
			if($v->home_goals == NULL && $this->current_match_index === NULL)
				$this->current_match_index = $k;
		}
		
		return $table_row;
	}
	
	public function get_players()
	{
		$table_row = DB::table('players_contracts')
			->join('players', 'players_contracts.player_id', '=', 'players.player_id')
			->where('team_id', $this->team_id)
			->get();
		
		return $table_row;
	}
	
	// returneaza pozitiile pe tactica si jucatorii asignati
	public function get_tactic_players()
	{
		$ttactic_id = DB::table('teams_tactics')->where('team_id', $this->team_id)->pluck('ttactic_id');
		
		$table_row = DB::table('teams_tactics_assign')
			->select('teams_tactics_assign.*', 'players.name AS player_name', 'tactics_pos_no.name AS pos_no_name')
			->join('tactics_pos_no', 'teams_tactics_assign.pos_no', '=', 'tactics_pos_no.pos_no')
			->leftJoin('players', 'teams_tactics_assign.player_id', '=', 'players.player_id')
			->where('ttactic_id', $ttactic_id)
			->orderBy('pos_no', 'asc')
			->get();
		
		return $table_row;
	}
	
	public function get_tactic_lines_poss()
	{
		$tactic_id = DB::table('teams_tactics')->where('team_id', $this->team_id)->pluck('tactic_id');
		
		$table_row = DB::table('tactics')
			->where('tactic_id', $tactic_id)
			->first();
		
		$poss = array();
		$poss[0] = $table_row->F;
		$poss[1] = $table_row->AM;
		$poss[2] = $table_row->M;
		$poss[3] = $table_row->DM;
		$poss[4] = $table_row->D;
		$poss[5] = $table_row->GK;
		
		return $poss;
	}
	
	// returneaza pos_no a player-ului cu id-ul = x
	private function get_tactic_player_pos_no($player_id)
	{
		$ttactic_id = DB::table('teams_tactics')->where('team_id', $this->team_id)->pluck('ttactic_id');
		
		$pos_no = DB::table('teams_tactics_assign')
					->where('player_id', $player_id)
					->where('ttactic_id', $ttactic_id)
					->pluck('pos_no');
		
		return $pos_no;
	}
	
	// Returneaza id-ul player-ului care se afla pe pos_no = x
	private function get_tactic_player_id($pos_no)
	{
		$ttactic_id = DB::table('teams_tactics')->where('team_id', $this->team_id)->pluck('ttactic_id');
		
		$player_id = DB::table('teams_tactics_assign')
					->where('pos_no', $pos_no)
					->where('ttactic_id', $ttactic_id)
					->pluck('player_id');
		
		return $player_id;
	}
	
	// Interschimba locul celor doi jucatori
	private function tactic_assign_change($player_id, $pos_no, $player_id2, $pos_no2)
	{
		$ttactic_id = DB::table('teams_tactics')->where('team_id', $this->team_id)->pluck('ttactic_id');
		
		if($pos_no != NULL)
		{
			DB::table('teams_tactics_assign')
				->where('pos_no', $pos_no)
				->where('ttactic_id', $ttactic_id)
				->update(array('player_id' => $player_id2));
		}
		
		DB::table('teams_tactics_assign')
			->where('pos_no', $pos_no2)
			->where('ttactic_id', $ttactic_id)
			->update(array('player_id' => $player_id));
		
	}
	
	// asigneaza o pozitie unui jucator
	public function tactic_assign($player_id, $pos_no2)
	{
		// vechea pozitie
		$pos_no = $this->get_tactic_player_pos_no($player_id);
		
		if($pos_no2 != $pos_no)
		{
			$player_id2 = $this->get_tactic_player_id($pos_no2);
			
			$this->tactic_assign_change($player_id, $pos_no, $player_id2, $pos_no2);
		}
	}
}