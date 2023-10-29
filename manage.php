<!DOCTYPE html>

<html lang="en">
<head>
<title>Manage Content</title>

<meta charset="utf-8">
<meta name="description" content="Manage Content">
<meta name="author" content="Tan Pham Duy">
<link rel="icon" type="image/x-icon" href="images/page_logo.png">
<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>

<body>

<div class="wrapper">

<div class="sidebar">
<form id="manage" method="post" action="manage.php"> 
<h3>Which method of searching do you prefer?</h3>
    <label><input class="needMargin" type="radio" name="action" value="1"/>List all EOIs.</label><br>
    <label><input class="needMargin" type="radio" name="action" value="2"/>List all EOIs for a particular position code.</label><br>
    <label><input class="needMargin" type="radio" name="action" value="3"/>List all EOIs for a particular applicant given their first name, last name or both.</label><br>
    <label><input class="needMargin" type="radio" name="action" value="4"/>Delete all EOIs with a specified job reference number.</label><br>
    <label><input class="needMargin" type="radio" name="action" value="5"/>Change the Status of an EOI.</label><br>
    <br>
    <div> <input  type="submit" value="Apply Search"/>
    <input  type="reset" value="Reset"/> </div>

    <a href="login.php">Logout?</a>
</form>
</div>

<div class="main">
<?php
    require_once("settings.php");
   
    // Prevent accessing directly from URL
        if(!isset($_SERVER['HTTP_REFERER'])){
            header('location:login.php');     
            exit;
        }

    function sanitise_input($data){ 
        $data = trim($data);				//remove spaces
        $data = stripslashes($data);		//remove backslashes in front of quotes
        $data = htmlspecialchars($data);	//convert HTML special characters to HTML code
        return $data;
    }

    function print_table($conn, $query) {
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        if (!$result) {
            echo "<p>Something is wrong with " . $query . "</p>";
        } elseif (empty($row)) { 
            // Check if there is any record returned by the query
            echo "<p>There is no record that match your description.</p>";
            mysqli_free_result($result);
        } else {
            $result = mysqli_query($conn, $query);
            echo "<table class=\"database\">";
            echo "<tr>\n"
            . "<th scope=\"col\">EOI number</th>\n"
            . "<th scope=\"col\">Job Reference Number</th>\n"
            . "<th scope=\"col\">First Name</th>\n"
            . "<th scope=\"col\">Last Name</th>\n"
            . "<th scope=\"col\">Street Address</th>\n"
            . "<th scope=\"col\">Suburb/Town</th>\n"
            . "<th scope=\"col\">State</th>\n"
            . "<th scope=\"col\">Postcode</th>\n"
            . "<th scope=\"col\">Email Address</th>\n"
            . "<th scope=\"col\">Phone Number</th>\n"
            . "<th scope=\"col\">Skills</th>\n"
            . "<th scope=\"col\">Other Skills</th>\n"
            . "<th scope=\"col\">Status</th>\n"
            . "</tr>\n";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>\n" 
                . "<td>" . $row["EOInumber"] . "</td>\n"
                . "<td>" . $row["JobReferenceNumber"] . "</td>\n"
                . "<td>" . $row["FirstName"] . "</td>\n"
                . "<td>" . $row["LastName"] . "</td>\n"
                . "<td>" . $row["StreetAddress"] . "</td>\n"
                . "<td>" . $row["SuburbTown"] . "</td>\n"
                . "<td>" . $row["State"] . "</td>\n"
                . "<td>" . $row["Postcode"] . "</td>\n"
                . "<td>" . $row["EmailAddress"] . "</td>\n"
                . "<td>" . $row["PhoneNumber"] . "</td>\n"
                . "<td>" . $row["Skills"] . "</td>\n"
                . "<td>" . $row["OtherSkills"] . "</td>\n"
                . "<td>" . $row["Status"] . "</td>\n"
                . "</tr>\n";
                
            }
            echo "</table>\n";

            #free up the memory, after using the result pointer
            mysqli_free_result($result);
        }   
    }

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Database connection failure</p>";
    } else {
        $sql_table = "eoi";

        if (empty($_POST["action"])) {
			echo "<p>Please select a search option.</p>";
		} else 
        { //action exists after this
            $action = sanitise_input($_POST["action"]);

            switch ($action) {
                case "1":
                    $query = "SELECT * FROM eoi ORDER BY EOInumber";
                    echo "<br>";
                    print_table($conn, $query);
                break;
                case "2":
                    echo "<p>
                    <form id=\"manage2\" method=\"post\" action=\"manage.php\"> 
                    <label for=\"jobID\">Which job ID do you want to search?
                    <select name=\"jobID\" id=\"jobID\" required>
                        <option value=\"\">Please select</option>
                        <option value=\"12690\">12690 (Software Engineer)</option>
                        <option value=\"13512\">13512 (IoT Programmer)</option>
                    </select>
                    </label>
                    
                    <input hidden name=\"action\" value=\"2\"/>
                    <br>
                    <br>
                    <div> <input  type=\"submit\" value=\"Apply Search\"/>
                    <input  type=\"reset\" value=\"Reset\"/> </div>
                    </form>
                    </p>"; 
                    if (!empty($_POST["jobID"])) {
                        $jobID = $_POST["jobID"];
                        $query = "SELECT * FROM eoi WHERE JobReferenceNumber = $jobID ORDER BY EOInumber";
                        print_table($conn, $query);
                    }     
                break;

                case "3":
                    echo "<p>
                    <form id=\"manage3\" method=\"post\" action=\"manage.php\"> 
                    <label>What is the name of the applicant you want to search?</label>
                    <br>
                    <label for=\"firstName\">First Name
                    <input type=\"text\" name=\"firstName\" id=\"firstName\" 
                    placeholder=\"E.g. Duy Tan\"
                    /></label>

                    <label for=\"familyName\">Last Name
                    <input type=\"text\" name=\"familyName\" id=\"familyName\" 
                    placeholder=\"E.g. Pham\"
                    /></label>
                    
                    <input hidden name=\"action\" value=\"3\"/>
                    <br>
                    <br>
                    <div> <input  type=\"submit\" value=\"Apply Search\"/>
                    <input  type=\"reset\" value=\"Reset\"/> </div>
                    </form>
                    </p>"; 
                    if (!(empty($_POST["firstName"]) AND empty($_POST["familyName"]))) {
                        if (!(empty($_POST["firstName"])) AND empty($_POST["familyName"])) {
                            $firstName = $_POST["firstName"];
                            $query = "SELECT * FROM eoi WHERE FirstName = '$firstName' ORDER BY EOInumber";
                        }
                        if (empty($_POST["firstName"]) AND !(empty($_POST["familyName"]))) {
                            $familyName = $_POST["familyName"];
                            $query = "SELECT * FROM eoi WHERE LastName = '$familyName' ORDER BY EOInumber";
                        }
                        if (!empty($_POST["firstName"]) AND !empty($_POST["familyName"])) {
                            $firstName = $_POST["firstName"];
                            $familyName = $_POST["familyName"];
                            $query = "SELECT * FROM eoi WHERE FirstName = '$firstName' AND LastName = '$familyName' ORDER BY EOInumber";
                        }
                        print_table($conn, $query);
                    } else {
                        echo "<p>Please enter the name of the applicant you're looking for. </p>";
                    }
                break;    

                case "4":
                    echo "<p>
                    <form id=\"manage4\" method=\"post\" action=\"manage.php\"> 
                    <label for=\"jobID\">Which job record do you want to delete using reference number? 
                    <select name=\"jobID\" id=\"jobID\" required>
                        <option value=\"\">Please select</option>
                        <option value=\"12690\">12690 (Software Engineer)</option>
                        <option value=\"13512\">13512 (IoT Programmer)</option>
                    </select>
                    </label>
                    
                    <input hidden name=\"action\" value=\"4\"/>
                    <br>
                    <br>
                    <div> <input  type=\"submit\" value=\"Delete Records\"/>
                    <input  type=\"reset\" value=\"Reset\"/> </div>
                    </form>
                    </p>"; 
                    if (!empty($_POST["jobID"])) {
                        $jobID = $_POST["jobID"];
                        $query = "DELETE FROM eoi WHERE JobReferenceNumber = $jobID";
                        $result = $conn->query($query);
                        echo "<p>Records with the chosen reference number have been deleted successfully.</p>";
                    }  
                break;

                case "5":
                    echo "<p>
                    <form id=\"manage5\" method=\"post\" action=\"manage.php\"> 
                    <label>Write the EOI number of the record you would want to update Status: </label>
                    <br>
                    <label for=\"EOInumber\">EOInumber:
                    <input type=\"number\" name=\"EOInumber\" id=\"EOInumber\" 
                    placeholder=\"E.g. 10\"
                    /></label>
                    
                    <label for=\"status\">Select the status you want to change to:
                    <select name=\"status\" id=\"status\">
                        <option value=\"\">Please select:</option>
                        <option value=\"1\">New</option>
                        <option value=\"2\">Current</option>
                        <option value=\"3\">Final</option>
                    </select>
                    </label>

                    <input hidden name=\"action\" value=\"5\"/>
                    <br>
                    <br>
                    <div> <input  type=\"submit\" value=\"Apply Change\"/>
                    <input  type=\"reset\" value=\"Reset\"/> </div>
                    </form>
                    </p>"; 

                    if (empty($_POST["EOInumber"]) OR empty($_POST["status"])) {
                        echo "<p>Please enter both an EOI number and a status</p>";
                    } else {
                        $EOInumber = $_POST["EOInumber"];
                        $status = $_POST["status"];
                        $query = "UPDATE eoi SET Status=$status WHERE EOInumber=$EOInumber ";
                        $result = $conn->query($query);
                        echo "<p>The record's status has been updated successfully</p>";
                    }
                break;
            }
            mysqli_close($conn);
        }   
    }
?>
</div> <!-- for main -->
</div> <!-- for wrapper -->

</body>
</html>