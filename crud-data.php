<?php 
session_start();
require_once "dbinfo.php";
require_once "security.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add student</title>

    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="description"
        content="BCIT FWD Web Scripting 2: Using PHP and MySQL to develop server side solutions for web development.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
<div id="wrapper">
    <header>
        <h1>Add Student</h1>
        <img src="./images/bg.jpg" alt="illustrated-country">
    </header>

    <main>
    <nav>
        <ul>
            <li><a href="main.php">Show all</a></li>
        </ul>
    </nav>
    <section class="section-crud">
<?php 
// MySQL
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno() != 0) {
    die ("<p>Could not connect to DB</p>");
}

// set the TYPE
if (isset($_GET['type'])) {
    switch ($_GET['type']) {
        case 'add':
            $type = "Add";
            break;
        case 'delete':
            $type = "delete";
            break;
        case 'update':
            $type = "Update";
            break;
        }
    $_SESSION['type'] = $type;
    }
?>

<?php

// set default value for the form
$valueId ="";
$valueFirstname ="";
$valueLastname ="";

// get data
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $query = "SELECT id, firstname, lastname FROM students WHERE id='$id'";
    $result = $mysqli->query($query);
    $record = $result->fetch_assoc();

    // for current page
    $valueId = $record["id"];
    $valueFirstname = $record["firstname"];
    $valueLastname = $record["lastname"];


    // session data for general 
    $_SESSION["id-current"] = $record["id"];
    
    // session data for delete
    $_SESSION["id-incoming"] = $record["id"];
    $_SESSION["firstname"] = $record["firstname"];
    $_SESSION["lastname"] = $record["lastname"];
}

// Form
if ($type == "delete") {
    // Delete
    echo "<h2>$type a Student</h2>";

    echo "<p>student id: $valueId</p>";
    echo "<p>Firstname: $valueFirstname</p>";
    echo "<p>Lastname: $valueLastname</p>";
    
    echo "<h3>Are you sure you want to delete this record?</h3>";

    echo "<form action='crud-processor.php' method='POST'>";
    echo "<div class='input-box'>";
    echo "    <label for='yes'>Yes</label>";
    echo "    <input type='radio' name='confirm' id='yes' value='yes' required>";
    echo "</div>";
    echo "<div class='input-box'>";
    echo "    <label for='no'>No</label>";
    echo "    <input type='radio' name='confirm' id='no' value='no' required>";
    echo "</div>";
    echo "    <input type='submit' value='Submit'>";
    echo "</form>";

} else {
    // Add or Update
    echo "<h2>$type a Student</h2>";

    echo "<form action='crud-processor.php' method='POST'>";
    echo "<div class='input-box'>";
    echo "        <label for='student-id'>Student #</label>";
    echo "        <input type='text' name='student-id' id='student-id' value=$valueId>";
    echo "    </div>";
    echo "    <div class='input-box'>";
    echo "        <label for='firstname'>Firstname</label>";
    echo "        <input type='text' name='firstname' id='firstname' value=$valueFirstname>";
    echo "    </div>";
    echo "    <div class='input-box'>";
    echo "        <label for='lastname'>Lastname</label>";
    echo "        <input type='text' name='lastname' id='lastname' value=$valueLastname>";
    echo "    </div>";
    echo "    <input type='submit' value='Submit'>";
    echo "</form>";
}
?>
    </section>
    </main>
    <footer>
    </footer>
    </div>
</body>

</html>