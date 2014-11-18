@extends('master')

@section('style')
	{{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
		  		<img src="{{ URL::route('player.image', 1) }}" alt="Image of player">
			</div>
		</div>

		<!-- Aggregate ratings info for player -->
		<div class="row">
			<div class="col-md-12">
				<!-- BLAH -->
				<p>some aggregate content</p>
			</div>
		</div>

		<!-- ratings form -->
		<div class="row well">
			<div class="col-md-12">
				<div class="h4">RATE THIS PLAYER</div>
				<form 
		      class="form-horizontal" 
		      id="rate-player-form"
		      role="form"
		      method="POST" 
		      action=""
		      novalidate
		    >
		    	<!-- different attributes to rate a player on -->
		    	@foreach( $attributes as $attr )
			    	<div class="form-group">
			        <label for="{{{ $attr }}}" class="col-sm-2 control-label">{{{ $attr }}}</label>
			        <div class="col-sm-10">

								<div class="btn-group">
									<button 
						  			type="button" 
						  			class="btn btn-primary dropdown-toggle attr-selection {{{ $attr }}}" 
						  			data-toggle="dropdown"
						  		>
						  			<i class="selected-rating">Please select a rating </i>
										<span class="caret"></span>
										<span class="sr-only">Toggle Dropdown</span>
									</button>
								  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
								  	<li><a href="#">Rubbish!</a></li>
			              <li><a href="#">Poor</a></li>
			              <li><a href="#">Average</a></li>
			              <li><a href="#">Good</a></li>
			              <li><a href="#">Sublime!</a></li>
								  </ul>
								</div>
			          <label class="email-help" for="loginEmailAddress"></label>
			        </div>
			      </div>
		      @endforeach

		      <div class="form-group">
		        <div class="col-sm-12">
		          <input id="login-btn" type="submit" value="Submit My Ratings" class="btn login-btn btn-primary pull-right">
		        </div>
		      </div>

		    </form>
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

@section('js')
	<script>
		$(function(){
			$('.dropdown-menu li').click(function(e){
				e.preventDefault();
				$('.selected-rating').text($(e.target).text());
			});
		});
	</script>
@stop