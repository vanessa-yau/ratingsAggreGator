@extends('master')

@section('content')
    <div class="leagues">
        <h2>Leagues</h2>
        @if( $leagues )
            @foreach( $leagues as $league )
                <div class="row">
                    <div class="col-sm-12">
                        <a href="#">
                            <h3 class="league">{{{ $league->name }}}</h3>
                        </a>
                        <div class="row league-teams">
                            @foreach( $league->teams as $team )
                                <div class="col-xs-12 col-sm-6 col-lg-4">
                                    <p>{{ $team->name }}</p>
                                </div> 
                            @endforeach
                        </div> <!-- close row -->
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@stop

@section('js')
    <script>
        $(function(){
            $('.league-teams').hide();

            $( '.league' ).click(function(e){
                e.preventDefault();
                $(this).find('league-teams').show();
            });
        });
    </script>
@stop