/* 
 * rules file for the registration form.
 */

$().ready(function() {


	// validate registration form on keyup and submit
	$("#regform").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			password: {
				required: true,
				minlength: 5
			},
			email: {
				required: true,
				email: true
			}
                    },
		messages: {
			firstname: "Please enter your firstname",
			lastname: "Please enter your lastname",
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			email: "Please enter a valid email address"
		}
	});

	
});


