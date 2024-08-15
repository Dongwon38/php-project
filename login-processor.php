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
    $user = trim($_POST["username"]);
    $pass = trim($_POST["password"]);

    echo "<p>user: ".$user."</p>";
    echo "<p>pass: ".$pass."</p>";
}

$query = "SELECT * FROM users WHERE BINARY username='$user';";
$result = $db -> query($query);

if ($oneRecord = $result->fetch_row()) {
    // username Found

    // Password check
    if ($pass != $oneRecord[2]) {
        // Password NOT Found
        $errors[] = "<p>It is Invaild for user <strong>$user</strong>. Try again...</p>"; 
    }
} else {
    // username NOT Found
    $errors[] = "<p>Invalid username. Try again...</p>";
}

if (count($errors) > 0) {
    $_SESSION["errors"] = $errors;
    header("location: index.php");
    exit();
} else {
    // All Good
    $_SESSION["username"] = $user;
    $_SESSION['timeLoggedIn'] = time();
    $_SESSION['timeLastActive'] = time();

    header("location: main.php");
    exit();
}

?>