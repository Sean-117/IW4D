<?php
require_once 'login.php';
if (session_status() ===PHP_SESSION_NONE) {
    session_start();
}

if(!(isset($_SESSION['givenname']) && isset($_SESSION['surname']))) {
    header("Location: https://bioinfmsc8.bio.ed.ac.uk/~$username/complib.php");
    exit;
}
?>
