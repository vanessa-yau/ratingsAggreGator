@extends('master')

@section('style')
    {{ HTML::style("/css/player-profile.css") }}
@stop

@section('content')
    <!-- breadcrumbs -->
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}">Home</a></li>
                @if( $league )
                    <li><a href="{{{ $league->url }}}"> {{{ $league->name }}} </a></li>
                @endif
                @if( $team )
                    <li><a href="{{{ $team->url }}}"> {{{ $team->name }}} </a></li>
                @endif
                <li class="active"><a href="{{{ $player->url }}}"> {{{ $player->name }}} </a></li>
            </ol>
        </div>
    </div>

    <div id="error-pointer"></div>
    <div class="row well">
        <div class="row" data-player-id="{{{$player->id}}}" data-player-name="{{{$player->name}}}" id="player">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <h3>{{ $player->name }}</h3>
                    <div class="col-sm-4"> 
                        <p><img id="profile-image" src="{{{ $player->image_url }}}" alt="Profile Image"></p>
                    </div>
                    <div class="col-sm-8">
                        <p><strong>Nationality: </strong>{{ $player->nationality }}</p>
                        <p><strong>Height: </strong>{{ $player->height }}m</p>
                        <p><strong>Weight: </strong>{{ $player->weight }}kg</p>
                    </div>
                </div>
                <div class="col-sm-6 chart-section header-chart">
                    <div class="col-sm-8 chart">
                        <canvas id="ratingBySkill"></canvas>
                    </div>
                    <div class="col-sm-4 legend">
                        <h5><strong>Average Rating by Skill</strong></h5>
                        <strong><div id="barLegend"></div></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row well existing-ratings">
        <h3>Average Rating by Skill</h3>
        <div class="row">
            @foreach($player->getRatingSummary() as $name => $stat)
                <div class="col-sm-2">
                    <div class="stat-panel panel status">
                        <div class="panel-heading stat-value" >
                            <h3 class="{{ $name }}">{{ round($stat, 1) }}/5</h3>
                        </div>
                        <div class="panel-body" id="stat-name">
                            <strong class="stat-name">{{ ucfirst($name) }}</strong>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- dynamically populated response message -->
    <div class="alert alert-dismissible" id="response-message" role="alert">
        <button type="button" class="close" >
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
        </button>
        <strong id="message-type"></strong>
        <span id="message-text"></span>
    </div>
    
    <!-- ratings form -->
    <div class="row well">
        <h3>Rate {{ $player->name }}</h3>
        <div class="col-md-12">
      
            <form 
                class="form-horizontal rate-player-form" 
                role="form"
                method="POST" 
                action="{{ URL::route('ratings.store') }}"
                novalidate
            >

                <input type="hidden" name="player_id" id="player_id" value="{{ $player->id }}">
              
                <div class="row skills">
                    <h5>Using these criteria:</h5>
                    <!-- different attributes to rate a player on -->
                    @foreach( $skills as $skill)
                        <div class="form-group">
                            <label class="skill-label">{{ ucfirst($skill->name) }}</label>
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

                <!-- row for team y vs team x -->  
                <div class="row">
                <h5>In this game:</h5>
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
                    <h5>Using these criteria:</h5>
                    <!-- different attributes to rate a player on -->
                    @foreach( $skills as $skill)
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

               <!--  <div class="share-buttons">
                    
                    <ul>
                        <li> 
                            <a 
                                href="https://twitter.com/share" 
                                class="twitter-share-button"
                                data-size="large"
                                data-via="ratingator"
                                data-text="hi"
                                target="_blank"
                                >
                            </a>
                        </li>
                    </ul>

                </div> -->

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

    <div class="row well chart-section">
        <h3>Statistics</h3>
        <div class="col-sm-6">
            <div class="col-sm-8 chart">
                <canvas id="yourRating"></canvas>
            </div>
            <div class="col-sm-4 legend">
                <h5><strong>Your Rating vs The Average</strong></h5>
                <strong><div id="radarLegend"></div></strong>
            </div>
        </div>
    </div>

    <div class="player-thumbnails">
        <div class="row well">
            @if( $team )
                <h3>
                    <a href="{{{ $team->url }}}">
                        <img src="{{{ $team->badge_image_url }}}" alt="{{{ $team->name }}} badge missing">
                        {{{ $team->name }}}
                    </a> Members
                </h3>
            @endif
            @if( $team->lastKnownPlayers() )
                @foreach( $team->lastKnownPlayers()->get() as $teamMate )
                    @if( $player->id != $teamMate->id )
                        <div class="col-sm-4 col-md-2">
                            <a href="{{ $teamMate->url }}">
                                <div class="thumbnail">
                                    <p class="team-mate-name">
                                        {{{ $teamMate->name }}}
                                    </p>
                                    <div class="team-mate-image">
                                        <img class="thumbnail profile" src="{{ $teamMate->image_url }}" alt="{{{ $teamMate->name }}} profile image missing">
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

