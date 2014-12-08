@extends('master')

@section('style')
    {{ HTML::style("/css/home.css") }}
@stop

@section('content')

	<div class="row">
		@include('magpie')
		<marquee class="ticker">{{ getRss("football") }}</marquee>
	</div>
	<div class="row">
		<h3>Most Rated Players</h3>
		<div align="center">
			@foreach($players as $player)
				<div class="col-sm-6 col-md-4 col-lg-3">
					<a href="{{ $player->url }}">
						<span class="name">{{ $player->name }}</span>
						<img class="thumbnail" src="{{ $player->image_url }}" alt="Profile Image">
					</a>
				</div>
			@endforeach 
		</div> <!-- close most rated players div -->
	</div> <!-- close row -->
	
	<!-- leagues -->
	<div class="row">
		<h3>Leagues we are following:</h3>
		@foreach( $leagues as $league )
		<div class="col-sm-2 league">
			<a href="{{{ $league->url }}}">
				<p>
					<img class="league-badge" src="{{{ $league->badge_image_url }}}" alt="img not found"><br />
					{{{ $league->name }}}
				</p>
			</a>
		</div>
		@endforeach
	</div>
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