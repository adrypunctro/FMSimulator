@section('content')
    <section class="next_match">
        <div class="content">
            <header>
                <h1>Next Match: {{ ($current_match_index !== NULL) ? $get_fixtures[$current_match_index]->date_long : '-' }}</h1>
            </header>
            <section class="next_adv"{{ ($current_match_index === NULL) ? ' style="visibility:hidden"' : '' }}>
                <ul>
                    <li class="math_team_logos">
                        <a class="home_team" href="{{ URL::to('team/'.$get_fixtures[$current_match_index]->team_id1.'/') }}">
                            <img src="assets/images/no_logo.png" height="16">
                        </a>
                        <a href="{{ URL::to('match/1') }}" class="vs">VS</a>
                        <a class="away_team" href="{{ URL::to('team/'.$get_fixtures[$current_match_index]->team_id2.'/') }}">
                            <img src="assets/images/no_logo.png" height="16">
                        </a>
                    </li>
                    <li class="competitia"><a class="links_competition" href="{{ URL::to('competition/1/table') }}">{{ $get_fixtures[$current_match_index]->competitions_name }}</a></li>
                    <li class="math_team">
                        <a class="links_team {{ ($get_fixtures[$current_match_index]->side == 'H')?'owner':'' }}" href="{{ URL::to('team/'.$get_fixtures[$current_match_index]->team_id1.'/') }}">{{ $get_fixtures[$current_match_index]->team_name1 }}</a>
                        vs
                        <a class="links_team {{ ($get_fixtures[$current_match_index]->side == 'A')?'owner':'' }}" href="{{ URL::to('team/'.$get_fixtures[$current_match_index]->team_id2.'/') }}">{{ $get_fixtures[$current_match_index]->team_name2 }}</a>
                    </li>
                    <li class="weather"><span class="hour">{{ $get_fixtures[$current_match_index]->hour }},</span><img src="{{ URL::to('/assets/images//weather_icons-'.$get_fixtures[$current_match_index]->weather.'.png') }}" height="16"><span>Dry {{ $get_fixtures[$current_match_index]->temperature }}&deg;C</span></li>
                 </ul>
            </section>
            <section class="fixtures">
                <div class="fix_margin">
                    <ul>
                    	@foreach($get_fixtures as $k => $row)
                        <li class="{{ ($current_match_index == $k) ? 'current' : '' }}">
                            <span class="col c1"><a href="{{ URL::to('match/'.$row->match_id) }}">{{ $row->score }}</a></span>
                            <span class="col c2" title="{{ $row->side == 'H' ? 'Home' : 'Away' }}">{{ $row->side }}</span>
                            <span class="col c3"><img src="assets/images/no_logo.png" height="16"><a class="links_team" href="{{ URL::to('team/'.(($row->side == 'H')?$row->team_id2:$row->team_id1).'/') }}">{{ ($row->side == 'H')?$row->team_name2:$row->team_name1 }}</a></span>
                            <a class="col c4">{{ $row->competitions_name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </section>
    <section class="league">
        <div class="content">
            <header>
                <h1>Clasament</h1>
            </header>
            <ul class="league_table_h">
                <li>
                    <span class="col c1">Pos</span>
                    <span class="col c2">Team</span>
                    <span class="col c3">P</span>
                    <span class="col c4">W</span>
                    <span class="col c5">D</span>
                    <span class="col c6">L</span>
                    <span class="col c7">GD</span>
                    <span class="col c8">Pts</span>
                </li>
             </ul>
             <ul class="league_table">
             	@foreach ($league_table as $i => $row)
                <li class="{{ ($my_team_id == $row->team_id) ? 'owner' : '' }}">
                    <span class="col c1">{{ $row->pos }}</span>
                    <span class="col c2"><a class="links_team" href="{{ URL::to('team/'.$row->team_id.'/') }}" onclick="return false;">
                        <img src="assets/images/no_logo.png" height="16">
                        {{ $row->name  }}
                    </a></span>
                    <span class="col c3">{{ $row->pld }}</span>
                    <span class="col c4">{{ $row->won }}</span>
                    <span class="col c5">{{ $row->drn }}</span>
                    <span class="col c6">{{ $row->lst }}</span>
                    <span class="col c7">{{ $row->for - $row->ag }}</span>
                    <span class="col c8">{{ $row->pts }}</span>
                </li>
                @endforeach
                <?php /*foreach($league_table as $i):
                $class='';

                if($i==2)
                    $class .= ' owner';
                
                if($i<=4)
                    $class .= ' promotes';
                if($i>=17)
                    $class .= ' demotes';
                ?>
                <li class="<?php echo $class;?>">
                    <span class="col c1"><?php echo $i;?></span>
                    <span class="col c2"><a href="{{ URL::to('team/1/players') }}">
                        <img src="assets/images/no_logo.png" height="16">
                        <?php echo 'Echipa '.$i;?>
                    </a></span>
                    <span class="col c3">00</span>
                    <span class="col c4">00</span>
                    <span class="col c5">00</span>
                    <span class="col c6">00</span>
                    <span class="col c7">00</span>
                    <span class="col c8">00</span>
                </li>
                <?php endforeach;*/ ?>
            </ul>
        </div>
    </section>
    <section class="sec1">
        <div class="content">
            <header>
                <h1></h1>
            </header>
        </div>
    </section>
    <section class="sec2">
        <div class="content">
            <header>
                <h1></h1>
            </header>
        </div>
    </section>
@stop