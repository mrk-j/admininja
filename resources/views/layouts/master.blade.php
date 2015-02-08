<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ Config::get('admininja.title') }}</title>

		<link href="{{ asset('packages/mrkj/admininja/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('packages/mrkj/admininja/css/admininja.css') }}" rel="stylesheet">

		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">{{ Config::get('admininja.title') }}</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					@foreach($menu as $item)
						<li><a href="#">{{ $item }}</a></li>
					@endforeach
				</ul>
			</div>
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1>Dashboard</h1>
				<p>Stay tuned!</p>
			</div>
		</div>

		<script src="{{ asset('packages/mrkj/admininja/js/jquery-1.11.2.min.js') }}"></script>
		<script src="{{ asset('packages/mrkj/admininja/bootstrap/js/bootstrap.min.js') }}"></script>
	</body>
</html>
