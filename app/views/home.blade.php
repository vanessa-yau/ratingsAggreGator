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
		<div class="col-sm-6">
			<h3>Most Rated Players</h3>
			@foreach($players as $player)
				<div class="col-xs-12 col-sm-6 col-lg-4">
					<a href="{{ $player->url }}">
						<span class="name">{{ $player->name }}</span>
						<img class="thumbnail" src="{{ $player->image_url }}" alt="Profile Image">
					</a>
				</div>
			@endforeach 
		</div> <!-- close most rated players div -->

		<div class="col-sm-6">
		    <div class="row">
		        <h3>Your Teams</h3>
		        User teams here.
		    </div>
		</div> <!-- close most rated players div -->
	</div>
	<!-- leagues -->
	<div class="row">
		<h3>Leagues we are following <span class="label label-default">More soon!</span></h3>
		@foreach( $leagues as $league )
			<div class="col-xs-12 col-sm-4 col-lg-2 league">
				<a href="{{{ $league->url }}}">
					<p>
						<img class="league-badge" src="{{{ $league->badge_image_url }}}" alt="img not found"><br />
						{{{ $league->name }}}
					</p>
				</a>
			</div> <!-- end col-sm-3 league -->
		@endforeach
	</div> <!-- end row -->
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

