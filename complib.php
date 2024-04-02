<?php
session_start();
require_once 'login.php';

try {
    // PDO
    $pdo = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // query with prepared statement
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

echo <<<EOT
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2>Form Submission</h2>
    <form action="indexp.php" method="post" onSubmit="return validate(this)" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="fn" class="form-label">First Name</label>
            <input type="text" class="form-control" id="fn" name="fn" required>
            <div class="invalid-feedback">
                Please provide a first name.
            </div>
        </div>
        <div class="mb-3">
            <label for="sn" class="form-label">Second Name</label>
            <input type="text" class="form-control" id="sn" name="sn" required>
            <div class="invalid-feedback">
                Please provide a second name.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<script>
function validate(form) {
    let fail = "";
    if (form.fn.value == "") fail = "Must give first name. ";
    if (form.sn.value == "") fail += "Must give second name.";
    if (fail == "") return true;
    else { alert(fail); return false; }
}
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
EOT;
?>
