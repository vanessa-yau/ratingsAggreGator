@extends('master')

@section('content')
	<div class="search-results">
	    <div class="row">
	        <div class="col-md-11">
	            @foreach ($results as $result)
	                <div class="col-md-11">

	                    <!-- Make a thumbnail for each of the players found by the search -->
	                        <a href="{{ $result->url }}">
	                            <img id="profile-image" src="{{{ $result->image_url }}}" alt="Image of player">
	                        </a>
	                </div>
	            @endforeach
	        </div>
	        
	    </div>
	    {{ $results->links() }}
	</div>
@stop

