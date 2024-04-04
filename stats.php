<?php
session_start();
include 'redir.php';
require_once 'login.php';
$gn = $_SESSION['givenname'];
$sn = $_SESSION['surname'];

$dbfs = ["natm", "ncar", "nnit", "noxy", "nsul", "ncycl", "nhdon", "nhacc", "nrotb", "mw", "TPSA", "XLogP"];
$nms = ["n atoms", "n carbons", "n nitrogens", "n oxygens", "n sulphurs", "n cycles", "n H donors", "n H acceptors", "n rot bonds", "mol wt", "TPSA", "XLogP"];
?>

echo '<!DOCTYPE html>
<head>
    <!-- Meta -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Compounds Library</title>
    <meta name="description" content="Compounds Library"/>
    <meta name="author" content="Shuren Xie"/>
    <link rel="shortcut icon" href="./images/favicon.webp"/>

    <!-- *************
        ************ CSS Files *************
    ************* -->
    <!-- Icomoon Font Icons css -->
    <link rel="stylesheet" href="./fonts/style.css"/>

    <!-- Main CSS -->
    <link rel="stylesheet" href="./css/main.min.css"/>

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="./overlay-scroll/OverlayScrollbars.min.css"/>
</head>

<body>
<!-- Page wrapper start -->
<div class="page-wrapper">

    <!-- Main container start -->
    <div class="main-container">

        <!-- Sidebar wrapper start -->
        <nav id="sidebar" class="sidebar-wrapper">

            <!-- Logo starts -->
            <div class="app-brand px-3 py-2 d-flex align-items-center">
                <a href="complib.php">
                    <img src="./images/logo.png" class="logo" alt="Compounds Library"/>
                </a>
            </div>
            <!-- App brand ends -->

            <!-- Sidebar menu starts -->
            <div class="sidebarMenuScroll">
                <ul class="sidebar-menu">
                    <li>
                        <a href="selectsus.php">
                            <i class="icon-add_task"></i>
                            <span class="menu-text">Select Supplier</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#!">
                            <i class="icon-search"></i>
                            <span class="menu-text">Search</span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="searchcomps.php">Compounds</a>
                            </li>
                            <li>
                                <a href="props_in.php">by Properties</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active current-page">
                        <a href="stats.php">
                            <i class="icon-table_chart"></i>
                            <span class="menu-text">Statistics</span>
                        </a>
                    </li>
                    <li>
                        <a href="correlations.php">
                            <i class="icon-compare"></i>
                            <span class="menu-text">Correlations</span>
                        </a>
                    </li>
                    <li>
                        <a href="draw_my_smile.php">
                            <i class="icon-image_aspect_ratio"></i>
                            <span class="menu-text">Draw Smiles</span>
                        </a>
                    </li>
                    <li>
                        <a href="help.php">
                            <i class="icon-support_agent"></i>
                            <span class="menu-text">Help with AI</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#!">
                            <i class="icon-lock"></i>
                            <span class="menu-text">Authentication</span>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="https://bioinfmsc8.bio.ed.ac.uk/~' . $username . 'login.php">Login</a>
                            </li>
                            <li>
                                <a href="https://bioinfmsc8.bio.ed.ac.uk/~' . $username . 'signup.html">Signup</a>
                            </li>
                            <li>
                                <a href="https://bioinfmsc8.bio.ed.ac.uk/~' . $username . 'forgot-password.html">Forgot
                                    Password</a>
                            </li>
                            <li>
                                <a href="https://bioinfmsc8.bio.ed.ac.uk/~' . $username . 'page-not-found.html">Page Not
                                    Found</a>
                            </li>
                            <li>
                                <a href="https://bioinfmsc8.bio.ed.ac.uk/~' . $username . 'maintenance.html">Maintenance</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="exit.php">
                            <i class="icon-exit_to_app"></i>
                            <span class="menu-text">Sign Out</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Sidebar menu ends -->

        </nav>
        <!-- Sidebar wrapper end -->

        <!-- App container starts -->
        <div class="app-container">

            <!-- App header starts -->
            <div class="app-header d-flex align-items-center">

                <!-- Toggle buttons start -->
                <div class="d-flex">
                    <button class="btn btn-outline-light toggle-sidebar" id="toggle-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                    <button class="btn btn-outline-light pin-sidebar" id="pin-sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div>
                <!-- Toggle buttons end -->

                <!-- Search container start -->
                <div class="search-container d-sm-block d-none mx-3">
                    <input type="text" class="form-control" placeholder="Search"/>
                    <i class="icon-search"></i>
                </div>
                <!-- Search container end -->

                <!-- App header actions start -->
                <div class="header-actions">
                    <div class="dropdown ms-2">
                        <a class="dropdown-toggle d-flex align-items-center user-settings" href="#!" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <span><?php echo $gn . " " . $sn; ?></span>
                            <img src="deer.jpg" class="img-3x m-2 me-0 rounded-3" alt="Bootstrap Gallery"/>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-sm shadow-sm gap-3">
                            <a class="dropdown-item d-flex align-items-center py-2" href="profile.html"><i
                                        class="icon-gitlab fs-4 me-3"></i>User Profile</a>
                            <a class="dropdown-item d-flex align-items-center py-2" href="account-settings.html"><i
                                        class="icon-settings fs-4 me-3"></i>Account Settings</a>
                            <a class="dropdown-item d-flex align-items-center py-2" href="login.html"><i
                                        class="icon-log-out fs-4 me-3"></i>Logout</a>
                        </div>
                    </div>
                </div>
                <!-- App header actions end -->
            </div>
            <!-- App header ends -->

            <!-- App body starts -->
            <div class="app-body">
                <!-- Container starts -->
                <div class="container-fluid">
                    <!-- Row start -->
                    <div class="row">
                        <div class="col-xl-6 col-12">
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    margin: 20px;
                                    color: black;
                                }

                                form {
                                    margin-top: 20px;
                                }

                                .stat-header {
                                    margin-bottom: 20px;
                                    font-size: 20px;
                                }

                                .stat-result {
                                    margin-top: 10px;
                                }

                                input[type="submit"] {
                                    background-color: #ffcccc;
                                    color: white;
                                    padding: 10px 15px;
                                    border: none;
                                    border-radius: 4px;
                                    cursor: pointer;
                                    margin-top: 10px;
                                }

                                input[type="submit"]:hover {
                                    background-color: #45a049;
                                }

                                .radio-group {
                                    display: block;
                                    margin: 10px 0;
                                }

                                .radio-group label {
                                    display: block;
                                    background-color: #f5f5f5;
                                    margin: 5px 0;
                                    padding: 10px;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                    cursor: pointer;
                                }

                                .radio-group label:hover,
                                .radio-group label.selected {
                                    background-color: #ffcccc;
                                }

                                .radio-group input[type="radio"] {
                                    display: none;
                                }

                                .checkmark {
                                    color: green;
                                    display: none;
                                }

                                .selected .checkmark {
                                    display: inline;
                                }
                            </style>
                            <form action="stats.php" method="post">
                                <div class="radio-group">
                                    <?php foreach ($dbfs as $index => $field): ?>
                                        <label class="selectable"
                                               data-checked="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                            <?php echo $nms[$index]; ?> <input type="radio" name="tgval"
                                                                               value="<?php echo $field; ?>" <?php echo $index === 0 ? 'checked' : ''; ?>/>
                                            <span class="checkmark">✔</span>
                                        </label>
                                    <?php endforeach; ?>
                                </div>
                                <input type="submit" value="Proceed"/>
                            </form>

                            <script>
                                document.querySelectorAll(".radio-group label").forEach(label => {
                                    label.addEventListener("click", function () {
                                        document.querySelectorAll(".radio-group label").forEach(otherLabel => {
                                            otherLabel.classList.remove("selected");
                                            otherLabel.setAttribute("data-checked", "false");
                                        });
                                        const radio = this.querySelector("input[type=radio]");
                                        radio.checked = true;
                                        this.setAttribute("data-checked", "true");
                                        this.classList.add("selected");
                                    });

                                    if (label.getAttribute("data-checked") === "true") {
                                        label.classList.add("selected");
                                    }
                                });
                            </script>

                            <div class='stat-header'>This is the Statistics Page</div>

                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    color: black;
                                }

                                .stat-result {
                                    background-color: #ffffff;
                                    border: 1px solid #ddd;
                                    border-radius: 4px;
                                    padding: 20px;
                                    margin-top: 20px;
                                    margin-bottom: 20px;
                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                    max-width: 600px;
                                    margin-left: auto;
                                    margin-right: auto;
                                }

                                .stat-title {
                                    font-size: 24px;
                                    margin-bottom: 10px;
                                }

                                .stat-data {
                                    margin-top: 5px;
                                    font-size: 16px;
                                }
                            </style>
                            <?php
                            if (isset($_POST['tgval'])) {
                                $chosen = array_search($_POST['tgval'], $dbfs);
                                if ($chosen !== false) {
                                    echo "<div class='stat-result'>";
                                    echo "<div class='stat-title'>Statistics for " . htmlspecialchars($dbfs[$chosen]) . " (" . htmlspecialchars($nms[$chosen]) . ")</div>\n";

                                    try {
                                        $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4", $db_username, $db_password);
                                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                        $query = "SELECT AVG(" . $dbfs[$chosen] . "), STD(" . $dbfs[$chosen] . "), MIN(" . $dbfs[$chosen] . "), MAX(" . $dbfs[$chosen] . "), SUM(" . $dbfs[$chosen] . ") FROM Compounds";
                                        $stmt = $pdo->prepare($query);
                                        $stmt->execute();
                                        $row = $stmt->fetch(PDO::FETCH_NUM);

                                        echo "<div class='stat-data'>Average: " . number_format($row[0], 2) . "<br>";
                                        echo "Standard Deviation: " . number_format($row[1], 2) . "<br>";
                                        echo "Minimum: " . number_format($row[2], 2) . "<br>";
                                        echo "Maximum: " . number_format($row[3], 2) . "<br>";
                                        echo "Sum: " . number_format($row[4], 2) . "</div>";
                                    } catch (PDOException $e) {
                                        die("Unable to connect to database: " . htmlspecialchars($e->getMessage()));
                                    }
                                    echo "</div>";
                                }
                            }
                            ?>

                        </div>
                    </div>
                    <!-- Row end -->

                </div>
                <!-- Container ends -->

            </div>
            <!-- App body ends -->

            <!-- App footer start -->
            <div class="app-footer">
                <span>Compounds Library By <a
                            href="https://uk.linkedin.com/in/shuren-xie-344787235">Shuren Xie</a></span>
            </div>
            <!-- App footer end -->

        </div>
        <!-- App container ends -->

    </div>
    <!-- Main container end -->

</div>
<!-- Page wrapper end -->

<!-- *************
    ************ JavaScript Files *************
************* -->
<!-- Required jQuery first, then Bootstrap Bundle JS -->
<script src="./js/jquery.min.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>

<!-- Overlay Scroll JS -->
<script src="./overlay-scroll/jquery.overlayScrollbars.min.js"></script>
<script src="./overlay-scroll/custom-scrollbar.js"></script>

<!-- Custom JS files -->
<script src="./js/custom.js"></script>
</body>

</html>'