<?php

class TeamController extends BaseController {
    protected $layout = 'layouts.master';
	
	public function showPlayers()
	{
    	$this->layout->title = "Jucatorii Echipe 1";
		$this->layout->content = View::make('pages.team_players');
	}
	
	public function showTactics()
	{
		$MyUser = new MyUser();
		$Team = new Team($MyUser->get_team_id());
		$team_tactic_players = $Team->get_tactic_players();
		
		$players_pos_name = array();
		foreach($team_tactic_players as $pl)
		{
			if($pl->player_id != NULL)
				$players_pos_name[$pl->player_id] = $pl->pos_no_name;
		}
		
		View::share('team_players', $Team->get_players());
		View::share('team_tactic_players', $team_tactic_players);
		View::share('players_pos_name', $players_pos_name);
		
    	$this->layout->title = "Tactica Echipe 1";
		$this->layout->content = View::make('pages.team_tactics');
	}
	
	// Asigneaza jucatorului o pozitie
	public function tacticAssignPlayer()
	{
		$data = Input::all();
		if(Request::ajax())
		{
			$new_pos_no = Input::get('pos_no');// noua pozitie
			$player_id = Input::get('player_id');
			
			$MyUser = new MyUser();
			$Team = new Team($MyUser->get_team_id());
			
			// Asigneaza playerul pe noua pozitie
			$Team->tactic_assign($player_id, $new_pos_no);
			
			return Response::json( array('status' => 'success') );
		}
	}
	
	// Actualizeaza meniul drop down de la asignarea jucatorilor
	public function updateTacticsDropDownMenu()
	{
		if(Request::ajax())
		{
			$MyUser = new MyUser();
			$Team = new Team($MyUser->get_team_id());
			$team_tactic_players = $Team->get_tactic_players();
			
			$html_content = '';
			
			$html_content .= '<li pos_no="0" pos_no_name="-">-</li>';
            
			foreach($team_tactic_players as $pos)
            	$html_content .= '<li pos_no="'.$pos->pos_no.'" pos_no_name="'.$pos->pos_no_name.'">'.$pos->pos_no_name.' - '.$pos->player_name.'</li>';
            
			
			$response = array(
				'status' => 'success',
				'msg' => $html_content,
			);
		
			return Response::json( $response );
		}
	}
	
	// actualizeaza tactica
	public function updateTactics()
	{
		if(Request::ajax())
		{
			$MyUser = new MyUser();
			$Team = new Team($MyUser->get_team_id());
			$players = $Team->get_tactic_players();
			$i_start = 10;
			
			// Extrage numarul de jucatori de pe fiecare linie
			$poss = $Team->get_tactic_lines_poss();
			
			// [pos_i] => [key] // daca exista pozitia
			// [pos_i] => 0 // daca nu exista pozitia
			$map_arr = array();
			for($i=1; $i<=26; $i++)
			{
				$map_arr[$i] = false;
			
				foreach($players as $k => $row)
				{
					if($row->pos_no == $i)
						$map_arr[$i] = $k;
				}
			}
			
			$label = array();
			$label[26] = 'F';
			$label[21] = 'AM';
			$label[16] = 'M';
			$label[11] = 'DM';
			$label[6]  = 'D';
			$label[1]  = 'GK';
			
			
			$html_content = '';
			for($i=26; $i>=1; $i--)
			{
				// Html code
				if(in_array($i, array(21,16,11,6,1)))
					$html_content .= '</ul></li>';
				if(in_array($i, array(26,21,16,11,6,1)))
					$html_content .= '<li class="'.$label[$i].'"><ul>';
				
				// clasa: on-jucator asignat, unset-pozitie neasignata, off-pozitie indisponibila
				$class=($map_arr[$i]!==false)?(($players[$map_arr[$i]]->player_id != NULL)?'on':'unset'):'off';
				
				// Eticheta pozitiei
				$name=($players[$map_arr[$i]]->player_id != NULL)?$players[$map_arr[$i]]->player_name:$players[$map_arr[$i]]->pos_no_name;

				// Html code
				$html_content .= '<li class="'.$class.'"><div class="pos"><div class="icon">'.$i.'</div><span class="name">'.$name.'</span></div></li>';
			
				// Html code
				if($i==1)
					$html_content .= '</ul></li>';
			}
			
			$response = array(
				'status' => 'success',
				'msg' => $html_content,
			);
		
			return Response::json( $response );
		}	
	}
}
