<?php
session_start();

// Clear all session variables
$_SESSION = array();

// Completely destroy the session data on the server
session_destroy();

// Redirect back to the login screen
header("location:login.php");
exit();
?>
