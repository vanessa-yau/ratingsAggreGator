@extends('master')

@section('style')
     {{ HTML::style("/css/leagues.css") }}
@stop

@section('content')
    <div class="leagues">
        <h2>Leagues</h2>
        @if( $leagues )
            @foreach( $leagues as $league )
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default" data-id="{{{ $league->id }}}">
                            <div class="panel-heading league">
                                <img src="{{ $league->badge_image_url }}" alt="...">
                                <span>
                                    <strong class="league-name">{{{ $league->name }}}</strong> 
                                    <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                                </span>
                            </div>
                            <div class="panel-body league-teams">
                                <div class="row">
                                    @foreach( $league->teams as $team )
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <a href="{{ $team->url }}"><p>{{ $team->name }}</p></a>
                                        </div>
                                    @endforeach
                                </div> <!-- close row -->
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@stop

@section('js')
    <script>
        $(function(){
            $( '.league' ).click(function(e){
                var $this = $(e.target);
                e.preventDefault();
                var isHidden = $this.siblings().is( ":hidden" );
                if( isHidden ){
                    $this.siblings().not('.league-name').slideDown(400, function() {
                        $this.find('i').removeClass('glyphicon-chevron-down')
                            .addClass('glyphicon-chevron-up');
                        }
                    );
                }
                else{
                    $this.siblings().not('.league-name').slideUp(400, function() {
                        $this.find('i').removeClass('glyphicon-chevron-up')
                            .addClass('glyphicon-chevron-down');
                        }
                    );
                }
            });
        });
    </script>
@stop