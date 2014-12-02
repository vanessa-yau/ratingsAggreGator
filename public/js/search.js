$(function () { 
	// For the moment - get a good, un-ajax search working,
	// then worry about building in the ajax search
	// 2014-11-21
	// $("#search-form").submit(search);
	$(".search-form").submit(function (e) {
		e.preventDefault();
		$('#search-icon').removeClass().addClass("fa fa-circle-o-notch fa-spin");

		// turn spaces into + for lovely URLs
		var query = $(this).find('[name=search-box]').val();
		if (query != "" && query != null) {
			query = query.replace(' ', '+');
			window.location = ('/search/' + query);

		}
		else {
			return false;
		}
		// transition to the required page
	});
});

// function search(e) {

// 	var searchQuery = $('.search-box').val();
// 	console.log("search query is: " + searchQuery);
// 	var formObj = $(this);
// 	var formURL = formObj.attr("action");
// 	$.ajax({
// 		url: "/players/search",
// 		type: 'GET',
// 		data: { 'search-box': $('#search-box').val() },

// 		success: function(data, textStatus, jqXHR) {

// 			$('#container')
// 				.empty()
// 				.append(
// 					$(data).find('.search-results')
// 				);

// 		},
// 		error:function(x,e) {

// 			console.log(x);
// 			if(x.status==0){
// 				alert('You are offline!!\n Please Check Your Network.');
// 			}else if(x.status==404){
// 				alert('Requested URL not found.');
// 			}else if(x.status==500){
// 				alert('Internel Server Error.');
// 			}else if(e=='parsererror'){
// 				alert('Error.\nParsing JSON Request failed.');
// 			}else if(e=='timeout'){
// 				alert('Request Time out.');
// 			}else {
// 				alert('Unknow Error.\n'+x.responseText);
// 			}
// 		}  
// 	});
// };