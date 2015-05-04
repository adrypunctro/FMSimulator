<?php

class Fixture {
	
	function __construct()
	{

	}
	
	public function scheme()
	{
		return DB::table('fix_scheme')
			->orderBy('day', 'asc')
			->get();
	}
}