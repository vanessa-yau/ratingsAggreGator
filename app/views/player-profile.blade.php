@extends('master')

@section('style')
	{{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				{{ HTML::image(
		  		'/images/profile_images/gerrard_steven.jpg',	
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

		<!-- ratings form -->
		<div class="row well">
			<div class="col-md-12">
				<h4>RATE THIS PLAYER</h4>
				
				<form 
		      class="form-horizontal" 
		      id="rate-player-form"
		      role="form"
		      method="POST" 
		      action="{{ URL::route('players.store') }}"
		      novalidate
		    >
		    	<div class="row">
		    		<h4>Match info</h4>
						
						<!-- enter/select match -->
						<div class="form-group match">
			        <!-- select teams -->
			        <div class="col-sm-10">
			        	<input 
			        		id="team_1" 
			        		type="text" 
			        		name="team_1" 
			        		placeholder="Enter a team" 
			        		class="pull-right"
			        	>
								
								<p> vs </p>
								
								<input 
			        		id="team_2" 
			        		type="text" 
			        		name="team_2" 
			        		placeholder="Enter a team" 
			        		class="pull-left"
			        	>
							</div>

							<!-- select match date -->
							<input 
								id="match_date"
								name="match_date"
								type="datetime"
								placeholder="Enter a date"
								class="form-control datepicker"
							>
			      </div>
		    	</div>

					<div class="row skills">
						<!-- different attributes to rate a player on -->
			    	@foreach( $attributes as $attr )
				    	<div class="form-group">
				        <label for="{{{ $attr }}}" class="col-sm-2 control-label">{{{ $attr }}}</label>
				        
				        <div class="col-sm-10">
								 	<select name="{{{ $attr }}}" id="{{ $attr }}">
								 		<option value="6">Please select</option>
								 		<option value="1">Rubbish!</option>
								 		<option value="2">Poor</option>
								 		<option value="3">Average</option>
								 		<option value="4">Good</option>
								 		<option value="5">Sublime!</option>
								 	</select>
								</div>

				      </div>
			      @endforeach
					</div>

					<input type="hidden" id="player_id" value="1">

					<div class="form-group">
		        <div class="col-sm-12">
		          <input 
		          	id="submit-ratings-btn" 
		          	type="submit" 
		          	value="Submit My Ratings" 
		          	class="btn login-btn btn-primary pull-right"
		          >
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
	<script src="/js/jquery-ui.js"></script>
	<script>
		$(function(){
			$('.dropdown-menu li').click(function(e){
				e.preventDefault();
				$this = $(e.target);
				$this
					.parents('.btn-group')
					.find('.selected-rating')
					.text($this.text());
			});

			$('#submit-ratings-btn').click(function(e){
				e.preventDefault();
				if( $('.selected-rating').text() == 'Please select a rating ' ){
					alert('Please select a rating for all the categories.');
				}
				else{
					$.ajax({
						type: "POST",
						url: $('#rate-player-form').attr('action')
						dataType: 'json',
						success: function(json){
							alert('Thanks for rating!');
						},
						error: function(e){
							console.log(e);
						}
					});
				}
			});
		});
	</script>
@stop