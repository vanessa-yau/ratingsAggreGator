// $(document).ready(function() {  

// 	$("#search-form").on("submit", function(e) {

// 		// e.preventDefault();
// 		console.log('foo');
// 		// Set Timeout
// 		clearTimeout($.data(this, 'timer'));

// 		// Set Search String
// 		var search_string = $('#search').val();

// 		console.log("query is:" + search_string);
// 		// Do Search
// 		$(this).data('timer', setTimeout(function () {
// 			search(search_string);
// 		}, 100));
// 		return false;
// 	});


// });

// Live Search
// On Search Submit and Get Results
function search(query_value) {
	
	var query_value = $.trim(query_value);
	// if (e.type == "keyup" );
	// 	alert( "hi" );

	if(query_value){
		query_value = query_value.replace(' ', '+');
		console.log("query is:" + query_value);
		$.ajax({
			type: "GET",
			url: '/search/',
			data: { query: query_value },
			cache: false,
			success: function(json){
				// window.location = ('/search/' + query_value);
				// console.log(json);
			}
		});
	}
	return false;    
}