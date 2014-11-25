@extends('master')

@section('style')
    {{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
    <!-- dynamically populated response message -->
    <div class="alert alert-dismissible" id="response-message" role="alert">
        <button type="button" class="close" >
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
        </button>
        <strong id="message-type"></strong>
        <span id="message-text"></span>
    </div>

    <div class="row well">
        <h3>Player Information</h3>
        <div class="row">
            <div class="col-sm-2"> 
                <p><img id="profile-image" src="{{{ $player->image_url }}}" alt="Profile Image"></p>
            </div>
            <div class="col-sm-10">
                <p><strong>Name: </strong>{{ $player->name }}</p>
                <p><strong>Nationality: </strong>{{ $player->nationality }}</p>
                <p><strong>Height: </strong>{{ $player->height }}cm</p>
                <p><strong>Weight: </strong>{{ $player->weight }}kg</p>
            </div>
        </div>
    </div>

    <div class="row well">
        <h3>Average Rating by Skill</h3>
        <div class="row">
            @foreach($player->getRatingSummary() as $name => $stat)
                <div class="col-sm-2">
                    <div class="stat-panel panel status">
                        <div class="panel-heading stat-value" >
                            <h3 class="{{ $name }}">{{ round($stat, 1) }}/5</h3>
                        </div>
                        <div class="panel-body" id="stat-name">
                            <strong>{{ ucfirst($name) }}</strong>
                        </div>
                    </div>
                </div>
            @endforeach 
        </div>
    </div>

    <!-- ratings form -->
    <div class="row well">
        <div class="col-md-12">
      
            <form 
                class="form-horizontal rate-player-form" 
                role="form"
                method="POST" 
                action="{{ URL::route('ratings.store') }}"
                novalidate
            >

                <input type="hidden" name="player_id" value="{{$player->id}}">
              
                <!-- row for team y vs team x -->  
                <div class="row">    
                    <h3>Match info</h3>
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
                                id="datepicker"
                                name="match_date"
                                type="datetime"
                                placeholder="Enter a date: dd/mm/yyyy"
                            >
                        </div> <!-- end col -->
                    </div> <!-- end form group -->
                </div> <!-- end row div -->

                <div class="row skills">
                    <!-- different attributes to rate a player on -->
                    @foreach( $player->getRatedSkills() as $skill)
                        <div class="form-group">
                            <label>{{ ucfirst($skill->name) }}</label>
                            <div class="col-sm-10 rating-stars" data-skill="{{ $skill->id }}">
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
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

    <div class="row well">
        <h3>Statistics</h3>
        <canvas id="myChart" width="400" height="400"></canvas>
    </div>

    <div class="player-thumbnails">
        <div class="row well">
            <h3>Other Team Members</h3>
            @foreach($selection as $teamMate)
                @if( $player->id != $teamMate->id )
                    <div class="col-sm-4 col-md-2">
                        <a href="{{ URL::route('players.show', $player->id) }}"></a>
                        <a href="/players/{{ $teamMate->id }}">
                            <div class="thumbnail">
                                <strong>
                                    @if( strlen($teamMate->name) > 15 )
                                        {{{ substr($teamMate->name, 0, 12).'...' }}}
                                    @else
                                        {{{ $teamMate->name }}}
                                    @endif
                                </strong><br />
                                <img class="thumbnail" src="{{ $teamMate->image_url }}" alt="Profile Image">
                        
                                <p>{{{ 'TEAM NAME GOES HERE' }}}</p>
                            </div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@stop

@section('js')
  <script src="/js/jquery-ui.js"></script>
  <script src="/js/charts/yourRatingVsAverageRating.js"></script>
  <script>
    // hide ajax response message ASAP.
    $('#response-message').hide();

    $(function(){

        $('.rating-stars span').click(function(){
            // add stars to star-icon clicked
            $(this)
                .removeClass('glyphicon-star-empty')
                .addClass('glyphicon-star');

            // add stars to previous star-icons clicked (on left)
            $(this).prevAll()
                .addClass('glyphicon-star')
                .removeClass('glyphicon-star-empty');

            // add stars to previous star-icons clicked (on left)
            $(this).nextAll()
                .addClass('glyphicon-star-empty')
                .removeClass('glyphicon-star');
        });

        function getRating() {
            var ajaxData = {
                player_id   :  $('#player_id').val(),
                ratings: {}
            };

            $('.rating-stars').each(function () {
               var $this = $(this);
               var starCount = $this.find('.glyphicon-star').length;
               var skill = $this.data('skill');
               console.log(skill + ' = ' + starCount);
               ajaxData.ratings[skill] = starCount;
            });
            
            return ajaxData;
        }

        // when page is loaded, change colours of skill rating boxes as apt.
        function colourStatPanels() {
            var stats = $('.stat-panel');
            $.each( stats, function(stat){
                // get numerical statistic as text
                var statVal = $(stats[stat]).find('h3').text();
                // get the correct substring not '/5'
                var roundedStat = statVal.substring(0, statVal.length-2);
                // convert the string to number
                var roundedStat = Number(roundedStat);
                
                // if statement adds approprate class to panels depending on value of skill.
                if(roundedStat <= 2){
                    $(stats[stat]).removeClass().addClass('stat-panel panel status panel-danger');
                } else if( 2 < roundedStat && roundedStat < 4){
                    $(stats[stat]).removeClass().addClass('stat-panel panel status panel-warning');
                } else {
                    $(stats[stat]).removeClass().addClass('stat-panel panel status panel-success');
                }
            });
        }

        // run stat colouring function on page load
        colourStatPanels();
        
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

        function resetForm() {
            $('.rating-stars span')
                .removeClass()
                .addClass('glyphicon glyphicon-star-empty');
        }

        $('.rate-player-form').submit(function(e) {
            e.preventDefault();
            var data = getRating();
            var $this = $(this);
            var $submitButton = $this.find('[type=submit]');
            $submitButton.attr('disabled', true);

            $.ajax({
                type: "POST",
                //url: $('#rate-player-form').attr('action'),
                url: decodeURI("{{ URL::route('ratings.store') }}"),
                data: data,
                success: function(json){
                    // display success message.
                    var message = "Your rating has been submitted, Thanks!"
                    showSuccessMessage(message);

                    // recolour panels if stats change averages.
                    colourStatPanels();

                    // reset all rating dropdowns to show 'Average' after submission.
                    $('.skills').find('select').val(3);

                    // change rating values on page to new values.
                    $.each(json, function(skill, value) {
                        $('.' + skill).text(Number(value).toFixed(1) + '/5');
                    });

                    // hide the form
                    $this.parents('.row').slideUp(300);
                },
                error: function(e){
                    // display error message.
                    var responseText = $.parseJSON(e.responseText);
                    showErrorMessage(responseText);
                }
            })
            .always(function () {
                $submitButton.removeAttr('disabled');
                setTimeout(function(){
                    resetForm();
                    $this.parents('.row').slideDown(300);
                }, 30000);
            }); // end of ajax request
        }); // end of submit event handler

    }); // end document function script
    </script>
@stop