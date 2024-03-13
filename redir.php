<?php
if (session_status() ===PHP_SESSION_NONE) {
    session_start();
}

$user = getenv('USER');

if(!(isset($_SESSION['forname']) && isset($_SESSION['surname']))) {
    header("Location: https://bioinfmsc8.bio.ed.ac.uk/~$username/complib.php");
    exit;
}
?>
