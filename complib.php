<?php
session_start();
require_once 'login.php';

try {
    $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->prepare("SELECT * FROM Manufacturers");
    $stmt->execute();

    $mask = 0;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mask = (2 * $mask) + 1;
    }
    $_SESSION['supmask'] = $mask;
} catch (PDOException $e) {
    die("Unable to connect to database: " . $e->getMessage());
}
echo "<script>console.log('supmask value: " . json_encode($mask) . "');</script>";
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compounds Library</title>
    <link rel="stylesheet" href="./css/complib.css">
    <script>
        function validate(form) {
            var fail = "";
            if(form.gn.value === "") fail = "Must Give First Name ";
            if(form.sn.value === "") fail += "Must Give Surname";
            if(fail === "") return true;
            else { alert(fail); return false; }
        }
    </script>
</head>
<body>
<div class="ring">
    <i style="--clr:#00ff0a;"></i>
    <i style="--clr:#ff0057;"></i>
    <i style="--clr:#fffd44;"></i>
    <div class="login">
        <h2>Compounds Library</h2>
        <form action="indexp.php" method="post" onSubmit="return validate(this)">
            <div class="inputBx">
                <input type="text" name="gn" placeholder="Given Name">
            </div>
            <div class="inputBx">
                <input type="text" name="sn" placeholder="Surname">
            </div>
            <div class="inputBx">
                <input type="submit" value="Sign In">
            </div>
        </form>
<!--        <div class="links">-->
<!--            <a href="#">Forget Password</a>-->
<!--            <a href="#">Sign Up</a>-->
<!--        </div>-->
    </div>
</div>
</body>
</html>
