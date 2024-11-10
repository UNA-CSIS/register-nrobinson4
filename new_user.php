<?php
// session start here...
session_start();
include 'validate.php';
// get all 3 strings from the form (and scrub w/ validation function)

// make sure that the two password values match!

// create the password_hash using the PASSWORD_DEFAULT argument
$user = test_input($_POST['user']);
$pwd = test_input($_POST['pwd']);
$repeat = test_input($_POST['repeat']);

// login to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";


if ($pwd !== $repeat) {
    header("location:register.php");
}
$hashed_pwd = password_hash($pwd, PASSWORD_DEFAULT);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// make sure that the new user is not already in the database
$sql = "SELECT * from users where username='$user'";
$result = $conn->query($sql);

// USER exists, returns to registration
if ($result->num_rows > 0) {
    $_SESSION['error'] = "User already taken";
    header("location:register.php");
} else {
    $sql = "INSERT into users (username, password) values ('$user', '$hashed_pwd')";
    if ($conn->query($sql) === TRUE) {
        echo "New Record created";
        header("location:index.php");
    }
    header("location:index.php");
}
$conn->close();






// insert username and password hash into db (put the username in the session
// or make them login)

