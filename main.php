<?php 
session_start();
require_once "dbinfo.php";
require_once "security.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>PHP & MySQL</title>

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
        <h1>PHP & MySQL</h1>
        <img src="./images/bg.jpg" alt="illustrated-country">
    </header>

    <main>
    <nav>
        <ul>
            <li><a href="main.php">Show all</a></li>
        </ul>
    </nav>
    <section class="section-1">
    <?php
    echo "<h2>Logged in</h2>";
    echo "<p>Hello, ".$_SESSION['username']. ". You are authorized to view the content.</p>";
    echo "<p><a href='logout.php'>Logout</a></p>";
    ?>
    </section>
    <section class="section-data">
<?php
    // MySQL
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno() != 0) {
        die ("<p>Could not connect to DB</p>");
    }
    // Sorting
    $acceptableSortws = array("id", "firstname", "lastname");

    $defaultSort = "id";
    if (isset($_GET['sort'])) {
        if (in_array($_GET['sort'], $acceptableSortws)) {
            $defaultSort = $_GET['sort'];
        }
    }

    $query = "SELECT id, firstname, lastname FROM students ORDER BY $defaultSort;";
    $result = $mysqli->query($query);

    $numberOfRecord = $result->num_rows;

    // messages print
    if (isset($_SESSION['messages'])) {
        foreach($_SESSION['messages'] as $msg) {
            echo $msg;
        }
    unset($_SESSION['messages']);
    }




    echo "<p>There are $numberOfRecord registered student(s):</p>";
    
    echo "<a href='crud-data.php?type=add'>Add a Student</a>";
    

    // Data table
    echo "<table>";

    // table head
    $arrayOfFieldNames = $result->fetch_fields();
    echo "<tr>";
    foreach ($arrayOfFieldNames as $fieldName) {
        echo "<th><a href='".$_SERVER['PHP_SELF']."?sort=$fieldName->name'>$fieldName->name</a></th>";
    }
    echo "<th> Delete </th>";
    echo "<th> Update </th>";
    echo "</tr>";

    // table data 
    while ( $oneRecord = $result -> fetch_row()) {
        $id = $oneRecord[0];
        echo "<tr>";
        foreach ($oneRecord as $field) {
            echo "<td> $field </td>";
        }
        echo "<td><a href='crud-data.php?type=delete&id=$id'>delete</a></td>";
        echo "<td><a href='crud-data.php?type=update&id=$id'>update</a></td>";
        echo "</tr>";
    }

    echo "</table>";


?>
    </section>
    </main>
    <footer>
    </footer>
    </div>
</body>

</html>