@extends('master')

@section('style')
    <style>
        .team-info {
            border-bottom-color: grey;
            border-bottom-width: 2px;
            border-bottom-style: solid;
        }
        .team-badge {
            max-width: 100px;
            max-height: 100px;
            margin-bottom: 10px;
        }
        .player-thumbnail {
            text-align: center;
            margin-bottom: 15px;
        }
        .player-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
@stop

@section('content')
    <!-- general team info -->
    <div class="row team-info">
        <div class="col-sm-10">
            <h2><strong>{{ $team->name }}</strong></h2>
            <h3>
                Currently in: <a href="{{ $league->url }}">{{{ $league->name }}}</a>
            </h3>
        </div>
        <div class="col-sm-2">
            <img class="team-badge pull-right" src="/images/gator.jpg" alt="">
            <button class="hide-players btn btn-large btn-primary pull-right">Hide Players</button>
        </div>
    </div>

    <!-- team players -->
    <div class="row">
        <div class="col-sm-12">
            <h4>Featuring</h4>
        </div>
        @foreach( $team->last_known_players as $player )
            <div class="col-sm-3 player-thumbnail">
                <a href="{{ $player->url }}">
                    <img class="player-image" src="{{{ $player->image_url }}}" alt="...">
                    <p class="name">{{{ $player->name }}}</p>
                </a>
            </div>
        @endforeach
    </div>
@stop

@section('js')
    <script>
        $(function(){
            
        });
    </script>
@stop