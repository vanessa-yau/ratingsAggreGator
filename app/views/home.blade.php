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
		<div class="col-sm-4">
					<img src="{{{ $player->image_url }}}" alt="Image of player">
			<p>Joe Bloggs</p>
			<p>Chelsea FC</p>
		</div>
	@endforeach
	</div>
@stop