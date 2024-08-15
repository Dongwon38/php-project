<?php
session_start();
require_once "dbinfo.php";
$messages = [];

// MySQL Start
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno() != 0) {
    die ("<p>Could not connect to DB</p>");
}

if ($_SESSION['type'] && 
    $_SESSION["id-current"]) {
    $idCurrent = trim($_SESSION["id-current"]);
    $type = trim($_SESSION['type']);
}

// Process for Add & Update
if (isset($_POST["student-id"]) &&
    isset($_POST["firstname"]) &&
    isset($_POST["lastname"])) {
    // if it exists
    $idIncoming = trim($_POST["student-id"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);
    
    // Check if it is a valid format
    $idRegex = "/^a0[0-9]{7}$/i";
    if( preg_match( $idRegex, $idIncoming ) === 1 ){
        // Valid pattern

        // get the data to check if the ID duplicate
        $query = "SELECT * FROM students WHERE id='$idIncoming';";
        $result = $mysqli->query($query);
        $record = $result->fetch_row();

        // if it's unique OR it's the same with its own
        if($record == null || $record[1] == $idCurrent) {
            // OK
            switch ($type) {
                // UPDATE
                case 'update':
                    $query = "UPDATE students SET id='$idIncoming', firstname='$firstname', lastname='$lastname' WHERE id='$idCurrent'";
                    $result = $mysqli->query($query);      
                    $messages = ["<p class='ok'>Record Updated: ".$idIncoming." ".$firstname." ".$lastname."</p>"];                      
                    break;
                    
                // ADD
                case 'add':
                    $query = "INSERT INTO students VALUES(null, '$idIncoming', '$firstname', '$lastname')";
                    $result = $mysqli->query($query);
                    $messages = ["<p class='ok'>Record Added: ".$idIncoming." ".$firstname." ".$lastname."</p>"]; 
                    break;
            }
        } else if ($record[1]) {
            // NOT OK (duplicate)
            $messages = ["<p class='err'>That ID already exists.</p>"];
        } 
    } else {
        // Invalid pattern
        $messages = ["<p class='err'>The student ID you entered is incorrect. It must be in the format A0#######.</p>"];
    }
}

// Process for Delete
if (isset($_POST['confirm'])) {
    // if it exists
    $confirm = $_POST['confirm'];
   
    switch ($confirm) {
        case "yes":
            // delete the data
            $query = "DELETE FROM students WHERE id='".$_SESSION["id-incoming"]."'";
            $result = $mysqli->query($query);
            $messages = ["<p class='ok'>Record Deleted: ".$_SESSION["id-incoming"]." ".$_SESSION["firstname"]." ".$_SESSION["lastname"]."</p>"];
            break;

        case "no":
            $messages = ["<p class='err'>The record was not deleted since you selected No.</p>"];
            break;
    }
}

// results
if (count($messages) > 0) {
    $_SESSION["messages"] = $messages;
    header("location: main.php");
    exit();
}
?>