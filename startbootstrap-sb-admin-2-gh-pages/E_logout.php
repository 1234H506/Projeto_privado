<?php
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();
header("location: /administracao1/Html em php/HomeSpace/HomeSpace/index.php");
exit;
?>
