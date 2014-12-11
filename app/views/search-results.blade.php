<?php 
// Define Output HTML Formating
$html = '';
$html .= '<li class="result">';
$html .= '<a target="_blank" href="urlString">';
$html .= '<h3>nameString</h3>';
$html .= '<h4>functionString</h4>';
$html .= '</a>';
$html .= '</li>';
Clockwork::info($results);
?>

@foreach($results as $result)
	<!-- $name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['name']); -->
	<li>{{{$result->name}}}</li>
@endforeach

@if(!$results->count())
	<div class="row well message">
    	There are no results for your search.  Sorry about that.
    </div>
@endif
