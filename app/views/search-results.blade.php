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
		        	<div class="col-sm-6">
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
		                    		{{{ $result->lastKnownTeam->name }}}
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
    @else
    	<div class="row well message">
    		There are no results for your search.  Sorry about that.
    	</div>
    @endif
</div>
@stop

@section('js')
	<script>
		$(function() {
			$('#search-icon').removeClass().addClass("glyphicon glyphicon-search");
		});
	</script>
@stop

