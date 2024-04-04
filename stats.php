<?php
session_start();
include 'redir.php';
require_once 'login.php';

echo <<<'HEAD'
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statistics Page</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-top: 20px; }
        .stat-header { margin-bottom: 20px; font-size: 20px; }
        .stat-result { margin-top: 10px; }
        input[type="submit"] { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; margin-top: 10px; }
        input[type="submit"]:hover { background-color: #45a049; }
        .radio-group { display: block; margin: 10px 0; }
        label { display: inline-block; margin-right: 10px; }
        input[type="radio"] { margin-right: 5px; }
    </style>
</head>
<body>
HEAD;

include 'menuf.php';

$dbfs = ["natm", "ncar", "nnit", "noxy", "nsul", "ncycl", "nhdon", "nhacc", "nrotb", "mw", "TPSA", "XLogP"];
$nms = ["n atoms", "n carbons", "n nitrogens", "n oxygens", "n sulphurs", "n cycles", "n H donors", "n H acceptors", "n rot bonds", "mol wt", "TPSA", "XLogP"];

echo "<div class='stat-header'>This is the Statistics Page</div>";

if (isset($_POST['tgval'])) {
  $chosen = array_search($_POST['tgval'], $dbfs);
  if ($chosen !== false) {
    echo "<div class='stat-result'>Statistics for {$dbfs[$chosen]} ({$nms[$chosen]})<br />\n";
    // PDO
    try {
      $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4", $db_username, $db_password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // safe sql
      $stmt = $pdo->prepare("SELECT AVG({$dbfs[$chosen]}), STD({$dbfs[$chosen]}) FROM Compounds");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_NUM);

      printf("Average: %f  Standard Deviation: %f <br />\n", $row[0], $row[1]);
    } catch (PDOException $e) {
      die("Unable to connect to database: " . $e->getMessage());
    }
    echo "</div>";
  }
}

echo '<form action="p3.php" method="post"><div class="radio-group">';
foreach ($dbfs as $index => $field) {
  $checked = $index === 0 ? 'checked' : '';
  echo '<label>';
  printf('%15s <input type="radio" name="tgval" value="%s" %s/>', $nms[$index], $field, $checked);
  echo '</label><br>';
}
echo '</div><input type="submit" value="OK" />';
echo '</form>';

echo <<<'TAIL'
</body>
</html>
TAIL;

?>
