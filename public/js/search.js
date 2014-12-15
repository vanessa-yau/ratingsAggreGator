/* JS File */

// Start Ready
$(document).ready(function() {  

	// Icon Click Focus
	$('div.icon').click(function(){
		$('input#search').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search(query_value) {
		
		query_value = $.trim(query_value);
		// if (e.type == "keyup" );
		// 	alert( "hi" );

		if(query_value){
			query_value = query_value.replace(' ', '+');
			console.log("query is:" + query_value);
			$.ajax({
				type: "GET",
				url: window.routes.players.search,
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#results").html(html);
				}
			});
		}return false;    
	}

	$("input#search").on("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results").fadeOut();
			$('h4#results-text').fadeOut();
		}else{
			$("ul#results").fadeIn();
			$('h4#results-text').fadeIn();
			$(this).data('timer', setTimeout(function () {
				search(search_string);
			}, 100));
		};
	});

});