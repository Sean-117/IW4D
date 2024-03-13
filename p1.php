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

echo '<!DOCTYPE html><html lang="en"><head><meta charset="UTF-8"><title>Select Suppliers</title></head><body>';
echo 'Currently selected Suppliers: ';
foreach ($sact as $sid => $isActive) {
    if ($isActive) {
        echo $manufacturers[$sid - 1]['name'], " ";
    }
}
echo '<br><pre><form action="p1.php" method="post">';
foreach ($manufacturers as $manufacturer) {
    echo htmlspecialchars($manufacturer['name']),
    ' <input type="checkbox" name="supplier[]" value="',
    htmlspecialchars($manufacturer['name']), '"',
    $sact[$manufacturer['id']] ? ' checked' : '', '/><br>';
}
echo '<input type="submit" value="OK" /></form></pre></body></html>';
?>
