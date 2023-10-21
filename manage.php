<!DOCTYPE html>
<html lang="en">
<head>
<title>Manage Content</title>

<meta charset="utf-8">
<meta name="description" content="Manage Content">
<meta name="author" content="Tan Pham Duy">
</head>

<body>

<h1>List of Actions</h1>
<ol>
    <li>List all EOIs</li>
    <li>List all EOIs for a particular position</li>
    <li>List all EOIs for a particular applicant given their first name, last name or both.</li>
    <li>Delete all EOIs with a specified job reference number</li>
    <li>Change the Status of an EOI</li>
</ol>

<?php
    require ("settings.php");

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Database connection failure</p>";
    } else {
        $sql_table = "eoi";
    
        $query = "SELECT * FROM eoi ORDER BY EOInumber";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "<p>Something is wrong with " . $query . "</p>";
        } else {
            echo "<table border=\"1\">";
            echo "<tr>\n"
            . "<th scope=\"col\">EOI number</th>\n"
            . "<th scope=\"col\">Job Reference Number</th>\n"
            . "<th scope=\"col\">First Name</th>\n"
            . "<th scope=\"col\">Last Name</th>\n"
            . "<th scope=\"col\">Date of Birth</th>\n"
            . "<th scope=\"col\">Gender</th>\n"
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
                . "<td>" . $row["DateOfBirth"] . "</td>\n"
                . "<td>" . $row["Gender"] . "</td>\n"
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
        mysqli_close($conn);
    }

?>
</body>
</html>