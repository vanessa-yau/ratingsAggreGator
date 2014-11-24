<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>
		@import url(//fonts.googleapis.com/css?family=Lato:700);

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	<div class="welcome">
		<img src="/images/gator.jpg" alt="..." class="logo">
		<h1>You have arrived.</h1>
	</div>
	<div class="player-thumbnails">
		<div class="row">
			@foreach($selection as $player)
				<div class="col-sm-6 col-md-4">
					<a href="{{ URL::route('players.show', $player->id) }}"></a>
				    <div class="thumbnail">
				    	<img src="{{{ $player->image_url }}}" alt="...">
				    	<div class="caption">
					        <h3>{{{ $player->name }}}</h3>
					        <p>{{{ 'TEAM NAME GOES HERE' }}}</p>
					    </div>
				    </div>
				</div>
			@endforeach
		</div>
	</div>
</body>
</html>
