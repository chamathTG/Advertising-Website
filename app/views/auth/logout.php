<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = array();


session_destroy();


header("Location: /dse/C-W/Advertising-Website/public/index.php");
exit;
?>