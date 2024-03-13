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

echo "<!DOCTYPE html><html><body>";
include 'menuf.php';
echo "<pre>This is the catalogue retrieval Page</pre>";

if ($setpar) {
  $conditions = [];
  $params = [];

  // querying conditions
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

    // querying
    $stmt = $pdo->prepare($compsel);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 100) {
      echo "Too many results, max is 100\n";
    } else {
      foreach ($results as $row) {
        echo htmlspecialchars($row['catn']), "\n";
      }
    }
  } else {
    echo "No Query Given\n";
  }
}

echo <<<'FORM'
    <form action="p2.php" method="post"><pre>
        Max Atoms      <input type="text" name="natmax"/>    Min Atoms    <input type="text" name="natmin"/>
        Max Carbons    <input type="text" name="ncrmax"/>    Min Carbons  <input type="text" name="ncrmin"/>
        Max Nitrogens  <input type="text" name="nntmax"/>    Min Nitrogens<input type="text" name="nntmin"/>
        Max Oxygens    <input type="text" name="noxmax"/>    Min Oxygens  <input type="text" name="noxmin"/>
                        <input type="submit" value="list" />
    </pre></form>
</body>
</html>
FORM;
?>
