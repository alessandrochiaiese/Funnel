<?php
session_start();

// Remove the username from the session
unset($_SESSION['username']);

// Redirect the user to the login page
header('Location: login.php');
exit;