
<?php


// Database connection code here
require ("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

$username = $_POST['username'];
$password = $_POST['password'];


$sql = "SELECT * FROM managers WHERE username = '$username'";
$check_lock_database = "SELECT account_locked FROM managers WHERE username = '$username'";
$result = $conn->query($sql);
$result1 = $conn->query($check_lock_database);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Check if the password is correct
    if ($password == $hashed_password) {

        

        // Reset login attempts and update last login timestamp
        $reset_attempts = "UPDATE managers SET login_attempts = 0, last_login_attempt = NOW() WHERE username = '$username'";
        $conn->query($reset_attempts);

        
        

        header("Location: manage.php");
        exit;
    } else {
        $update_attempts = "UPDATE managers SET login_attempts = login_attempts + 1, last_login_attempt = NOW() WHERE username = '$username'";
        $conn->query($update_attempts);

        $attempts = $row['login_attempts'] + 1;
        if ($attempts >= 6) {
            $lock_account = "UPDATE managers SET account_locked = 1 WHERE username = '$username'";
            $conn->query($lock_account);
            echo "Your account has been locked. Please contact the manager team."; 
        }

        echo "Invalid password. Try again.";
    }
} else {
    $update_attempts = "UPDATE managers SET login_attempts = login_attempts + 1, last_login_attempt = NOW() WHERE username = '$username'";
    $conn->query($update_attempts);
    echo "Username not found.";
}




if ($result1->num_rows == 1) {
    $row = $result1->fetch_assoc();
    if ($row["account_locked"] == 1) {
        echo "Your account is locked. Please contact support for assistance.";
        exit;
    }
}

$conn->close();
?>
