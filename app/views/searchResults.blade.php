@extends('master')

@section('content')
<div class="search-results">
	<div class="row">
		<div class="col-md-11">

			@foreach ($results as $result)

			<!-- Make a thumbnail for each of the users -->
			<div class="col-sm-2"> 
            	<img id="profile-image" src="{{{ $result->image_url }}}" alt="Image of player">
        	</div>
			@endforeach
			<p>hi</p>
		</div>
	</div>
</div>
@stop

