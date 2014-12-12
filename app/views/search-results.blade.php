<?php 
echo Clockwork::info($results);
?>
		<div class="results">
			<ul>
				@foreach($results as $result)
					<li class="result"> <a href="/players/search/{{{$result->name}}}"> {{{$result->name}}} </a> </li>
				@endforeach
			</ul>
		</div>
@if(!$results->count())
	<div class="row well message">
    	There are no results for your search.  Sorry about that.
    </div>
@endif
