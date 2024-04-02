<?php
session_start();
include 'redir.php';

$fn = htmlspecialchars($_SESSION['forname']);
$_SESSION = array();
if(session_id() != "" || isset($_COOKIE[session_name()])) {
  setcookie(session_name(), '', time() - 2592000, '/');
}
session_destroy();

echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goodbye</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container text-center py-5">
        <h1 class="mb-3">Goodbye, $fn</h1>
        <p class="lead">You have now exited Complib.</p>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
HTML;
?>
