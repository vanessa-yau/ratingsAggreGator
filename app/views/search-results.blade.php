@extends('master')

@section('style')
    {{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
	
		@foreach ($results as $result)

		<div class="row well">
			<div class="row">
				<div class="col-sm-2"> 
					<img id="profile-image" src="{{{ $result->image_url }}}" alt="Image of player">
				</div>
				<div class="col-sm-10">
					<strong> <p> {{ $result->name }} </p> </strong>
					<strong> <p> {{ $result->nationality }} </p> </strong>
					<strong> <p> Football Player </p> </strong>
					<strong> <p> Plays For Liverpool </p> </strong>
				</div>
			</div>
		</div>


		@endforeach

	<?php echo $results->links(); ?>
@stop

