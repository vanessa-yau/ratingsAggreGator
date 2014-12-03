@extends('master')

@section('style')
    <style>
        .league-info {
            border-bottom-color: grey;
            border-bottom-width: 2px;
            border-bottom-style: solid;
        }
        .team-badge {
            max-width: 100px;
            max-height: 100px;
            margin-bottom: 10px;
        }
        .team-thumbnail {
            text-align: center;
            margin-bottom: 15px;
        }
        .team-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
@stop

@section('content')
    <!-- general team info -->
    <div class="row league-info">
        <div class="col-sm-12">
            <h2>
                <img class="team-badge" src="/images/gator.jpg" alt="{{{ $league->name }}} badge missing.">
                <strong>{{{ $league->name }}}</strong>
            </h2>
        </div>
    </div>

    <!-- team players -->
    <div class="row">
        <div class="col-sm-12">
            <h4>Teams</h4>
        </div>
        @foreach( $league->teams as $team )
            <div class="col-sm-3 team-thumbnail">
                <a href="{{ $team->url }}">
                    <img class="team-image" src="/images/gator.jpg" alt="{{{ $team->name }}} profile image missing.">
                    <p class="name">{{{ $team->name }}}</p>
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