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
                <p><img id="profile-image" src="{{{ $player->image_url }}}" alt="Image of player"></p>
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
                <div class="col-xs-2">
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
                class="form-horizontal" 
                id="rate-player-form"
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
                            <label>{{$attr}}</label>
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

    <canvas id="myChart" width="400" height="400"></canvas>

@stop

@section('js')
  <script src="/js/jquery-ui.js"></script>
  <script>
    // hide ajax response message ASAP.
    $('#response-message').hide();

    $(function(){
      
        var data = [
            {
                value: 300,
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "Red"
            },
            {
                value: 50,
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "Green"
            },
            {
                value: 100,
                color: "#FDB45C",
                highlight: "#FFC870",
                label: "Yellow"
            },
            {
                value: 100,
                color: "#949FB1",
                highlight: "#A8B3C5",
                label: "Grey"
            },
            {
                value: 120,
                color: "#4D5360",
                highlight: "#616774",
                label: "Dark Grey"
            }

        ];

        // <!> this part needs to go before the new chart statement below <!>

        // Get the context of the canvas element we want to select
        var ctx = document.getElementById("myChart").getContext("2d");
        var myNewChart = new Chart(ctx).PolarArea(data);
        
        // creates the new chart on the canvas supplied in the ctx.
        // options array as second argument.  see chartjs docs.
        new Chart(ctx).PolarArea(data);

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

        $('#submit-ratings-btn').click(function(e){
            e.preventDefault();
            console.log(decodeURI("{{ URL::route('ratings.store') }}"));

            $.ajax({
                type: "POST",
                //url: $('#rate-player-form').attr('action'),
                url: decodeURI("{{ URL::route('ratings.store') }}"),
                data: { 
                    player_id   :  $('#player_id').val(),
                    shooting    :  $('.skills').find('#shooting').val(),
                    passing     :  $('.skills').find('#passing').val(),
                    dribbling   :  $('.skills').find('#dribbling').val(),
                    speed       :  $('.skills').find('#speed').val(),
                    tackling    :  $('.skills').find('#tackling').val()
                },
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