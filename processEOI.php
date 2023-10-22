<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>processing</title>
</head>
<body>
<?php

	//Data sanitisation func
	function sanitise_input($data){ 
        $data = trim($data);				//remove spaces
        $data = stripslashes($data);		//remove backslashes in front of quotes
        $data = htmlspecialchars($data);	//convert HTML special characters to HTML code
        return $data;
    }

	function checking_state_postcode ($state, $postcode){
		
	}

	//Deny direct access from browser
	if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		die("<h1>Access Denied</h1>");
	}

	//db connection
	require_once("settings.php");
	$conn = @mysqli_connect(
		$host,
		$user,
		$pwd,
		$sql_db
	);

	if (!$conn) { 
		echo "<h2>Database connection failure</h2>
				<p>Please try again</p>";
	} else {
		//Input getting and sanitation
		$position_code = sanitise_input($_POST["jobNum"]);
		$firstname = sanitise_input($_POST["firstName"]);
		$lastname = sanitise_input($_POST["familyName"]);
		$DOB = sanitise_input($_POST["birthday"]);
		$gender = "";
		if (isset ($_POST["gender"])) {
            $gender = $_POST["gender"];
		}
		$email = sanitise_input($_POST["email"]);		
		$phone = sanitise_input($_POST["telephone"]);	
		$street_address = sanitise_input($_POST["streetAddress"]);	
		$suburb = sanitise_input($_POST["suburb"]);
		$state = sanitise_input($_POST["state"]);
		$postcode = sanitise_input($_POST["postcode"]);		
		
		//Input Validation
		$errormsg = "";
		if (!preg_match('/^[A-Za-z0-9]{5}$/', $position_code)) {
			$errormsg = "<p>Position code must be exactly 5 alphanumeric characters.</p>";
		}
		if (!preg_match("/^[a-zA-Z ]{1,25}$/", $firstname )){	//Firstname Validation
			$errormsg .= "<p>First name must be only alphabetical characters and it must between 1-25 characters.</p>\n";
		}
		if (!preg_match("/^[a-zA-Z ]{1,25}$/", $lastname)) { 	//Lastname Validation
				$errormsg .= "<p>Last name must be only alphabetical characters and it must between 1-25 characters.</p>\n";
		}
		if (!preg_match('/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/((19|20)\d\d)$/', $DOB)) { //dob Validation
			$errormsg .= "<p>Invalid date of birth. Please enter a valid date in the format dd/mm/yyyy and make sure you are between 15 and 80 years old.</p>";
		}
		if (empty($gender)) {
			$errormsg .= "<p>Your gender must be chosen</p>";
		}
		if (!preg_match("/\S+@\S+\.\S+/", $email)) {	 		//email validation
			$errormsg .= "<p>Your email must be in the format of something@something.something</p>\n";
		}

		if (!preg_match("/^\d{8,12}$/", $phone)) {				//phone number validation
			$errormsg .= "<p>Your phone number must contains only numbers and in between 8-12 digits length .</p>\n";
		}
	
		if (!preg_match("/^[a-zA-Z0-9 ,.'-]{1,40}$/", $street_address)) {//address validation
			$errormsg .= "<p>Your address must contains only alphabetical characters, numbers, commas, dots and hyphens.</p>\n";
		}
		if (!preg_match("/^[a-zA-Z]{1,40}$/", $suburb)) {		//Suburb validation
			$errormsg .= "<p>Your suburb must contains only alphabetical characters and in between 1-20 characters length.</p>\n";
		}

		if (empty($state)){								//State Validation
			$errormsg .= "<p>You must select your state.</p>\n";
		}
		if (!preg_match("/^\d{4}$/", $postcode)) {			//Post code validation
			$errormsg .= "<p>Your post code must be a 4-digit number.</p>\n";
		} else {
				
				}	
		if ($errormsg != ""){
			echo ("<p>$errormsg</p>");
		} else {

			#Testing output of data Input and validation
			echo "<p>Position Code: $position_code</p>";
			echo "<p>First Name: $firstname</p>";
			echo "<p>Last Name: $lastname</p>";
			echo "<p>Gender: $gender</p>";
			echo "<p>Email: $email</p>";
			echo "<p>Date of Birth: $DOB</p>";
			echo "<p>Street Address: $street_address</p>";
			echo "<p>Suburb: $suburb</p>";
			echo "<p>State: $state</p>";
			echo "<p>Postcode: $postcode</p>";		
		}
	}
	 
    
		
?>
</body>
</html>