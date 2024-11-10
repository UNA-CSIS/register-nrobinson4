<?php
// start session
session_start();
include 'validate.php';

$user = test_input($_POST['user']);
$pwd = test_input($_POST['pwd']);
// login to the softball database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "softball";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// select password from users where username = <what the user typed in>
$sql = "SELECT password FROM users where username='$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    $row = $result->fetch_assoc();
    $pass_hash = $row['password'];
    
    $verified = password_verify($pwd, $pass_hash);
    if ($verified) {
        $_SESSION['username'] = $user;
        header("location:index.php");
        exit();
    } else {
        header("location:index.php");
        exit();
    }
       
} else {
    header("location:index.php");
    exit();
   }
$conn->close();


// if no rows, then username is not valid (but don't tell Mallory) just send
// her back to the login

// otherwise, password_verify(password from form, password from db)

// if good, put username in session, otherwise send back to login

