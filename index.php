<?php 
session_start();
require_once "dbinfo.php";
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
    <section class="section-1">
<?php
if (isset($_SESSION["errors"])) {
    foreach ($_SESSION["errors"] as $error) {
        echo $error;
    }
    unset($_SESSION["errors"]);
}
?>
    <form action="login-processor.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        
        <input type="submit" value="Submit">
    </form>
    </section>
    </main>
    <footer>
    </footer>
    </div>
</body>

</html>