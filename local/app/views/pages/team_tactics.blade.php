@section('content')
    <section class="team_tactics_players">
        <div class="content">
            <header>
                <h1>Players - Position</h1>
            </header>
            <ul class="table_h">
                <li>
                    <span class="col c1">Pkd</span>
                    <span class="col c2">Inf</span>
                    <span class="col c3">Name</span>
                    <span class="col c4">Position</span>
                    <span class="col c5">Form</span>
                    <span class="col c6">Morale</span>
                    <span class="col c7">Cond</span>
                </li>
             </ul>
             <ul class="table">
                @foreach($team_players as $row)
                <li>
                    <span class="col c1 checker">
                    <div class="drop_down_list">
                        <span id="player_id-{{ $row->player_id }}-pos_no" class="current
                        {{ !array_key_exists($row->player_id, $players_pos_name) ? 'null' : '' }}"
                        >{{ array_key_exists($row->player_id, $players_pos_name) ? $players_pos_name[$row->player_id] : '-' }}</span>
                        <ul player_id="{{ $row->player_id }}">
                        	<!-- Ajax content -->
                        </ul>
                    </div>
                    </span>
                    <span class="col c2">&nbsp;</span>
                    <span class="col c3">{{ $row->name }}</span>
                    <span class="col c4">-</span>
                    <span class="col c5">-</span>
                    <span class="col c6">-</span>
                    <span class="col c7">-</span>
                </li>
                @endforeach
            </ul>
        </div>
    </section>
    <section class="team_tactics_tactic">
        <div class="content">
            <header>
                <h1>Positions (4-4-2)</h1>
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
@stop