<?php
session_start();
require_once 'login.php';
echo<<<_HEAD1
<html>
<body>
_HEAD1;

// THE CONNECTION AND QUERY SECTIONS NEED TO BE MADE TO WORK FOR PHP 8 USING PDO... //

try {
    // PDO
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // query
    $query = "SELECT * FROM Manufacturers";
    $result = $pdo->query($query);

    $mask = 0;
    $rows = $result->fetchAll();
    foreach ($rows as $row) {
        $mask = (2 * $mask) + 1;
    }
    $_SESSION['supmask'] = $mask;
} catch (PDOException $e) {
    die("Unable to connect to database: " . $e->getMessage());
}

$_SESSION['supmask'] = $mask;
   echo <<<_EOP
<script>
   function validate(form) {
   fail = ""
   if(form.fn.value =="") fail = "Must Give Forname "
   if(form.sn.value == "") fail += "Must Give Surname"
   if(fail =="") return true
       else {alert(fail); return false}
   }
</script>
<form action="indexp.php" method="post" onSubmit="return validate(this)">
  <pre>
       First Name<input type="text" name="fn"/>
       Second Name <input type="text" name="sn"/>
                   <input type="submit" value="go" />
</pre></form>
_EOP;

echo <<<_TAIL1
</pre>
</body>
</html>
_TAIL1;

?>
