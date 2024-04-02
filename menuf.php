<?php
echo <<<MENU1
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container text-center mt-5">
        <h2>Your options are</h2>
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-md-2 mb-2">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p1.php" class="btn btn-primary w-100">Select Suppliers</a>
            </div>
            <div class="col-12 col-md-2 mb-2">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p2.php" class="btn btn-primary w-100">Search Compounds</a>
            </div>
            <div class="col-12 col-md-2 mb-2">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p3.php" class="btn btn-primary w-100">Stats</a>
            </div>
            <div class="col-12 col-md-2 mb-2">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p4.php" class="btn btn-primary w-100">Correlations</a>
            </div>
            <div class="col-12 col-md-2 mb-2">
                <a href="https://bioinfmsc8.bio.ed.ac.uk/~$username/p5.php" class="btn btn-danger w-100">Exit</a>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
MENU1;
?>
