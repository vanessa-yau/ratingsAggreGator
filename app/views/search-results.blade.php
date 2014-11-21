@extends('master')

@section('content')
<div class="search-results">
	<div class="row">
		

			@foreach ($results as $result)

				<div class="col-md-11">

					<!-- Make a thumbnail for each of the users -->
						<a href="{{ $result->url }}">
		            		<img id="profile-image" src="{{{ $result->image_url }}}" alt="Image of player">
		            	</a>
		        </div>
			@endforeach
		
	</div>
	<?php echo $results->links(); ?>
</div>
@stop