@stop

@section('js')
    <script src="/js/charts/createChart.js"></script>
    <script>
    // hide ajax response message ASAP.
    $('#response-message').hide();

    $(function(){
        // create globals we need.
        window.ajaxData = getRating();

        if($('.stat-panel').length == 0){
            $('.chart-section').hide();
            $('.existing-ratings').hide();
        }

        // function to switch tabs.
        function activateTab(tab){
            $('.nav-tabs a[href="#' + tab + '"]').tab('show');
        };

        function chart(canvas, chartType, legendDiv) {
            var chartLabels = [];
            var averageData = [];
            var userData = [];
            $('.stat-panel').each(function(index) {
                // get array of stat names for chart labels.
                chartLabels.push($(this).find('.stat-name').text());

                // get the average stat value, remove '/5' and turn into number.
                var statVal = $(this).find('h3').text();
                statVal = statVal.substring(0, statVal.length-2);
                statVal = Number(statVal);
                averageData.push(statVal);
            });
            
            // get the rating the user just submitted.
            $.each(ajaxData.ratings, function(index) {
                userData.push(ajaxData.ratings[index]);
            });

            // create new chart on canvas with id specified.
            createChart(chartLabels, averageData, userData, canvas, legendDiv, chartType);
        }

        // create initial charts on page load.
        chart("yourRating", "Radar", "radarLegend");
        chart("ratingBySkill", "Bar", "barLegend");

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
            ajaxData = {
                player_id   :  $('#player_id').val(),
                ratings: {}
            };

            $('.rating-stars').each(function () {
               var $this = $(this);
               var starCount = $this.find('.glyphicon-star').length;
               var skill = $this.data('skill');
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
            $('.match input').val('');
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

                    // change rating values on page to new values.
                    $.each(json, function(skill, value) {
                        $('.' + skill).text(Number(value).toFixed(1) + '/5');
                    });

                    // recolour panels if stats change averages.
                    colourStatPanels();

                    // hide the form
                    $this.parents('.row').slideUp(300);

                    // recreate chart to take into account user ratings.
                    chart("yourRating", "Radar", "radarLegend");
                    chart("ratingBySkill", "Bar", "barLegend");

                    // Ensures page will not break if a user is not logged in
                    @if(Auth::check())
                        // If the currently authenticated user has enabled tweets then 
                        // calculate the mean of our ratings so that we can put it in the tweet!
                        @if(Auth::user()->tweets_enabled)
                            var mean = 0;
                            var count = 0;
                            for(var rating in data.ratings) {
                                mean += data.ratings[rating];
                                count++;
                            }
                            mean /= count;


                            //Create a twitter button and pre-fill it then click it behind the scenes
                            //and open the button in a new window incase the user wishes to submit the tweet
                            var $hiddenTwitterButton = $('<a>')
                                .attr('href', 'https://twitter.com/share?text=' +
                                    'I just rated {{{ $player->name }}} an average of ' + 
                                    mean + '! How do you rate them?')
                                .attr('target', '_blank');

                            $hiddenTwitterButton[0].click();
                        @endif
                    @endif
                },
                error: function(e){
                    // display error message.
                    var responseText = $.parseJSON(e.responseText);
                    showErrorMessage(responseText);
                    $('body').scrollTop(0);
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
