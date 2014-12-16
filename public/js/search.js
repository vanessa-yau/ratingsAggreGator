$(function () { 
	// For the moment - get a good, un-ajax search working,
	// then worry about building in the ajax search
	// 2014-11-21
	// $("#search-form").submit(search);
	$("#search-form").submit(function (e) {
		e.preventDefault();

		// turn spaces into + for lovely URLs
		var query = $(this).find('[name=search-box]').val();
		console.log("search is..." + query);
		query = query.replace(' ', '+');

		// transition to the required page
		window.location = ('/search/' + query);
	});
});