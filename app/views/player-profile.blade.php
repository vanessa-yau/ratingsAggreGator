@extends('master')

@section('style')
  {{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
	<div class="alert alert-dismissible" id="response-message" role="alert">
	  <button type="button" class="close" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	  <strong id="message-type"></strong><span id="message-text"></span>
	</div>

  <div class="row well">
		<!-- dynamically populated response message -->

		<div class="col-md-12">
	  	<img src="/images/profile_images/{{ $id }}.jpg" alt="Image of player">
		</div>
	</div>

  <!-- ratings form -->
  <div class="row well">
    <div class="col-md-12">
      
      <form 
          class="form-horizontal" 
          id="rate-player-form"
          role="form"
          method="POST" 
          action="{{ URL::route('ratings.store') }}"
          novalidate
        >

        <input type="hidden" name="player_id" value="1">
          
         
        <!-- row for team y vs team x -->  
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
                placeholder="Enter home team" 
              >

              vs

              <input 
                id="team_2" 
                type="text" 
                name="team_2" 
                placeholder="Enter away team" 
              >
        


            <!-- select match date,
            to be replaced by interactive calendar 
            -->
              <input 
                id="match_date"
                name="match_date"
                type="datetime"
                placeholder="Enter a date: dd/mm/yyyy"
              >
            </div> <!-- end col -->
          </div> <!-- end form group -->
        </div> <!-- end row div -->

        <div class="row skills">
          <!-- different attributes to rate a player on -->
          @foreach( $attributes as $attr )
            <div class="form-group">
              <label for="{{{ $attr }}}" class="col-sm-2 control-label">{{{ $attr }}}</label>
              
              <div class="col-sm-10">
                <select name="{{{ $attr }}}" id="{{ $attr }}">
                  <option value="3">Average</option>
                  <option value="1">Rubbish!</option>
                  <option value="2">Poor</option>
                  <option value="4">Good</option>
                  <option value="5">Sublime!</option>
                </select>
              </div>

            </div>
          @endforeach
        </div> <!-- end row skills row -->

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
  </div> <!-- end row well div -->
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
				console.log(decodeURI("{{ URL::route('ratings.store') }}"));

				$.ajax({
					type: "POST",
					//url: $('#rate-player-form').attr('action'),
					url: decodeURI("{{ URL::route('ratings.store') }}"),
					data: { 
						player_id 	:  $('#player_id').val(),
						shooting 		:  $('.skills').find('#shooting').val(),
						passing 		:  $('.skills').find('#passing').val(),
						dribbling 	:  $('.skills').find('#dribbling').val(),
						speed 			:  $('.skills').find('#speed').val(),
						tackling 		:  $('.skills').find('#tackling').val()
					},
					success: function(json){
						// display success message.
            var message = "Your rating has been submitted, Thanks!"
            showSuccessMessage(message);
					},
					error: function(e){
						// display error message.
            var responseText = $.parseJSON(e.responseText);
            showErrorMessage(responseText);
					}
				}); // end of ajax request
			}); // end of submit event handler

		}); // end document function script
	</script>
@stop
