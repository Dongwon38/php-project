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

echo "<h2>type: $type</h2>";

// Process for Add & Update
if (isset($_POST["student-id"]) &&
    isset($_POST["firstname"]) &&
    isset($_POST["lastname"])) {
    // if it exists
    $idIncoming = trim($_POST["student-id"]);
    $firstname = trim($_POST["firstname"]);
    $lastname = trim($_POST["lastname"]);

    echo "<p>id-current: ".$idCurrent."</p>";
    echo "<p>id-incoming: ".$idIncoming."</p>";
    echo "<p>first: ".$firstname."</p>";
    echo "<p>last: ".$lastname."</p>";

    $idRegex = "/^a0[0-9]{7}$/i";
    
    // Check if it is a valid format
    if( preg_match( $idRegex, $idIncoming ) === 1 ){
        // Valid pattern

        // get the data to check if the ID duplicate
        $query = "SELECT * FROM students WHERE id='$idIncoming';";
        $result = $mysqli->query($query);
        $record = $result->fetch_row();

        // Check
        if($record == null) {
            // OK
           
            switch ($type) {
                    // UPDATE
                case 'update':
                    $query = "UPDATE students SET id='$idIncoming', firstname='$firstname', lastname='$lastname' WHERE id='$idCurrent'";
                    $result = $mysqli->query($query);      
                    $messages = ["<p>Record Updated: ".$idIncoming." ".$firstname." ".$lastname."</p>"];                      
                    break;

                    // ADD
                case 'add':
                    $query = "INSERT INTO students VALUES($idIncoming, $firstname, $lastname)";
                    $result = $mysqli->query($query);
                    $messages = ["<p>Record Added: ".$idIncoming." ".$firstname." ".$lastname."</p>"]; 
                    break;
                
            }
           
           
           

        } else if ($record[1]) {
            // NOT OK (duplicate)
            $messages = ["<p>That ID already exists.</p>"];
        } 




    } else {
        // Invalid pattern
        $messages = ["<p>The student ID you entered is incorrect. It must be in the format A0#######.</p>"];
    }
}

// Process for Delete
if (isset($_POST['confirm'])) {
    // if it exists
    $confirm = $_POST['confirm'];
   
    switch ($confirm) {
        case "yes":
            // delete the data
            // echo "DELETE FROM students WHERE id='$idIncoming';";
            $messages = ["<p>Record Deleted: ".$_SESSION["id-incoming"]." ".$_SESSION["firstname"]." ".$_SESSION["lastname"]."</p>"];
            break;

        case "no":
            $messages = ["<p>The record was not deleted since you selected No.</p>"];
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