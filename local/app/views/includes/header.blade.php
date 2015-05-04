<div class="page_width center">
    <div class="noname1">
        <a href="{{ URL::to('') }}" id="logo">LOGO</a>
    </div>
    <div class="noname2">
        <nav>
            <ul>
            	<li {{{ Request::is('/') ? ' class=selected' : '' }}}><a class="dashboard" href="{{ URL::to('/') }}">Dashboard</a></li>
                <li {{{ Request::is('team/1/tactics') ? ' class=selected' : '' }}}><a class="tactics" href="{{ URL::to('team/1/tactics') }}">Tactics</a></li>
            	<li {{{ Request::is('match/1') ? ' class=selected' : '' }}}><a class="match" href="{{ URL::to('match/1') }}">Match</a></li>
            </ul>
        </nav>
    </div>
    
    <div class="search">
        <!--SEARCH-->
    </div>
</div>
