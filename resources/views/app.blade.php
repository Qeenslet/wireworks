<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Админ-панель Wireworks</title>
    @section('styles')

	    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="/ammap/ammap.css" type="text/css" media="all" />
        <link rel="stylesheet" href="/media/css/admin.css" type="text/css" media="all" />
	<!-- Fonts -->
	    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    @show
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{route('mainAdmin')}}">Wireworks</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}">На главную сайта</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Выход</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                @if(\Auth::check())
                <ul class="nav nav-pills nav-stacked">
                    <?php $admRouts=\App\Classes\Helpers\Arrays::adminRouts();
                    $curRoute = \Route::currentRouteName();
                    ?>
                    @foreach($admRouts as $name => $value)
                        @if($name == $curRoute)
                            <li role="presentation" class="active"><a href="{{route($name)}}">{{$value}}</a></li>
                        @else
                            <li role="presentation"><a href="{{route($name)}}">{{$value}}</a></li>
                        @endif

                    @endforeach

                </ul>
                @endif
            </div>
            <div class="col-md-10">
                @yield('content')
            </div>
        </div>
    </div>

    @section('scripts')
	<!-- Scripts -->
	    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="/ammap/ammap.js" type="text/javascript"></script>
        <script src="/ammap/maps/js/worldLow.js" type="text/javascript"></script>
        <script src="/media/js/confirmAction.js" type="text/javascript"></script>
    @show
</body>
</html>
