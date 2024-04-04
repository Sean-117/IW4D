<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'redir.php';

// save user name
$fn = isset($_SESSION['forname']) ? $_SESSION['forname'] : 'Guest';

// clean session and cookie
$_SESSION = array();
if(session_id() != "" || isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 2592000, '/');
}
session_destroy();

// goodbye msg
echo<<<_HEAD1
<html>
<body>
_HEAD1;

echo <<< _MAIN1
    <pre>
    Goodbye $fn;
    You have now exited Complib
    </pre>
_MAIN1;

echo <<<_TAIL1
</pre>
</body>
</html>
_TAIL1;
?>
