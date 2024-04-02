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
</head>
<body>
HEAD;

include 'menuf.php';

$dbfs = ["natm", "ncar", "nnit", "noxy", "nsul", "ncycl", "nhdon", "nhacc", "nrotb", "mw", "TPSA", "XLogP"];
$nms = ["n atoms", "n carbons", "n nitrogens", "n oxygens", "n sulphurs", "n cycles", "n H donors", "n H acceptors", "n rot bonds", "mol wt", "TPSA", "XLogP"];

echo "<pre>This is the Statistics Page</pre>";

if (isset($_POST['tgval'])) {
  $chosen = array_search($_POST['tgval'], $dbfs);
  if ($chosen !== false) {
    echo "Statistics for {$dbfs[$chosen]} ({$nms[$chosen]})<br />\n";
    // 使用PDO进行数据库连接
    try {
      $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4", $db_username, $db_password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // 安全地执行查询
      $stmt = $pdo->prepare("SELECT AVG({$dbfs[$chosen]}), STD({$dbfs[$chosen]}) FROM Compounds");
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_NUM);

      printf("Average: %f  Standard Deviation: %f <br />\n", $row[0], $row[1]);
    } catch (PDOException $e) {
      die("Unable to connect to database: " . $e->getMessage());
    }
  }
}

echo '<form action="p3.php" method="post"><pre>';
foreach ($dbfs as $index => $field) {
  $checked = $index === 0 ? 'checked' : '';
  printf('%15s <input type="radio" name="tgval" value="%s" %s/>', $nms[$index], $field, $checked);
  echo "\n";
}
echo '<input type="submit" value="OK" />';
echo '</pre></form>';

echo <<<'TAIL'
</body>
</html>
TAIL;

?>
