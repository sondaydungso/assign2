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

	function state_postcode_validation ($state, $postcode){
		$postcode = (int)$postcode;
		$msgerror = "";
		switch ($state) {
			//VIC
			case "VIC":
				if (($postcode <= 2999 || $postcode >= 4000) && ($postcode <= 7999 || $postcode >= 9000)) {
					$msgerror = "<p>VIC postcode must be in the range of 3000 - 3999 or 8000 - 8999</p>";
				}
				break;
			
			//NSW
			case "NSW":
				if (($postcode <= 999|| $postcode >= 2000) && 
					($postcode <= 1999|| $postcode >= 2600) && 
					($postcode <= 2618|| $postcode >= 2899) &&
					($postcode <= 2922|| $postcode >= 3000)
				) {
					$msgerror = "<p>NSW postcode must be in the range of 1000 - 1999 or 2000 - 2599 or 2619 - 2898 or 2921 - 2999</p>";
				}
				break;
					 
			//ACT
			case "ACT":
				if (($postcode <= 199|| $postcode >= 300) &&
				($postcode <= 2599|| $postcode >= 2619) &&
				($postcode <= 2899|| $postcode >= 2919) 
				) {
					$msgerror = "<p>ACT postcode must be in the range of 200 - 299 or 2600 - 2620 or 2900 - 2920</p>";
				}
				break;

			//QLD	
			case "QLD":
				if (($postcode <= 3999|| $postcode >= 5000) &&
				 	($postcode <= 8999 || $postcode >= 10000)
				 ) {
					$msgerror = "<p>QLD postcode must be in range of 4000 - 4999 or 9000 - 9999</p>";
				} 
				break;
			
			//SA
			case "SA":
				if (($postcode <= 4999|| $postcode >= 5800) &&
					($postcode <= 5799|| $postcode >= 6000)
				) {
					$msgerror = "<p>SA postcode must be in range of 5000 - 57999 or 5800 - 5999</p>";
				}
				break;

			//WA
			case "WA":
				if (($postcode <= 5999 || $postcode >= 6798) &&
					($postcode <= 6799 || $postcode >= 7000) 
				) {
					$msgerror = "<p>WA postcode must be in range of 6000 - 6797 or 6800 - 6999</p>";
				}
				break;

			//TAS
			case "TAS":
				if (($postcode <= 6999|| $postcode >= 7800) &&
					($postcode <= 7799|| $postcode >= 8000)
				)	{
					$msgerror = "<p>TAS postcode must be in range of 7000 - 7799 or 7800 - 7999</p>";
				}
				break;

			//NT
			case "NT":
				if (($postcode <= 799|| $postcode >= 900) &&
					($postcode <= 899|| $postcode >= 1000)
				) {
					$msgerror = "<p>NT postcode must be in range of 800 - 899 or 900 - 999</p>";
				}
				break;

 		}

		return $msgerror;
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
				$errormsg .= state_postcode_validation($state, $postcode);
				}	
		if ($errormsg != ""){
			echo ("$errormsg");
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