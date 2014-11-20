$(function () { 
	$("#search-form").submit(search);
});

function search(e) {

	var searchQuery = $('#search-box').val();
	console.log("search query is: " + searchQuery);
	var formObj = $(this);
	var formURL = formObj.attr("action");
	$.ajax({
		url: "players/search",
		type: 'POST',
		data: { 'search-box': $('#search-box').val() },

		success: function(data, textStatus, jqXHR) {

			$('#container')
				.empty()
				.append(
					$(data).find('.search-results')
				);

		},
		error:function(x,e) {

			console.log(x);
			if(x.status==0){
				alert('You are offline!!\n Please Check Your Network.');
			}else if(x.status==404){
				alert('Requested URL not found.');
			}else if(x.status==500){
				alert('Internel Server Error.');
			}else if(e=='parsererror'){
				alert('Error.\nParsing JSON Request failed.');
			}else if(e=='timeout'){
				alert('Request Time out.');
			}else {
				alert('Unknow Error.\n'+x.responseText);
			}
		}  
	});
	e.preventDefault();
};