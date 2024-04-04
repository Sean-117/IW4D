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
                    <li class="active current-page">
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
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <title>GPT Conversation</title>
                                <style>

                                    .container {
                                        max-width: 500px;
                                        width: 100%;
                                        background-color: black;
                                        border-radius: 10px;
                                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                        padding: 20px;
                                        text-align: center;
                                    }

                                    .conversation {
                                        height: 300px;
                                        overflow-y: scroll;
                                        padding: 10px;
                                        border: 1px solid #ccc;
                                        border-radius: 5px;
                                        margin-bottom: 10px;
                                    }

                                    .message {
                                        margin-bottom: 10px;
                                        color: greenyellow;
                                    }

                                    #user-input {
                                        width: calc(100% - 70px);
                                        height: 40px;
                                        font-size: 16px;
                                        border: 1px solid greenyellow;
                                        border-radius: 5px;
                                        padding: 10px;
                                        margin-right: 10px;
                                    }

                                    #send-btn {
                                        width: 60px;
                                        height: 40px;
                                        background-color: #007bff;
                                        color: #fff;
                                        border: none;
                                        border-radius: 5px;
                                        cursor: pointer;
                                        font-size: 16px;
                                        transition: background-color 0.3s;
                                    }

                                    #send-btn:hover {
                                        background-color: #ffcccc;
                                    }
                                </style>
                            </head>
                            <body>
                            <div class="container">
                                <div class="conversation" id="conversation"></div>
                                <div class="message">
                                    <input type="text" id="user-input" placeholder="Enter your message..." autofocus> <!-- 添加 autofocus 属性，页面加载时输入框自动聚焦 -->
                                    <button id="send-btn" onclick="sendMessage()">Send</button>
                                </div>
                            </div>

                            <script>
                                document.addEventListener('keydown', function(event) {
                                    if (event.key === "Enter") {
                                        sendMessage();
                                    }
                                });

                                async function sendMessage() {
                                    const userInput = document.getElementById("user-input").value;
                                    if (!userInput.trim()) return;

                                    appendMessage("You", userInput);
                                    document.getElementById("user-input").value = "";

                                    const response = await fetch("https://api.openai.com/v1/completions", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "Authorization": "Bearer YOUR_OPENAI_API_KEY"
                                        },
                                        body: JSON.stringify({
                                            "model": "text-davinci-002",
                                            "prompt": userInput,
                                            "max_tokens": 50
                                        })
                                    });

                                    const data = await response.json();
                                    const gptResponse = data.choices[0].text.trim();
                                    appendMessage("GPT", gptResponse);
                                }

                                function appendMessage(sender, message) {
                                    const conversation = document.getElementById("conversation");
                                    const messageElement = document.createElement("div");
                                    messageElement.classList.add("message");
                                    messageElement.innerHTML = `<strong>${sender}:</strong> ${message}`;
                                    conversation.appendChild(messageElement);
                                    conversation.scrollTop = conversation.scrollHeight;
                                }
                            </script>
                            </body>

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