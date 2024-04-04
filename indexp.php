<?php
session_start();
require_once 'login.php';

if(isset($_POST['gn']) && isset($_POST['sn'])) {
    $_SESSION['givenname'] = htmlspecialchars($_POST['gn']);
    $_SESSION['surname'] = htmlspecialchars($_POST['sn']);
    $smask = $_SESSION['supmask'] ?? 'Not set';

    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
</head>
<body>
HTML;

    include 'menuf.php';

    echo <<<HTML
</body>
</html>
HTML;
} else {
    header("Location: https://bioinfmsc8.bio.ed.ac.uk/~$username/complib.php");
}
?>
