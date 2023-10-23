<?php
session_start();
// Database connection code here
require ("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

$username = $_POST['username'];
$password = $_POST['password'];

// Retrieve user's data from the database
$sql = "SELECT * FROM managers WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Check if the password is correct
    if ($password == $hashed_password) {
        // Reset login attempts and update last login timestamp
        $reset_attempts_sql = "UPDATE managers SET login_attempts = 0, last_login_attempt = NOW() WHERE username = '$username'";
        $conn->query($reset_attempts_sql);

        // Store manager's ID in the session for access control
        $_SESSION['manager_id'] = $row['id'];

        header("Location: manage.php");
        exit;
    } else {
        // Password is incorrect
        $update_attempts_sql = "UPDATE managers SET login_attempts = login_attempts + 1, last_login_attempt = NOW() WHERE username = '$username'";
        $conn->query($update_attempts_sql);

        $attempts = $row['login_attempts'] + 1;
        if ($attempts >= 3) {
            // Lock the account if there are 3 or more failed login attempts
            // You can implement account lockout logic here
            // For example, set a flag or disable the account temporarily
        }

        echo "Invalid password. Try again.";
    }
} else {
    echo "Username not found.";
}

$conn->close();
?>
