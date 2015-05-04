<?php

class IndexController extends BaseController {
	protected $layout = 'layouts.master';

	public function showDashboard()
	{
		$MyUser = new MyUser();
		$League = new League();
		$Team = new Team($MyUser->get_team_id());
		$get_fixtures = $Team->get_fixtures();
		
		View::share('current_match_index', $Team->current_match_index);
		View::share('get_fixtures', $get_fixtures);
		View::share('my_team_id', $MyUser->get_team_id());
		View::share('league_table', $League->get_table());
		
		$this->layout->title = "Simulator de Fotbal Manager";
		$this->layout->content = View::make('pages.dashboard');
	}

}
