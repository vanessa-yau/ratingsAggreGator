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

    <div>
        
    </div>

    <!-- Player stats and average ratings based on all ratings-->
    <div class="row well">
        <!-- do not delete the data attributes below, used in js -->
        <div class="row" data-player-id="{{{$player->id}}}" data-player-name="{{{$player->name}}}" id="player">
            <div class="col-sm-12">
                <div class="col-sm-6">
                    <h3>
                        <strong>{{ $player->name }}</strong>
                    </h3>
                    <div class="col-sm-4"> 
                        <p><img id="profile-image" src="{{{ $player->image_url }}}" alt="Profile Image"></p>
                    </div>
                    <div class="col-sm-8">
                        <!-- player ranking in team by aggregate ratings -->
                        <p class="player-team-rank">
                            Ranked #{{{ $player->getAggregateSkillRankingWithinTeam() }}} 
                            player in <a href="{{{ $team->url }}}">{{{ $team->name }}} FC</a>
                        </p>
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

    <!-- dynamically populated response message -->
    <div class="alert alert-dismissible" id="response-message" role="alert">
        <button type="button" class="close" >
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong id="message-type"></strong>
        <span id="message-text"></span>
    </div>

    <!-- panels here -->
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

    <!-- rest of team -->    

@stop

@section('js')
    <script src="/js/charts/createChart.js"></script>
    <script>
    // hide ajax response message ASAP.
    $('#response-message').hide();

    $(function(){

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
                // create initial charts on page load.
                chart("yourRating", "Radar", "radarLegend");
                chart("ratingBySkill", "Bar", "barLegend");
            },
            error: function(e) {
                console.log(e);
            }
        });

        // create globals we need.
        window.ajaxData = getRating();

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

        function getRating() {
            ajaxData = {
                player_id:  $('#player_id').val(),
                ratings:    {}
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

    }); // end document function script
    </script>

@stop
