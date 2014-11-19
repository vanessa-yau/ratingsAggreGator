@extends('master')

@section('style')
	{{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
	<div class="container">
		<!-- dynamically populated response message -->
		<div class="alert alert-dismissible" id="response-message" role="alert">
		  <button type="button" class="close" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		  <strong id="message-type"></strong><span id="message-text"></span>
		</div>

		<div class="row">
			<div class="col-md-3">
		  		<img src="/images/profile_images/{{ $id }}.jpg" alt="Image of player">
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
		      action="{{ URL::route('ratings.store') }}"
		      novalidate
		    >
		    	<div class="row">
		    		<!-- pass player id to controller for storage. -->
		    		<input type="hidden" name="player_id" value="{{ $id }}">
		    		
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
		// hide ajax response message ASAP.
        $('#response-message').hide();

		$(function(){
			// hide the response message when user clicks close button.
            $('.alert .close').on('click', function(e) {
                $(this).parent().hide();
            });

			// function to show error response message.
            function showErrorMessage(error){
                $('#response-message').removeClass();
                $('#response-message').addClass('alert alert-dismissible alert-danger');
                $('#message-type').text('Error: ');
                var message = "";
                for (var key in error) {
                    message += ("<p>" + error[key] + "</p>");
                };
                $('#message-text').html(message);
                $('#response-message').show();
            }

            // function to show success response message.
            function showSuccessMessage(message) {
                $('#response-message').removeClass();
                $('#response-message').addClass('alert alert-dismissible alert-success');
                $('#message-type').text('Success: ');
                $('#message-text').html(message);
                $('#response-message').show();
            }

			$('#submit-ratings-btn').click(function(e){
				e.preventDefault();
				if( $('.skills').find('select').val() == "6" ){
					alert('Please select a rating for all the categories.');
				}
				else{
					$.ajax({
						type: "POST",
						url: $('#rate-player-form').attr('action'),
						success: function(json){
							//alert('Thanks for rating!');
							// display success message.
	                        var message = "Your rating has been submitted, Thanks!"
	                        showSuccessMessage(message);
						},
						error: function(e){
							console.log(e);
							// display error message.
	                        var responseText = $.parseJSON(e.responseText);
	                        showErrorMessage(responseText);
						}
					});
				}
			});
		});
	</script>
@stop
