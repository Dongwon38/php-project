<?php 
session_start();

$username = "";
$password = "";

if(!isset($_POST['username']) || !isset($_POST['password']) ){
	$_SESSION['errorMessages'] = "<p class='error'>Please login...</p>";
	header("Location: login.php");
	die();
}
if( trim($_POST['username'])=="" ||  trim($_POST['password'])=="" ){
	$_SESSION['errorMessages'] = "<p class='error'>Please fill in the form...</p>";
	header("Location: index.php");
	die();
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

require_once("../dbinfo.php");

$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if(mysqli_connect_errno() !=0 ){
	$_SESSION['errorMessages'] = "<p class='error'>Could not connect to database to login.</p>";
	header("Location: index.php");
	die();
}

$username = $database->real_escape_string($username);
$password = $database->real_escape_string($password);

$query = "SELECT password FROM secure_users WHERE BINARY username='$username';";
$result = $database->query($query);

if($result->num_rows != 1){
	$_SESSION['errorMessages'] = "<p class='error'>Invalid username. Try again...</p>";
	header("Location: login.php");
	die();
}

$record = $result->fetch_row();
$passwordFieldFromDatabase = $record[0];


if(password_verify( $password, $passwordFieldFromDatabase) == false ){
	$_SESSION['errorMessages'] = "<p class='error'>Invalid password. Try again...</p>";
	header("Location: login.php");
	die();	
}

$database->close();

$_SESSION['username'] = ucfirst(strtolower($username));

header("Location: main.php");
die();

?>

