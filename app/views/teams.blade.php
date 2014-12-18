@extends('master')

@section('style')
    {{ HTML::style("/css/teams.css") }}
@stop

@section('content')
    <div class="teams">
        <h2>Teams</h2>
        @if( $teams )
            @foreach( $teams as $team )
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default" data-id="{{{ $team->id }}}">
                            <div class="panel-heading team">
                                <img src="{{ $team->badge_image_url }}" alt="...">
                                <span>
                                    <strong class="team-name">{{{ $team->name }}}</strong> 
                                    <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                                </span>
                            </div>
                            <div class="panel-body team-players">
                                <div class="row">
                                    @foreach( $team->lastKnownPlayers as $player )
                                        <div class="col-xs-12 col-sm-6 col-md-3">
                                            <a href="{{ $player->url }}"><p><strong>{{ $player->name }}</strong></p></a>
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
            $( '.team' ).click(function(e){
                var $this = $(e.target);
                e.preventDefault();
                var isHidden = $this.siblings().is( ":hidden" );
                if( isHidden ){
                    $this.siblings().not('.team-name').slideDown(400, function() {
                        $this.find('i').removeClass('glyphicon-chevron-down')
                            .addClass('glyphicon-chevron-up');
                        }
                    );
                }
                else{
                    $this.siblings().not('.team-name').slideUp(400, function() {
                        $this.find('i').removeClass('glyphicon-chevron-up')
                            .addClass('glyphicon-chevron-down');
                        }
                    );
                }
            });
        });
    </script>
@stop