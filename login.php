<!DOCTYPE html>
<html>
<head>
    <title>Manager Login</title>
</head>
<body>
    <h1>Manager Login</h1>
    <form action="processlogin.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
