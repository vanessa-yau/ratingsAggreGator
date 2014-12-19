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

    <!-- Player stats and average ratings based on all ratings-->
    <div class="player-info">
        <!-- do not delete the data attributes below, used in js -->
        <div class="row" data-player-id="{{{$player->id}}}" data-player-name="{{{$player->name}}}" id="player">
            <div class="col-sm-12">
                <!-- player info -->
                <div class="row">
                    <div class="col-sm-6">
                        <h3>
                            <strong>{{{ $player->name }}}</strong>
                        </h3>
                        <div class="col-sm-4 profile-img-col"> 
                            <p><img id="profile-image" src="{{{ $player->image_url }}}" alt="Profile Image"></p>
                        </div>
                        <div class="col-sm-8">
                            <!-- player ranking in team by aggregate ratings -->
                            <p class="player-team-rank">
                                <button class="btn btn-primary" type="button">
                                    <span class="badge">
                                    <a href="{{{ $team->url }}}">
                                        <span class="player-team-ranking">{{ $player->rankInTeam }}</span> player in {{{ $team->name }}} FC
                                    </a>
                                </button>
                            </p>
                            <p><strong>Nationality: </strong><span class="badge">{{ $player->nationality }}</span></p>
                            <p><strong>Height: </strong><span class="badge">{{ $player->height }}m</span></p>
                            <p><strong>Weight: </strong><span class="badge">{{ $player->weight }}kg</span></p>
                            
                        </div>
                    </div>

                    <!-- Average Ratings shown if ratings for this player exist -->
                    <div class="col-sm-6 chart-section header-chart" data-rank="{{{ $player->rankInTeam }}}">
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
    <div class="row">
        <div class="col-sm-12 rate-form">
            <h3>Rate {{{ $player->name }}}</h3>
            
            <form 
                class="form-horizontal rate-player-form" 
                role="form"
                method="POST" 
                action="{{ URL::route('ratings.store') }}"
                novalidate
            >

                <input type="hidden" name="player_id" id="player_id" value="{{ $player->id }}">
                <input type="hidden" name="team1_id" id="team1_id" value="{{ $team->id }}">
                
                <h4>Using these criteria:</h4>
                <div class="row skills">
                    <!-- skills -->
                    @foreach( $skills as $skill)
                        <div class="form-group">
                            <div class="col-sm-3 skill-label">
                                <label>{{ ucfirst($skill->name) }}</label>
                            </div>
                            <div class="col-sm-9 rating-stars" data-skill="{{ $skill->id }}">
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                                <span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                        </div>
                    @endforeach

                    <!-- game context against <team> -->
                    <div class="col-sm-12">
                        <!-- row for player's team x vs team y -->
                        <h4>
                            Playing in 
                            <div class="btn-group">
                                <button class="btn btn-large btn-primary">{{{ $team->name }}}</button>
                            </div>
                             against 
                             <!-- drop down to select team y -->
                            <select class="btn btn-primary" name="opposingTeam" id="opposingTeam">
                                <option value="-1">Select a team</option>
                                @foreach( Team::whereLastKnownLeagueId($league->id)->orderBy('name','asc')->get() as $otherTeam)
                                    @unless( $otherTeam->id == $team->id )
                                        <option value="{{{ $otherTeam->id }}}">{{{ $otherTeam->name }}}</option>
                                    @endunless
                                @endforeach
                            </select>
                            on 
                            <input 
                                class="btn btn-default"
                                id="datepicker"
                                name="date"
                                type="datetime"
                                placeholder="Enter a date: dd/mm/yyyy"
                                value="{{ Carbon\Carbon::now()->format('Y/m/d') }}"
                            >
                        </h4>
                    </div>
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
        </div> <!-- end col-sm-9 rate-form -->
    </div>    
    <!-- Your Ratings -->
    <div class="row userRating">
        <div class="col-sm-8 chart">
            <canvas id="yourRating"></canvas>
        </div>
        <div class="col-sm-4 legend">
            <h4><strong>Your Rating vs The Average</strong></h4>
            <strong><div id="radarLegend"></div></strong>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <h3>Statistics</h3>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <button class="btn btn-primary btn-block page-views-badge" type="button">
                        <span class="badge">
                            @if( PageCounter::getCounter()->counter )
                                {{ PageCounter::getCounter()->counter + 1 }} 
                            @else
                                1
                            @endif
                        </span> Page Views
                    </button>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <button class="btn btn-success btn-block ratings-badge" type="button">
                        <span class="badge">
                            {{ $player->ratingCount }}
                        </span> Ratings for {{{$player->name}}}
                    </button>
                </div>
            </div>
        </div> <!-- end col-sm-6 -->
    </div> <!-- end row -->
    
    <div class="row">
        <div class="col-sm-12">
            <!-- rest of team -->
            <div class="player-thumbnails">
                <div class="row">
                    <div class="col-sm-12">
                        @if( $team )
                            <h3>
                                <a href="{{{ $team->url }}}">
                                    <img src="{{{ $team->badge_image_url }}}" alt="{{{ $team->name }}} badge missing">
                                    {{{ $team->name }}}
                                </a> Members
                            </h3>
                        @endif
                    </div>
                </div>
                @if( $team->lastKnownPlayers() )
                    <div class="row">
                        @foreach( $team->lastKnownPlayers()->get() as $teamMate )
                            @if( $player->id != $teamMate->id )
                                <div class="col-sm-4 col-md-2">
                                    <a href="{{ $teamMate->url }}">
                                        <div class="team-mate-image">
                                            <!-- <div class="team-mate-image"> -->
                                                <img class="profile" src="{{ $teamMate->image_url }}" alt="{{{ $teamMate->name }}} profile image missing">
                                            <!-- </div> -->
                                            <p class="team-mate-name">
                                                {{{ $teamMate->name }}}
                                            </p>
                                        </div>
                                    </a>
                                </div> <!-- end col-sm-4 col-md-2 -->
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
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
        // This must be at the top of the script for the charts to load properly.
        window.ajaxData = getRating();

        // create the chart but only show it after a successful rating
        // chart("yourRating", "Radar", "radarLegend");

        var ratingSummary;
        // get "nice" averages data for charts (instead of grabbing panel info)
        // must be generated before charts
        $.ajax({
            type: "GET",
            url: decodeURI("{{ URL::route('players.niceRatingSummary') }}"),
            dataType: 'json',
            data: { 
                id: $('#player_id').val() // use hidden input field
            },
            success: function(json){
                // set ratingSummary as a variable to create charts below
                ratingSummary = json;
                // draw chart if player ranked
                if( $('.header-chart').data('rank') != "Unranked" ){
                    // generate the chart
                    chart("ratingBySkill", "Bar", "barLegend");
                    // show the div
                    $('.header-chart').show();

                }
            },
            error: function(e) {
                console.log(e);
            }
        });


        function chart(canvas, chartType, legendDiv) {
            var chartLabels = [];
            var averageData = [];
            var userData = [];

            // get json back from controller method
            // loop over each key value pair 
            // and create charts from it
            for (var prop in ratingSummary) {
                // get array of stat names for chart labels.
                chartLabels.push(prop);

                // get the average stat value, remove '/5' and turn into number.
                averageData.push(ratingSummary[prop]);
            }
            
            // get the rating the user just submitted.
            $.each(ajaxData.ratings, function(index) {
                userData.push(ajaxData.ratings[index]);
            });

            // create new chart on canvas with id specified.
            createChart(chartLabels, averageData, userData, canvas, legendDiv, chartType);
        }

        // toggle filled in stars
        $('.rating-stars span').click(function(){
            // add stars to star-icon clicked
            $(this).removeClass('glyphicon-star-empty')
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

        // grabs all info from the rating form
        // turns stars into a count for each skill
        function getRating() {
            ajaxData = {
                player_id: $('#player_id').val(),
                team1_id: $('#team1_id').val(),
                team2_id: $('#opposingTeam').val(), // to match db col name
                date: $('#datepicker').val(),
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

        // hide the response message when user clicks close button.
        $('.alert .close').on('click', function(e) {
            $(this).parent().hide();
        });

        // function to show error response message.
        function showErrorMessage(error){
            $('#message-type').text('Error: ');
            var message = "";
            for (var key in error) {
                message += ("<p>" + error[key] + "</p>");
            };
            $('#message-text').html(message);
            $('#response-message').removeClass()
                .addClass('alert alert-dismissible alert-danger')
                .show();
        }
      
        // function to show success response message.
        function showSuccessMessage(message) {
            $('#message-type').text('Success: ');
            $('#message-text').html(message);
            $('#response-message').removeClass()
                .addClass('alert alert-dismissible alert-success')
                .show();
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
                    ratingSummary = json['ratingSummary'];
                
                    // display success message.
                    var message = "Your rating has been submitted, Thanks!"
                    showSuccessMessage(message);

                    // hide the form
                    $('.rate-form').parents('.row').slideUp(300);

                    updateStats(json);

                    // recreate and show charts
                    $('.userRating').show();
                    chart("yourRating", "Radar", "radarLegend");
                    chart("ratingBySkill", "Bar", "barLegend");
                    // show the div
                    $('.header-chart').show();

                    // Check to see if user is logged in
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
                    @else
                        //If the user is not logged in then carry out the same tweet process as above
                        var mean = 0;
                        var count = 0;
                        for(var rating in data.ratings) {
                            mean += data.ratings[rating];
                            count++;
                        }
                        mean /= count;

                        var $hiddenTwitterButton = $('<a>')
                            .attr('href', 'https://twitter.com/share?text=' +
                                'I just rated {{{ $player->name }}} an average of ' + 
                                mean + '! How do you rate them?')
                            .attr('target', '_blank');

                        $hiddenTwitterButton[0].click();
                    @endif
                },
                error: function(e){
                    // display error message.
                    var responseText = $.parseJSON(e.responseText);
                    showErrorMessage(responseText);
                    $('#response-message').scrollTop(0);
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

        function updateStats(json) {
            // update rank and rating count for this player
            $('.player-team-ranking').text(json['rankInTeam']);
            $('.ratings-badge').find('.badge').text(json['ratingCount']);

            // show the header-chart if it is not already shown (this is first rating)
            $('.header-chart').data('rank', json['rankInTeam']);
        }

    }); // end document function script

    // restrict date range for match_date restricted to a month before and today
    $( "#datepicker" ).datepicker({ 
        minDate: -30, maxDate: "+0D",
        dateFormat: 'yy/mm/dd'
    });
    </script>

@stop
