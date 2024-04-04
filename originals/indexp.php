<?php
session_start();
require_once 'login.php';

if(isset($_POST['fn']) && isset($_POST['sn'])) {
    $_SESSION['forname'] = htmlspecialchars($_POST['fn']);
    $_SESSION['surname'] = htmlspecialchars($_POST['sn']);
    $smask = $_SESSION['supmask'] ?? 'Not set';

    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Page</title>
</head>
<body>
HTML;

    include 'menuf.php';

    echo <<<HTML
<pre>
   Mask Value: $smask
</pre>
</body>
</html>
HTML;
} else {
    header("Location: https://bioinfmsc8.bio.ed.ac.uk/~$username/complib.php");
}
?>
