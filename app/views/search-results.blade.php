@extends('master')

@section('style')
	{{ HTML::style("/css/search-results.css") }}

@section('content')
	<div class="search-results">
    	<div class="row">
        	@foreach ($results as $result)
            <a href="{{ $result->url }}">
	        	<div class="col-xs-12 col-sm-6 col-lg-4">
	        		<div class="row well">
	        			<div class="col-sm-4">
						<!-- Make a thumbnail for each of the players found by the search -->
	                        <img class="profile-image" src="{{{ $result->image_url }}}" alt="Image of player">
	        			</div>
	        			<div class="col-sm-8">
	                    	<h4>
	                    		<strong>{{{ $result->name }}}</strong>
	                    	</h4>
	                    	<p>
            					{{{ $result->nationality }}}<br />
	                    		
	                    	</p>
	        			</div>
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
	    	@if (count($results) === 1)
	    		<div class="col-xs-12 col-sm-6 col-lg-4">
	    		<h2> There are no results for that player. </h2>
	    		</div>
	    	</div>
	    	@endif
	</div>
@stop

