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

// fetch suppliers' info
$smask = $_SESSION['supmask'] ?? 0;
$mansel = " AND (0"; // no selection by default
$stmt = $pdo->query("SELECT id FROM Manufacturers");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  if ((1 << ($row['id'] - 1)) & $smask) { // whether is selected
    $mansel .= " OR ManuID = " . $row['id'];
  }
}
$mansel .= ")";

$setpar = isset($_POST['natmax']);

echo <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Retrieval Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
HTML;

include 'menuf.php';
echo "<h2>This is the catalogue retrieval Page</h2>";

if ($setpar) {
  $conditions = [];
  $params = [];
  $fields = [
      'natm' => ['natmin', 'natmax'],
      'ncar' => ['ncrmin', 'ncrmax'],
      'nnit' => ['nntmin', 'nntmax'],
      'noxy' => ['noxmin', 'noxmax']
  ];

  foreach ($fields as $field => $bounds) {
    list($min, $max) = $bounds;
    if (!empty($_POST[$min]) && !empty($_POST[$max])) {
      $conditions[] = "($field > :$min AND $field < :$max)";
      $params[$min] = $_POST[$min];
      $params[$max] = $_POST[$max];
    }
  }

  if (!empty($conditions)) {
    $compsel = "SELECT catn FROM Compounds WHERE " . implode(' AND ', $conditions) . $mansel;
    $stmt = $pdo->prepare($compsel);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 100) {
      echo "<p>Too many results, max is 100</p>";
    } else {
      foreach ($results as $row) {
        echo "<p>" . htmlspecialchars($row['catn']) . "</p>";
      }
    }
  } else {
    echo "<p>No Query Given</p>";
  }
}

echo <<<'FORM'
        <form action="p2.php" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="natmax" class="form-label">Max Atoms</label>
                <input type="text" class="form-control" name="natmax" id="natmax">
            </div>
            <div class="col-md-6">
                <label for="natmin" class="form-label">Min Atoms</label>
                <input type="text" class="form-control" name="natmin" id="natmin">
            </div>
            <div class="col-md-6">
                <label for="ncrmax" class="form-label">Max Carbons</label>
                <input type="text" class="form-control" name="ncrmax" id="ncrmax">
            </div>
            <div class="col-md-6">
                <label for="ncrmin" class="form-label">Min Carbons</label>
                <input type="text" class="form-control" name="ncrmin" id="ncrmin">
            </div>
            <div class="col-md-6">
                <label for="nntmax" class="form-label">Max Nitrogens</label>
                <input type="text" class="form-control" name="nntmax" id="nntmax">
            </div>
            <div class="col-md-6">
                <label for="nntmin" class="form-label">Min Nitrogens</label>
                <input type="text" class="form-control" name="nntmin" id="nntmin">
            </div>
            <div class="col-md-6">
                <label for="noxmax" class="form-label">Max Oxygens</label>
                <input type="text" class="form-control" name="noxmax" id="noxmax">
            </div>
            <div class="col-md-6">
                <label for="noxmin" class="form-label">Min Oxygens</label>
                <input type="text" class="form-control" name="noxmin" id="noxmin">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">List</button>
            </div>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
FORM;
?>
