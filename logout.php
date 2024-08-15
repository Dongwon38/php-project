<?php 
session_start();
require_once "security.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Assignment 5</title>

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
            <h1>log out page</h1>
            <img src="./images/bg.jpg" alt="illustrated-country">
        </header>
        <h3 class="name-tag">Project by: Gustavo & Dongwon</h3>
        <main>
        <section class="section-1">
<?php

    $timeLasting = time() - $_SESSION['timeLoggedIn'];

    echo "<p> You were logged in for ".$timeLasting." seconds. Thanks for you time, ".$_SESSION['username']."!</p>";
    echo "<p>If you would like to see the data again, you will need to log in.</p>";

$_SESSION = array();
session_destroy();
?>
            <a class="link-home"href="index.php">Login</a>
            </section>
        </main>
        <footer>

        </footer>
    </div>
</body>

</html>