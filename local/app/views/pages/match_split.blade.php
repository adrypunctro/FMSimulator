@section('content')
	<section id="score_bar_live">
    	<section class="home">
        	<div class="inside">
                <header>
                    <h1>Echipa A</h1>
                </header>
            </div>
        </section>
        <div class="score">
        	<div class="inside">
            	<div class="home_goals">{{ $home_goals }}</div>
                <div class="time"><?php echo Match::min2mmin($Match->get_min());?>&prime;</div>
                <div class="away_goals">{{ $away_goals }}</div>
            </div>
        </div>
        <section class="away">
        	<div class="inside">
                <header>
        			<h1>Echipa B</h1>
                </header>
            </div>
        </section>
    </section>
    <section id="message_bar">
    	<div class="inside">
        	<span class="message">-</span>
        </div>
    </section>
    <section class="match_stats_players">
        <div class="content">
            <header>
                <h1>Players Ratings</h1>
            </header>
            <ul class="table_h">
                <li>
                    <span class="col c1">No.</span>
                    <span class="col c2">C</span>
                    <span class="col c3">Name</span>
                    <span class="col c4">Inf.</span>
                    <span class="col c5">Con</span>
                    <span class="col c6">Rat</span>
                    <span class="col c7">Gls</span>
                </li>
             </ul>
             <ul class="table">
                @foreach($team_players as $row)
                <li>
                    <span class="col c1">10</span>
                    <span class="col c2">&nbsp;</span>
                    <span class="col c3">{{ $row->name }}</span>
                    <span class="col c4">&nbsp;</span>
                    <span class="col c5">100</span>
                    <span class="col c6">6</span>
                    <span class="col c7">&nbsp;</span>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="match_terrain">
        <div class="content">
            <header>
                <h1>Terrain</h1>
            </header>
            <div class="grass_zone">
            	<div class="field">
                	<div class="whiteline top_small_box"></div>
                    <div class="whiteline top_large_box"></div>
                	<div class="whiteline top_circ_box"></div>
                	<div class="whiteline mid_line"></div>
                    <div class="whiteline mid_circ"></div>
                    <div class="whiteline down_small_box"></div>
                    <div class="whiteline down_large_box"></div>
                	<div class="whiteline down_circ_box"></div>
                    <div class="whiteline corner_1"></div>
                    <div class="whiteline corner_2"></div>
                    <div class="whiteline corner_3"></div>
                    <div class="whiteline corner_4"></div>
                	<ul class="lines">
                    	<!-- ajax content -->
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <script>
	var messages = new Array();
	messages[1] = 'Faza de gol';
	messages[2] = 'Penalty';
	messages[3] = 'Lovitura libera';
	messages[4] = 'Corner';
	var succ_messages = new Array();
	succ_messages[1] = 'Goooooooooooool!!!';
	succ_messages[2] = 'Ratare.';
	
	// initializarea timeline-ului
	var timeline = new Array();
	for(i=1; i<=93; ++i)
		timeline[i] = new Array();
	
	
	var time_min = <?php echo Match::min2mmin($Match->get_min());?>;
	var time_countdown = setInterval(function () {
		++time_min;
		// Actualizeaza harta
		$('.score > .inside > .time').html(time_min+'&prime;');
		$('#message_bar > .inside > .message').html('X');
		
	},60000/<?php echo MATCH_MIN_RATIO; ?>);
	</script>
@stop