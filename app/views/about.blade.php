@extends('master')

@section('style')
    {{ HTML::style("/css/about.css") }}
@stop

@section('content')
    <div class="container page-content">
        <div class="row">
            <div class="col-xs-6 col-sm-10 placeholder">
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Ratingator?</h1>

                        <p class="lead"><strong>Rating Aggregator</strong> is a platform where your favourite sports players and teams are <strong>subjectively rated</strong> on their skills during a game, by <strong>you</strong>.</p>

                        <p><em>Your opinion matters. No longer the journalists player ratings or computer generated stats.</em></p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12">
                        <h1>Who can I rate?</h1>
                        <p>Currently, association football players, from their respective teams, in respective leagues.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <h1>What do I rate these players on?</h1>
                        <p>All sorts of <strong>skills</strong>, <em>e.g. shooting, tackling.</em> It's a star-based "out of five" rating.</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <h1>Why?</h1>
                        <ul>    
                            <li>Start rating players</li>
                            <li>Build up your profile</li>
                            <li>See how your opinions on a player match up against the mainstream
                            </li>
                        </ul>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end col -->
        </div>
    </div> <!-- end container -->
@stop
