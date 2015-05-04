<?php

class CronController extends BaseController {

	public function generateMatchTimeline()
	{
		foreach(Match::today_matches() as $m)// parcurge toate meciurile din ziua curenta
		{
			$match = new Match($m->match_id);
			$match->generateTimeline();
			unset($match);
		}
	}
	
	public function saveMatchResult()
	{
		foreach(Match::today_matches() as $m)// parcurge toate meciurile din ziua curenta
		{
			$match = new Match($m->match_id);
			$match->saveResult();
			unset($match);
		}
		
		// TODO: actualizarea pozitiei in clasament
		
	}
	
	public function resetSeason()
	{
		$Fixture = new Fixture();
		
		// Salveaza toate informatiile ---------------------------------
		
		// -------------------------------------------------------------
		
		// Resetare competitii -----------------------------------------
		
		// -------------------------------------------------------------
		
		// Calculare programa ------------------------------------------
		$LE = array();
		$CU = array();
		$CL = array();
		$BR = array();
		$SC = array();
		$SE = array();
		foreach($Fixture->scheme() as $r)
		{
			switch($r->competition)
			{
				case 'LE': $LE[] = $r->day;
				case 'CU': $CU[] = $r->day;
				case 'CL': $CL[] = $r->day;
				case 'BR': $BR[] = $r->day;
				case 'SC': $SC[] = $r->day;
				case 'SE': $SE[] = $r->day;
			}
		}
		
		$teams = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18);
		
		print '<pre>';
		var_export($this->calcProgramLE($teams));
		print '</pre>';
		// -------------------------------------------------------------
	}
	
	// calculeaza etapele pentru liga si le returneaza sub forma:
	/*
	array (
	  0 => 
	  array (
		1 => 2,
		3 => 4,
	  ),
	  1 => 
	  array (
		2 => 1,
		4 => 3,
	  ), ...
	 */
	private function calcProgramLE($teams)
	{
		$matches = array();
		$c=0;
		foreach($teams as $i => $t1)
		{
			foreach($teams as $j => $t2)
			{
				if($i == $j)
					continue;
				
				$matches[] = array($t1, $t2);
			}
		}
		
		$total_rounds = (count($teams)-1)*2;
		$match_per_round = floor(count($teams)/2);
		$rounds = array();
		$e=0;
		
		while($e < $total_rounds && count($matches) > 0)
		{
			// Cautam runda curenta
			$rounds[$e] = array();
			$this->recFixRoundLE($matches, $rounds[$e], $match_per_round);
			
			// stergem meciurile din runda curenta
			foreach($rounds[$e] as $t1 => $t2)
			{
				foreach($matches as $k => $m)
				{
					
					if($t1 == $m[0] && $t2 == $m[1])
					{
						unset($matches[$k]);
					}
				}
			}
			
			// Trecem la urmatoarea runda
			++$e;
		}
		
		// Stabileste pentru fiecare echipa cand joaca acasa si cand in deplasare
		$place_teams=array();
		foreach($rounds as $e => $matches)
		{
			foreach($matches as $t1 => $t2)
			{
				$place_teams[$t1][$e] = 'H';
				$place_teams[$t2][$e] = 'A';
			}
		}
		
		$perechi_list = array();
		$perechi_items = array_keys($rounds);
		foreach($perechi_items as $it1)
		{
			foreach($perechi_items as $it2)
			{
				if($it1 == $it2)
					continue;
				$perechi_list[] = array($it1, $it2);
			}
		}
		
		// Calculeaza costul pentru primul element
		$max_i=0;
		$max_v=0;
		foreach($perechi_list as $k => $pereche)
		{
			$place = '';
			$costs = array();
			foreach($teams as $t1)
			{
				$costs[$t1]=0;
				$place = '';
				foreach($pereche as $e)
				{
					if($place_teams[$t1][$e] != $place)
					{
						++$costs[$t1];
						$place = $place_teams[$t1][$e];
					}
				}
			}
			
			$cost_total = array_sum($costs);
			if($max_v < $cost_total)
			{
				$max_i=$k;
				$max_v=$cost_total;
			}
		}

		// Construieste ordinea
		$sablon = $perechi_list[$max_i];
		while(count($sablon) < count($perechi_items))
		{
			$max_i=0;
			$max_v=0;
			foreach($perechi_list as $k => $pereche)
			{
				
				if($pereche[0] != $sablon[count($sablon)-1] || in_array($pereche[1], $sablon))
					continue;
				
				$place = '';
				$costs = array();
				foreach($teams as $t1)
				{
					$costs[$t1]=0;
					$place = '';
					foreach($pereche as $e)
					{
						if($place_teams[$t1][$e] != $place)
						{
							++$costs[$t1];
							$place = $place_teams[$t1][$e];
						}
					}
				}
					
				$cost_total = array_sum($costs);
				if($max_v < $cost_total)
				{
					$max_i=$k;
					$max_v=$cost_total;
				}
			}
			$sablon[] = $perechi_list[$max_i][1];
		}
		
		// Ordonarea etapelor
		$rounds_ordered = array();
		foreach($sablon as $e)
			$rounds_ordered[] = $rounds[$e];
		
		return $rounds_ordered;
	}
	
	
	// Functie recursiva folosita pentru generarea roundelor ligii -----
	private function recFixRoundLE($matches, &$rounds, $match_per_round)
	{
		if(count($rounds) == $match_per_round)// solution
			return;
		
		// parcurge tot
		foreach($matches as $k => $m)
		{
			if(!array_key_exists($m[0], $rounds) && !in_array($m[0], $rounds) 
			&& !array_key_exists($m[1], $rounds) && !in_array($m[1], $rounds))
			{
				$rounds[$m[0]] = $m[1];
				// continue
				$this->recFixRoundLE($matches, $rounds, $match_per_round);
			}
		}
		
		if(count($rounds) < $match_per_round)
		{
			// cautam meciul care lipseste
			$teams = array();
			foreach($matches as $m)
				$teams[$m[0]]=true;
			$break=false;
			foreach($teams as $t1 => $bool)
			{
				if(!array_key_exists($t1, $rounds) && !in_array($t1, $rounds))
				{
					var_export($rounds);
					echo $t1.'+';
					foreach($matches as $k => $m)
					{
						if($m[0] == $t1)
						{
							// schimba meciul
							reset($matches);
							$first_key = key($matches);
							$t = $matches[$first_key];
							unset($matches[$first_key]);
							print 'add '.$first_key.'<br />';// TODO: TREBUIE ADAUGA ELEMENTUL LA INCEPUT
							$this->array_unshift_assoc($matches, $first_key, $t);
							$break=true;
						}
						if($break)
							break;
					}
				}
				if($break)
					break;
			}
			$rounds = array();
			$this->recFixRoundLE($matches, $rounds, $match_per_round);
		}
	}
	// -----------------------------------------------------------------
	 
	private function array_unshift_assoc(&$arr, $key, $val) 
	{ 
		$arr = array_reverse($arr, true); 
		$arr[$key] = $val; 
		$arr = array_reverse($arr, true); 
		return count($arr); 
	}
	
	private function recPermute($items, &$perms, $temp = array( ))
	{
		if (empty($items))
			$perms[] = $temp;
		else
			for ($i=count($items)-1; $i>=0; --$i)
			{
				 $newitems = $items;
				 $newperms = $temp;
				 list($foo) = array_splice($newitems, $i, 1);
				 array_unshift($newperms, $foo);
				 $this->recPermute($newitems, $perms, $newperms);
			 }
	}
}
