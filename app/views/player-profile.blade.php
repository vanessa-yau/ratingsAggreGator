@extends('master')

@section('style')
	{{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				{{ HTML::image(
		  		'/images/Koala.jpg',	
		  		'image not found', ['class' => 'profile-img']) 
		  	}}
			</div>
		</div>

		<!-- Aggregate ratings info for player -->
		<div class="row">
			<div class="col-md-12">
				<!-- BLAH -->
				<p>some aggregate content</p>
			</div>
		</div>

		<!-- button to show the rate modal -->
		<div class="row">
			<div class="col-md-12">
				<button class="btn btn-large default-btn" id="ratePlayer">RATE THIS PLAYER</button>
			</div>
		</div>

		<!-- charts -->
		<div class="row">
			<div class="col-md-12">
				<!-- some very cool charts here -->
				<p>some cool charts</p>
			</div>
		</div>
	</div>
@stop

@section('modals')
	@include('modals/rate-player')
@stop

@section('js')
	<script>
    $(document).ready(function(){
    	$('#ratePlayer').click(function(e){
    		e.preventDefault();

    		$('.modal').modal('show');
    	})
    });
  </script>
@stop