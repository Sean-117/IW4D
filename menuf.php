<?php
require_once 'login.php';
$smask = $_SESSION['supmask'] ?? 'Not set';
$gn = $_SESSION['givenname'];
$sn = $_SESSION['surname'];


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
                    <li class="active current-page">
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
                    <li>
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
                                <a href="https://bioinfmsc8.bio.ed.ac.uk/~' . $username . 'forgot-password.html">Forgot Password</a>
                            </li>
                            <li>
                                <a href="https://bioinfmsc8.bio.ed.ac.uk/~' . $username . 'page-not-found.html">Page Not Found</a>
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
                            <span>'.$gn." ".$sn.'</span>
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
									<pre>Welcome to Compounds Library.<br>Mask Value: ' . htmlspecialchars($smask) . '</pre>
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
?>
