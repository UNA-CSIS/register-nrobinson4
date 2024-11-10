<?php session_start();

// PHP null coalescing operator ?? (PHP 7.0+)
$user = $_SESSION['username'] ?? "Guest";

?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        Welcome, <?= $user ?>
        <p />
        
        <form action="authenticate.php" method="POST">
            Username: <input type="text" name="user"><br>
            Password: <input type="password" name="pwd"><br>
            <input type="submit">
        </form>
        <a href="register.php">Register a new login</a>
        <p>
        <a href="games.php">UNA NCAA Championship Season</a>
    </body>
</html>
