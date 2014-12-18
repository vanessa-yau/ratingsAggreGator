@extends('master')

@section('style')
	{{ HTML::style("/css/search-results.css") }}
@stop

@section('content')
	<div class="search-results">
    		@if($results->count() > 0)
	    	<div class="row">
	        	@foreach ($results as $result)
		            <a href="{{ $result->url }}">
			        	<div class="col-xs-12 col-sm-6 col-lg-4">
			        		<div class="row">
								<!-- Make a thumbnail for each of the players found by the search -->
			                        <img class="profile-image" src="{{{ $result->image_url }}}" alt="Image of player">
			                    	<h4>
			                    		<p> <strong> {{{ $result->name }}} </strong> </p>
			                    		<p> <strong> {{{ $result->nationality }}} </strong> </p>
			                    		<p> <strong> Plays for: {{{ Team::find($result->last_known_team)->name }}}</strong> </p>        		
		  
			                    	</h4>
			                    	<p>
		            					
			                    	</p>
			                </div>
			        	</div>
		            </a>
	        	@endforeach
		    </div>
		    <div class="row">
		    	<div class="col-sm-12 pagination-links">
		    		{{ $results->links() }}
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

