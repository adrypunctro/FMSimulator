<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'IndexController@showDashboard');
Route::get('team/{team_id}/players', 'TeamController@showPlayers')->where('team_id', '[0-9]+');
Route::get('team/{team_id}/tactics', 'TeamController@showTactics')->where('team_id', '[0-9]+');
Route::get('team/{team_id}/', 'TeamController@showTactics')->where('team_id', '[0-9]+');
Route::get('match/{match_id}/', 'MatchController@showLive')->where('match_id', '[0-9]+');

Route::post('team', 'TeamController@updateTactics');
Route::post('tactic_assign_player', 'TeamController@tacticAssignPlayer');
Route::post('tactic_dropdown_update', 'TeamController@updateTacticsDropDownMenu');

// Cron --------------------------------
Route::get('cron/generatematchtimeline', 'CronController@generateMatchTimeline');// Inainte de meciuri: 17:00
Route::get('cron/savematchresult', 'CronController@saveMatchResult');// Dupa meciuri: 20:00
Route::get('cron/resetseason', 'CronController@resetSeason');// La inceputul sezonului

