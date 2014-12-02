//Function to check the validity of an email address

function validateEmail(email) {

    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        //alert("Not a valid e-mail address");
        return false;
    }
    else {
    	return true;
    }
}

//Function to sign up the user to the website
function register(e) {

	e.preventDefault(); //Prevent Default action.
	var formObj = $(this);
	var formURL = formObj.attr("action");
	var valid = validateRegistrationForm();
	if (valid) { 
		$.ajax({
			url: "/register",
			type: 'POST',
			data: { 'first_name'	: $('#first_name').val(),
					'surname'		: $('#surname').val(),
					'username'		: $('#username').val(), 
					'password' 		: $('#password').val(),
					'email_address' : $('#email_address').val(),
					'country' 		: $('#country').val(),
					'town/city'		: $('#town-city').val(),
			},		

			success: function(data, textStatus, jqXHR) {
				console.log('success');
				window.location = '/';
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
	}
}

//Event handler
$(function () {
	$('#registration_form').on('propertychange keyup input paste change', function (e)  {
		console.log("in registration validation function..");
		validateRegistrationForm();
	});
});

//Event handler
$(function () { 
	$("#registration_form").submit(register); 
	console.log('hooked up to validation');

});

//Function to check the validty of input values in the registration form
function validateRegistrationForm() {

	var firstName		= $('#first_name').val();
	var surname			= $('#surname').val();
	var username		= $('#username').val(); 
	var password 		= $('#password').val();
	var retypePassword 	= $('#confirm-password').val();
	var email			= $('#email_address').val();	
	var country			= $('#country').val();
	var townCity		= $('#town-city').val();
	
	//Validate first name field
	if (firstName != "") {
		if (firstName.length <= 20) {
			$('#first_name').parent().removeClass('has-error');
			$('#first_name').parent().addClass('has-success');
			$('#first_name_help').text("");
		}
		else {
			$('#first_name').parent().removeClass('has-success');
			$('#first_name').parent().addClass('has-error');
			$('#first_name_help').text("First Name must not be more than 20 characters");
		}
	}
	else {
		$('#first_name').parent().removeClass('has-success');
		$('#first_name').parent().addClass('has-error');
		$('#first_name_help').text("Please enter a first name");
	}

	//Validate surname field
	if (surname != "") {
		if (surname.length <= 20) {
			$('#surname').parent().removeClass('has-error');
			$('#surname').parent().addClass('has-success');
			$('#surname_help').text("");
		}
		else {
			$('#surname').parent().removeClass('has-success');
			$('#surname').parent().addClass('has-error');
			$('#surname_help').text("Surname must not be more than 20 characters");
		}
	}
	else {
		$('#surname').parent().removeClass('has-success');
		$('#surname').parent().addClass('has-error');
		$('#surname_help').text("Please enter a surname");
	}

	//Validate username field
	if (username != "") {
		if (username.length >=5 && username.length <=30) {
			$('#username').parent().removeClass('has-error');
			$('#username').parent().addClass('has-success');
			$('#username_help').text("");
		}
		else {
			$('#username').parent().removeClass('has-success');
			$('#username').parent().addClass('has-error');
			$('#username_help').text("Usernames must be between 5 and 30 characters");
		}
	}
	else {
		$('#username').parent().removeClass('has-success');
		$('#username').parent().addClass('has-error');
		$('#username_help').text("Please enter a username");
	}

	if ( ( password !="" ) && ( retypePassword !="" ) ) {
		console.log("both fields filled in");
		$('#confirm-password_help').text('');
		if ( ( password.length >= 8 && password.length <= 20) 
				&& (retypePassword.length >= 8 && retypePassword.length <= 20) ) {
			if ( password == retypePassword ) {
				console.log("Both passwords match");
				//Remove error
				$('#password').parent().removeClass('has-error');
				$('#confirm-password').parent().removeClass('has-error');
				//Add success
				$('#password').parent().addClass('has-success');
				$('#confirm-password').parent().addClass('has-success');
				//Remove help message (if it is currently displayed)
				$('#confirm-password_help').text('');

			} else if ( password != retypePassword ) {
				console.log("The passwords do not match");
				//Remove success
				$('#password').parent().removeClass('has-success');
				$('#confirm-password').parent().removeClass('has-success');
				//Add error
				$('#password').parent().addClass('has-error');
				$('#confirm-password').parent().addClass('has-error');
				//Add help message
				$('#confirm-password_help').text('Both passwords must match');

			}
		} else if ( ( password.length < 8 || password.length > 20 )
				|| ( retypePassword.length < 8 || retypePassword.length > 20 ) ) {
			console.log("Both passwords must be between 8 and 20 characters");
			//Remove success
			$('#password').parent().removeClass('has-success');
			$('#confirm-password').parent().removeClass('has-success');
			//Add error
			$('#password').parent().addClass('has-error');
			$('#confirm-password').parent().addClass('has-error');
			//Add help message
			$('#confirm-password_help').text('Both passwords must be between 8 and 20 characters');

		}
	} else {
		console.log("Both must be filled in!");
		//Remove success
		$('#password').parent().removeClass('has-success');
		$('#confirm-password').parent().removeClass('has-success');
		//Add error
		$('#password').parent().addClass('has-error');
		$('#confirm-password').parent().addClass('has-error');
		//Add help message
		$('confirm-password_help').text('Both fields must be filled in');

	}

	//Validate email address field
	if (email != "") {
		if (validateEmail(email) ) {
			$('#email_address').parent().removeClass('has-error');
			$('#email_address').parent().addClass('has-success');
			$('#email_address_help').text("");
		}
		else {
			$('#email_address').parent().removeClass('has-success');
			$('#email_address').parent().addClass('has-error');
			$('#email_address_help').text("Please enter a valid email address");
		}
	}
	else {
		$('#email_address').parent().removeClass('has-success');
		$('#email_address').parent().addClass('has-error');
		$('#email_address_help').text("Please enter an email address");
	}

	//Validate country field
	if (country != "" && country != "Choose here" && country != null) {
			$('#country').parent().removeClass('has-error');
			$('#country').parent().addClass('has-success');
			$('#country_help').text("");
	}
	else {
		$('#country').parent().removeClass('has-success');
		$('#country').parent().addClass('has-error');
		$('#country_help').text("Please select a country");
	}

	//Validate town/city field
	if (townCity != "") {
			$('#town-city').parent().removeClass('has-error');
			$('#town-city').parent().addClass('has-success');
			$('#town_city_help').text("");
	}
	else {
	
		$('#town-city').parent().removeClass('has-success');
		$('#town-city').parent().addClass('has-error');
		$('#town_city_help').text("Please enter a town or city");
	}
	
	return $('#registration_form .has-error').length == 0;
	
}