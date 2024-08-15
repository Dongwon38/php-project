<?php
const TIMEOUT_IN_SECONDS = 3600;

if (isset($_SESSION['timeLastActive'])) {
    $timeNow    = time();
    $timeLastActive = $_SESSION['timeLastActive'];
    $timeSinceLastRequest = $timeNow - $timeLastActive;

    if($timeSinceLastRequest > TIMEOUT_IN_SECONDS) {
        $_SESSION["errors"] = array("<p>You have been logged out due to inactivity</p>");
        header("location: index.php");
        exit();
    } else {
        $_SESSION['timeLastActive'] = time();    
    }
} else {
    $_SESSION["errors"] = array("<p>Who are you? You need to log in!!</p>");
    header("location: index.php");
    exit();
}

?>