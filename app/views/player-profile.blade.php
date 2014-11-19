@extends('master')

@section('style')
  {{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
  <div class="row well">
    <div class="col-md-3">
      {{ HTML::image(
        '/images/profile_images/gerrard_steven.jpg',  
        'image not found', ['class' => 'profile-img']) 
      }}
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
          action="{{ URL::route('players.store') }}"
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
    $(function(){
      // when buttton is clicked
      $('#submit-ratings-btn').click(function(e){
        e.preventDefault();
        if( $('.skills').find('select').val() == "6" ){
          alert('Please select a rating for all the categories.');
        }
        else{
          $.ajax({
            type: "POST",
            url: $('#rate-player-form').attr('action')
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