<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>processing</title>
</head>
<body>
<?php
    $errormsg = "";
    function sanitise_input($data){
        $data = trim($data);				//remove spaces
        $data = stripslashes($data);		//remove backslashes in front of quotes
        $data = htmlspecialchars($data);	//convert HTML special characters to HTML code
        return $data;
    }
    function checkInt($number){		//return true if number is a positive integer
        $number = filter_var($number, FILTER_VALIDATE_INT);
        return ($number !== FALSE && $number > 0);
    }
    $firstname = sanitise_input($_POST["First_name"]);
    if (!preg_match("/^[a-zA-Z]{1,20}$/", $firstname )){
        $errormsg .= "<p >First name must be only alphabetical characters and it must between 1-25 characters.</p>\n";
    }
    $lastname = sanitise_input($_POST["last_Name"]);		
		
    if (!preg_match("/^[a-zA-Z]{1,20}$/", $lastname)) {
	        $errormsg .= "<p >Last name must be only alphabetical characters and it must between 1-25 characters.</p>\n";
	}

	    //Last name validation
	    $email = sanitise_input($_POST["Email"]);			
		if (!preg_match("/\S+@\S+\.\S+/", $email)) {
	        $errormsg .= "<p >Your email must be in the format of yourname@domain.xxx</p>\n";
	    }

        $phone = sanitise_input($_POST["Phone_number"]);			//sanitise input
		if (!preg_match("/^\d{8,12}$/", $phone)) {
	        $errormsg .= "<p>Your phone number must contains only numbers and in between 8-12 digits length .</p>\n";
	    }

        
	    $street_address = sanitise_input($_POST["Street"]);		
		if (!preg_match("/^[a-zA-Z0-9 ,.'-]{1,40}$/", $address)) {
	        $errormsg .= "<p>Your address must contains only alphabetical characters, numbers, commas, dots and hyphens.</p>\n";
	    }
	    //Suburb validation


	    $suburb = sanitise_input($_POST["Suburb/town"]);			
		if (!preg_match("/^[a-zA-Z]{1,40}$/", $suburb)) {
	        $errormsg .= "<p>Your suburb must contains only alphabetical characters and in between 1-40 characters length.</p>\n";
	    }
	    //State validation


	    $state = sanitise_input($_POST["State"]);			
		if ($state == "none"){								
			$errormsg .= "<p>You must select your state.</p>\n";
		}


        $postcode = sanitise_input($_POST["Postcode"]);		//sanitise input
		if (!preg_match("/^\d{4}$/", $postcode)) {
	        $errormsg .= "<p>Your post code must be a 4-digit number.</p>\n";
	    }
	    else{
	    	switch ($state){
			case "VIC":
				if ($postcode[0] != "3" && $postcode[0] != "8"){					//VIC post code must start with 3 or 8
					$errormsg .= "<p>VIC post code must start with 3 or 8.</p>\n";
				}
			case "NSW":
				if ($postcode[0] != "1" && $postcode[0] != "2"){					//NSW post code must start with 1 or 2
					$errormsg  .= "<p>NSW post code must start with 1 or 2.</p>\n";
				}
			case "QLD":
				if ($postcode[0] != "4" && $postcode[0] != "9"){					//QLD post code must start with 4 or 9
					$errormsg  .= "<p>QLD post code must start with 4 or 9.</p>\n";
				}
			case "WA":
				if ($postcode[0] != "6"){										//NA post code must start with 6
					$errormsg  .= "<p>WA post code must start with 6.</p>\n";
				}
			case "SA":
				if ($postcode[0] != "5"){										//SA post code must start with 5
					$errormsg  .= "<p>SA post code must start with 5.</p>\n";
				}
			case "TAS":
				if ($postcode[0] != "7"){										//TAS post code must start with 7
					$errormsg  .= "<p>TAS post code must start with 7.</p>\n";
				}
			case "ACT":
				if ($postcode[0] != "0"){										//NT and ACT post code must start with 0
					$errormsg .= "<p>ACT post code must start with 0.</p>\n";
				}
			}
	    }	
		if (isset($_POST['gender'])){
			$gender = $_POST['gender'];
		}else{
			$errormsg .= "<p> Please select the gender </p>\n"
		} 
?>
</body>
</html>