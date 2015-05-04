<?php

class Player {
	
	
	
	
	
	public function get_team()
	{
		$table_row = DB::table('competitions_table')
			->join('teams', 'competitions_table.team_id', '=', 'teams.team_id')
			->where('competition_id', 1)
			->orderBy('competitions_table.pos', 'asc')
			->get();
		
		return $table_row;
	}
}