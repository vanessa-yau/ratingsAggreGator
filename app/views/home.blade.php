@extends('master')

@section('style')
    {{ HTML::style("/css/home.css") }}
@stop

@section('content')
	<div class="row">
		<div class="col-sm-12">
			@include('magpie')
			<marquee class="ticker">{{ getRss("football") }}</marquee>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 rated-players-list">
			<h3>Most Rated Players</h3>
			@foreach($players as $player)
				<div class="col-xs-12 col-sm-6 col-lg-4 player-tumbnails">
					<a href="{{ $player->url }}">
						<span class="name">{{ $player->name }}</span>
						<img class="thumbnail" src="{{ $player->image_url }}" alt="Profile Image">
					</a>
				</div>
			@endforeach 
		</div> <!-- close most rated players div -->
		<div class="col-sm-5 col-sm-offset-1 about-site">
			@if(Auth::check())
				<h3>Your Teams</h3>
			@else
				<h3>About Us</h3>
				<p class="lead"><strong>Ratingator</strong> is a platform where your favourite sports players and teams are <strong>subjectively rated</strong> on their skills during a game, by <strong>you</strong>.</p>

				<br />
				<h4>Who Can I Rate?</h4>
				<p>Currently, association football players, from their respective teams, in respective leagues.</p>
				<br />
				<h4>What do I rate these players on?</h4>
				<p>All sorts of <strong>skills</strong>, <em>e.g. shooting, tackling.</em> It's a star-based "out of five" rating.</p>
				<br />
			@endif
		</div>
	</div> <!-- close row -->
	
	<!-- leagues -->
	<div class="row league-list">
		<div class="col-sm-12">
			<h3>Leagues We Track <span class="label label-default">More soon!</span></h3>
			<div class="row">
				@foreach( $leagues as $league )
				<div class="col-xs-6 col-sm-3 col-lg-2 league">
					<a href="{{{ $league->url }}}">
						<p>
							<img class="league-badge" src="{{{ $league->badge_image_url }}}" alt="img not found"><br />
							{{{ $league->name }}}
						</p>
					</a>
				</div> <!-- end col -->
				@endforeach
			</div>
		</div>
	</div> <!-- end row -->
	<!-- background image taken from http://amagico.com/images/img7/football-field-at-night-hd-background-wallpaper-35.jpeg&h=HAQEsV3Rf -->
@stop

@section('js')
	<script>
		$('.ticker').hover(function () { 
		    this.stop();
		}, function () {
		    this.start();
		});
	</script>
@stop

