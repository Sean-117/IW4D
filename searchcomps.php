<?php
session_start();
require_once 'login.php';
include 'redir.php';

// Connecting to db
try {
  $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4", $db_username, $db_password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Unable to connect to database: " . $e->getMessage());
}

// Fetch suppliers' info
$smask = $_SESSION['supmask'] ?? 0;
$mansel = " AND (0"; // No selection by default
$stmt = $pdo->query("SELECT id FROM Manufacturers");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  if ((1 << ($row['id'] - 1)) & $smask) { // Whether is selected
    $mansel .= " OR ManuID = " . $row['id'];
  }
}
$mansel .= ")";

$setpar = isset($_POST['natmax']);
$resultMax = isset($_POST['resultMax']) ? filter_var($_POST['resultMax'], FILTER_VALIDATE_INT, ["options" => ["default" => 100, "min_range" => 1]]) : 100; // Ensure it's a positive integer, default to 100

?>
<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    form > div {
      margin-bottom: 15px;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
    input[type="text"], input[type="submit"] {
      padding: 8px;
      margin-right: 10px;
      border-radius: 4px;
      border: 1px solid #ccc;
    }
    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
<?php include 'menuf.php'; ?>
<pre>This is the catalogue retrieval Page</pre>
<?php
if ($setpar) {
  $conditions = [];
  $params = [];

  // Querying conditions
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
    $query = "SELECT catn FROM Compounds WHERE " . implode(' AND ', $conditions) . $mansel . " LIMIT $resultMax";
    $stmt = $pdo->prepare($query);
    foreach ($params as $key => &$value) {
      $stmt->bindParam($key, $value);
    }
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $row) {
      echo htmlspecialchars($row['catn']), "\n";
    }
  } else {
    echo "No Query Given\n";
  }
}
?>
<form action="p2.php" method="post">
  <div>
    <label>Max Results    <input type="text" name="resultMax"/></label>
    <label>Max Atoms      <input type="text" name="natmax"/></label>
    <label>Min Atoms      <input type="text" name="natmin"/></label>
    <label>Max Carbons    <input type="text" name="ncrmax"/></label>
    <label>Min Carbons    <input type="text" name="ncrmin"/></label>
    <label>Max Nitrogens  <input type="text" name="nntmax"/></label>
    <label>Min Nitrogens  <input type="text" name="nntmin"/></label>
    <label>Max Oxygens    <input type="text" name="noxmax"/></label>
    <label>Min Oxygens    <input type="text" name="noxmin"/></label>
    <input type="submit" value="list" />
  </div>
</form>
</body>
</html>

