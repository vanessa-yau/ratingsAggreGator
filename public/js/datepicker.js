//Javascript file to add the datepicker class to any fields with a datepicker id
$(document).ready(
	function () {
		$( "#datepicker" ).datepicker({
		  changeMonth: true,//Allow users to select a month
		  changeYear: true, //Allow users to select a year
		  yearRange: "1905:2014",
		  dateFormat: 'dd-mm-yy' 
		});
	}

	);