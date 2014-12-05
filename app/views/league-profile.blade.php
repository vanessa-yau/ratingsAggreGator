@extends('master')

@section('style')
    {{ HTML::style("/css/league-profile.css") }}
@stop

@section('content')
    <!-- general team info -->
    <div class="row league-info">
        <div class="col-sm-12">
            <h2>
                <img class="team-badge" src="{{{ $league->badge_image_url }}}" alt="{{{ $league->name }}} badge missing.">
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
                    <img class="team-image" src="{{{ $team->badge_image_url }}}" alt="{{{ $team->name }}} profile image missing.">
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