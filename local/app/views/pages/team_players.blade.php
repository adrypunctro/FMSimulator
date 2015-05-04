@section('content')
    <section class="team_players_list">
        <div class="content">
            <ul class="play_bar">
            	<li class="on"><span>GK</span></li>
                <li class="on"><span>DR</span></li>
                <li class="on"><span>DRC</span></li>
                <li class="on"><span>DLC</span></li>
                <li><span>DL</span></li>
                <li class="on"><span>MC</span></li>
                <li><span>MLC</span></li>
                <li><span>MRC</span></li>
                <li class="on"><span>MR</span></li>
                <li class="on"><span>STCR</span></li>
                <li class="on"><span>ST</span></li>
                <li class="res on"><span>S1</span></li>
                <li class="res"><span>S2</span></li>
                <li class="res"><span>S3</span></li>
                <li class="res"><span>S4</span></li>
                <li class="res"><span>S5</span></li>
            </ul>
            <ul class="table_h">
                <li>
                    <span class="col c1">Pkd</span>
                    <span class="col c2">Inf</span>
                    <span class="col c3">Name</span>
                    <span class="col c4">Position</span>
                    <span class="col c5">Morale</span>
                    <span class="col c6">Last 5 Games</span>
                    <span class="col c7">Con</span>
                    <span class="col c8">Apps</span>
                    <span class="col c9">Gls</span>
                    <span class="col c10">Av Rat</span>
                </li>
             </ul>
             <ul class="table">
                <?php foreach(range(1,20) as $i):
                $class='';

                if($i==2)
                    $class .= ' owner';
                
                if($i<=4)
                    $class .= ' promotes';
                if($i>=17)
                    $class .= ' demotes';
                ?>
                <li class="<?php echo $class;?>">
                    <span class="col c1 checker"><a href="#">GK</a></span>
                    <span class="col c2">Inj</span>
                    <span class="col c3">Thomas Vendermour Del</span>
                    <span class="col c4">D(C), DM, M(C)</span>
                    <span class="col c5">[X] Very Good</span>
                    <span class="col c6">[X]X]X]X]X] 7.06</span>
                    <span class="col c7">100%</span>
                    <span class="col c8">14 (13)</span>
                    <span class="col c9">12</span>
                    <span class="col c10">7.00</span>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
@stop