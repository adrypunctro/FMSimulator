<?php

class MyUser {
	
	private $team_id;
	
	function __construct()
	{
		$this->team_id = 1;
	}
	
	public function get_team_id()
	{
		return $this->team_id;
	}
}