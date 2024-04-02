<?php
session_start();
require_once 'login.php';

if (isset($_POST['fn']) && isset($_POST['sn'])) {
    $_SESSION['forname'] = htmlspecialchars($_POST['fn']);
    $_SESSION['surname'] = htmlspecialchars($_POST['sn']);
    $smask = $_SESSION['supmask'] ?? 'Not set';

    echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
HTML;

    include 'menuf.php';

    echo <<<HTML
        <div class="card">
            <div class="card-header">
                Welcome, {$_SESSION['forname']} {$_SESSION['surname']}
            </div>
            <div class="card-body">
                <h5 class="card-title">Session Details</h5>
                <p class="card-text">Mask Value: $smask</p>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
HTML;
} else {
    header("Location: https://bioinfmsc8.bio.ed.ac.uk/~$username/complib.php");
}
?>
