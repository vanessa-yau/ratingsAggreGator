@extends('master')

@section('style')
	{{ HTML::style("/css/search-results.css") }}
@stop

@section('content')
	<div class="search-results">
		<h2>Search Results for "{{{ strtoupper($searchQuery) }}}"</h2>
    		@if($results->count() > 0)
	    	<div class="row">
	        	@foreach ($results as $result)
		            <a href="{{ $result->url }}">
			        	<div class="col-xs-12 col-sm-6 col-lg-4 player-card">
			        		<div class="row">
								<!-- Make a thumbnail for each of the players found by the search -->
								<div class="col-sm-4 player-image">
			                        <img class="profile-image" src="{{{ $result->image_url }}}" alt="Image of player">
			                    </div>
			                    <div class="col-sm-8 player-info">
		                    		<strong>{{{ $result->name }}} </strong>
		                    		<br />
		                    		<strong>{{{ $result->nationality }}} </strong>
		                    		<br />
		                    		<br />
								</div>
			                </div>
			        	</div>
		            </a>
	        	@endforeach
		    </div>
		    <div class="row">
		    	<div class="col-sm-12 pagination-links">
		    	{{ $results->appends(array('query' => $searchQuery))->links() }}

		    	</div>
		    </div>
	    @else
    	<div class="row well message">
    		<div class="col-sm-12">
	    		There are no results for your search.  Sorry about that.
    		</div>
    	</div>
    @endif
	</div>
@stop

