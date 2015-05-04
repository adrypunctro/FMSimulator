<!doctype html>
<html>
<head>
    @include('includes.head')
</head>
<body>
    <header>
        @include('includes.header')
    </header>

	<div class="page_width center">
        @yield('content')
	</div>

    <footer class="row">
        @include('includes.footer')
    </footer>
</body>
</html>