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
			<span class="name">{{ $player-> name }}</span>

			<a href="{{ $player->url }}">
				<img class="thumbnail" src="{{{ $player->image_url }}}" alt="Image of player">
			</a>

		</div>
	@endforeach

	</div>
@stop