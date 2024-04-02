<?php
session_start();
require_once 'login.php';
include 'redir.php';
include 'menuf.php';

// connecting to db
try {
    $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Unable to connect to database: " . $e->getMessage());
}

// query all suppliers
try {
    $stmt = $pdo->query("SELECT * FROM Manufacturers");
    $manufacturers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Unable to process query: " . $e->getMessage());
}

$smask = $_SESSION['supmask'] ?? 0;
$sact = [];

foreach ($manufacturers as $manufacturer) {
    $sid = $manufacturer['id'];
    $snm = $manufacturer['name'];
    $tvl = 1 << ($sid - 1);
    $sact[$sid] = ($tvl & $smask) ? 1 : 0;
}

if(isset($_POST['supplier'])) {
    $supplier = $_POST['supplier'];
    $smask = 0;
    foreach ($supplier as $supName) {
        foreach ($manufacturers as $manufacturer) {
            if ($supName == $manufacturer['name']) {
                $smask |= (1 << ($manufacturer['id'] - 1));
            }
        }
    }
    $_SESSION['supmask'] = $smask;
    // calculate the activity status
    foreach ($manufacturers as $manufacturer) {
        $sid = $manufacturer['id'];
        $tvl = 1 << ($sid - 1);
        $sact[$sid] = ($tvl & $smask) ? 1 : 0;
    }
}

echo '<!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Suppliers</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4">Currently selected Suppliers:</h2>';
foreach ($sact as $sid => $isActive) {
    if ($isActive) {
        echo '<span class="badge bg-primary me-2">' . $manufacturers[$sid - 1]['name'] . '</span>';
    }
}
echo '<form action="p1.php" method="post" class="mt-3">';
foreach ($manufacturers as $manufacturer) {
    echo '<div class="form-check">
            <input class="form-check-input" type="checkbox" name="supplier[]" value="',
    htmlspecialchars($manufacturer['name']), '"',
    $sact[$manufacturer['id']] ? ' checked' : '',
    ' id="flexCheckDefault', htmlspecialchars($manufacturer['id']), '">
            <label class="form-check-label" for="flexCheckDefault', htmlspecialchars($manufacturer['id']), '">',
    htmlspecialchars($manufacturer['name']), '</label>
        </div>';
}
echo '<button type="submit" class="btn btn-primary mt-3">Submit</button></form></div></body></html>';
?>
