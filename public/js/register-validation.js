//Function to check the validity of an email address

function validateEmail(email) {

	//Check the specified email address contains an @ sign and at least one dot (.). 
	//also check that the @ sign is not the first character of the email address
	//and check that the last dot is present after the @ sign, and a minimum  of 
	//2 characters before the end

    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");
    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=email.length) {
        return false;
    } else {
    	return true;
    }
}

//Function to submit the register form via ajax
function register(e) {

	e.preventDefault(); //Prevent Default action.
	var formObj = $(this);
	var formURL = formObj.attr("action");
	var valid = validateRegistrationForm();
	if (valid) { 
		$.ajax({
			url: "register",
			type: 'POST',
			data: { 'first_name'	: $('#first_name').val(),
					'surname'		: $('#surname').val(),
					'username'		: $('#username').val(), 
					'password' 		: $('#password').val(),
					'email_address' : $('#email_address').val(),
					'country' 		: $('#country').val(),
					'city'			: $('#city').val(),
			},		

			success: function(data, textStatus, jqXHR) {
				//Redirect user to home page if login was successful
				window.location = '/';
			},
			error: function(jqXHR, textStatus, errorThrown) {
				//throw error
			   	var responseText = $.parseJSON(e.responseText);
	                showErrorMessage(responseText);
	                $('body').scrollTop(0);
			}
		});
	}
}

//Event handler
$(function () {
	//Detect changes in the input placed in the registration form
	$('#registration_form').on('propertychange keyup input paste change', function (e)  {
		validateRegistrationForm();
	});
});

//Event handler
$(function () { 
	//Submit the form
	$("#registration_form").submit(register); 
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
	var city			= $('#city').val();

	//Check first name field is filled in and has no more than 20 characters
	if (firstName != "") {
		if (firstName.length <= 20) {
			//Show field is ok
			$('#first_name').parent().removeClass('has-error').addClass('has-success');
			$('#first_name_help').text("");
		}
		else {
			//Show field has error and provide help info
			$('#first_name').parent().removeClass('has-success').addClass('has-error');
			$('#first_name_help').text("First Name must not be more than 20 characters");
		}
	}
	else {
		//Show field has error and provide help info
		$('#first_name').parent().removeClass('has-success').addClass('has-error');
		$('#first_name_help').text("Please enter a first name");
	}

	//Check surname field is filled in and has no more than 20 characters
	if (surname != "") {
		if (surname.length <= 20) {
			//Show field is ok
			$('#surname').parent().removeClass('has-error').addClass('has-success');
			$('#surname_help').text("");
		}
		else {
			//Show field has error and provide help info
			$('#surname').parent().removeClass('has-success').addClass('has-error');
			$('#surname_help').text("Surname must not be more than 20 characters");
		}
	}
	else {
		//Show field has error and provide help info
		$('#surname').parent().removeClass('has-success').addClass('has-error');
		$('#surname_help').text("Please enter a surname");
	}

	//Validate username field
	if (username != "") {
		if (username.length >=5 && username.length <=30) {
			//Show field is ok
			$('#username').parent().removeClass('has-error').addClass('has-success');
			$('#username_help').text("");
		}
		else {
			//Show field has error and provide help info
			$('#username').parent().removeClass('has-success').addClass('has-error');
			$('#username_help').text("Usernames must be between 5 and 30 characters");
		}
	}
	else {
		//Show field has error and provide help info
		$('#username').parent().removeClass('has-success').addClass('has-error');
		$('#username_help').text("Please enter a username");
	}

	//Validate that the 'password' and 'confirm password' fields are the same
	if ( ( password !="" ) && ( retypePassword !="" ) ) {
		$('#confirm-password_help').text('');
		if ( ( password.length >= 8 && password.length <= 20) 
				&& (retypePassword.length >= 8 && retypePassword.length <= 20) ) {
			if ( password == retypePassword ) {
				//Show field is ok
				$('#password').parent().removeClass('has-error').addClass('has-success');
				$('#confirm-password').parent().removeClass('has-error').addClass('has-success');
				$('#password_help').text('');

			} else if ( password != retypePassword ) {
				//Show field has error and provide help info
				$('#password').parent().removeClass('has-success').addClass('has-error');
				$('#confirm-password').parent().removeClass('has-success').addClass('has-error');
				$('#password_help').text('Both passwords must match');

			}
		} else if ( ( password.length < 8 || password.length > 20 )
				|| ( retypePassword.length < 8 || retypePassword.length > 20 ) ) {
			//Show field has error and provide help info
			$('#password').parent().removeClass('has-success').addClass('has-error');
			$('#confirm-password').parent().removeClass('has-success').addClass('has-error');
			$('#password_help').text('Both passwords must be between 8 and 20 characters');

		}
	} else {
		//Show field has error and provide help info
		$('#password').parent().removeClass('has-success').addClass('has-error');
		$('#confirm-password').parent().addClass('has-error').removeClass('has-success');
		$('#password_help').text('Both password fields must be filled in');

	}

	//Check email address is valid as per the validateEmail function
	if (email != "") {
		if (validateEmail(email) ) {
			//Show field is ok
			$('#email_address').parent().removeClass('has-error').addClass('has-success');
			$('#email_address_help').text("");
		}
		else {
			//Show field has error and provide help info
			$('#email_address').parent().removeClass('has-success').addClass('has-error');
			$('#email_address_help').text("Please enter a valid email address");
		}
	}
	else {
		$('#email_address').parent().removeClass('has-success').addClass('has-error');
		$('#email_address_help').text("Please enter an email address");
	}

	//Check user has chosen a country from the dropdown box
	if (country != "" && country != "Select..." && country != null) {
			//Show field is ok
			$('#country').parent().removeClass('has-error').addClass('has-success');
			$('#country_help').text("");
	}
	else {
		//Show field has error then change default option to "choose a country" (as a hint)
		$('#country').parent().removeClass('has-success').addClass('has-error');
		$('#country').append("<option selected disabled style=display:none;>" + "Choose a country" + "</option>");
		$('#country_help').text("Please select a country");

	}

	//Check a town/city has been specified
	if (city != "") {
			//Show field is ok
			$('#city').parent().removeClass('has-error').addClass('has-success');
			$('#city_help').text("");
	}
	else {
			//Show field has error and provide help info
		$('#city').parent().removeClass('has-success').addClass('has-error');
		$('#city_help').text("Please enter a town or city");
	}
	//Return number of fields with errors (used to determine whether form can be submitted)
	return $('#registration_form .has-error').length == 0;
	
}