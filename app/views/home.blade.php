@extends('master')

@section('style')
    {{ HTML::style("/css/home.css") }}
@stop

@section('content')

	<div>
		<h3>Most Rated - Today's most commonly rated players</h3>
	</div>
	<div align="center">

	@foreach($players as $player)
		<div class="col-xs-12 col-sm-6 col-lg-4">
<<<<<<< HEAD
			<a href="/players/{{ $player->id }}">
				<span class="name">{{ $player->name }}</span>
				<img class="thumbnail" src="{{ $player->image_url }}" alt="Profile Image">
			</a>
=======
			<span class="name">{{ $player->name }}</span>

			@if( $player->image_url )
				<a href="{{ $player->url }}">
					<img class="thumbnail" src="{{ $player->image_url }}" alt="Profile Image">
				</a>
			@else
				<img class="thumbnail" src="/images/profile_images/placeholder.png" alt="Profile Image">
			@endif
>>>>>>> f5fa8f6411603fee9db534ae6ce72dcba28cf53c
		</div>
	@endforeach

	</div>
@stop