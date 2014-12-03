@extends('master')

@section('style')
    <style>
        .team-badge {
            max-width: 100px;
            max-height: 100px;
        }
        .team-info {
            border-left-width: 1px;
            border-left-style: solid;
            border-left-color: lightgrey;
        }
    </style>
@stop

@section('content')
    <!-- general team info -->
    <div class="row">
        <div class="col-sm-2">
            <img class="team-badge pull-right" src="/images/gator.jpg" alt="">
        </div>
        <div class="col-sm-10 team-info">
            <h1>{{ $team->name }}</h1>
            <h2>Currently in: {{{ $team->last_known_league_id }}}</h2>
        </div>
    </div>
@stop