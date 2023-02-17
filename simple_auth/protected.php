<?php
session_start();

if (!isset($_SESSION['username'])) {
  // If the user is not logged in, redirect them to the login page
  header('Location: login.php');
  exit;
}

// If the user is logged in, show the protected page
echo "Welcome, " . $_SESSION['username'] . "! You are now on the protected page.";
echo "<br><a href='logout.php'>Logout</a>";