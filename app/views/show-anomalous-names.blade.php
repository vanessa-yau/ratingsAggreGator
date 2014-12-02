<title>Anomalous names</title>
<h1>Anomalous names found in Players table</h1>
<p>Scroll down to view, delete...</p>

@foreach ($anomalousNames as $anomalousName)
	<li>{{ $anomalousName->name }}</li>
@endforeach	 

<p>Are <strong>ALL</strong> these names anomalous? If so, delete them from the DB</p>

<form 
    name="anomalousPlayers-form" 
    role="form" 
    method="get"
    action = "{{ urldecode(URL::route('anomalousPlayers.delete', $anomaly)) }}" 
>
<button class="btn btn-default" type="submit">Delete</button>
</form>


