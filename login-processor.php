<?php
session_start();
require_once "dbinfo.php";
$errors = [];

// MySQL
$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check error
if (mysqli_connect_errno() != 0) {
    die ('DB Connection failed');
} else {
    echo "<p>Success</p>";
}

// Process
if (isset($_POST["username"]) &&
    isset($_POST["password"])) {
    // if it exists
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    }

$username = $db->real_escape_string($username);

$query = "SELECT password FROM secure_users WHERE BINARY username='$username';";
$result = $db -> query($query);

if($result->num_rows != 1){
	$_SESSION['errors'] = array ("<p class='error'>Invalid username. Try again...</p>");
	header("Location: main.php");
	die();
}

$record = $result->fetch_assoc();
$passwordFieldFromDatabase = $record['password'];


if(password_verify( $password, $passwordFieldFromDatabase) == false ){
	$_SESSION['errors'] = array ("<p class='error'>Invalid password. Try again...</p>");
	header("Location: index.php");
	die();	
}

else {
    // All Good
    $_SESSION["username"] = $username;
    $_SESSION['timeLoggedIn'] = time();
    $_SESSION['timeLastActive'] = time();

    header("location: main.php");
    exit();
}

?>
