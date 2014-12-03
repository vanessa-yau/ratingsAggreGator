@extends('master')

@section('style')
    <style>
        .league-teams {
            display: none;
        }

        img {
            max-width: 50px;
            max-height: 50px;
        }
    </style>
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
                                <img src="/images/leagues/englishpremier.jpg" alt="...">
                                {{{ $league->name }}}
                                <i class="glyphicon glyphicon-chevron-down pull-right"></i>
                            </div>
                            <div class="panel-body league-teams">
                                <div class="row">
                                    @foreach( $league->teams as $team )
                                        <div class="col-xs-12 col-sm-6 col-lg-4">
                                            <p>{{ $team->name }}</p>
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
                    $this.siblings().slideDown(400, function() {
                        $this.find('i').removeClass('glyphicon-chevron-down')
                            .addClass('glyphicon-chevron-up');
                        }
                    );
                }
                else{
                    $this.siblings().slideUp(400, function() {
                        $this.find('i').removeClass('glyphicon-chevron-up')
                            .addClass('glyphicon-chevron-down');
                        }
                    );
                }
            });
        });
    </script>
@stop