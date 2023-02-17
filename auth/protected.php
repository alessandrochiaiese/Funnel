 

<?php
session_start();

if (!isset($_SESSION['username'])) {
  // If the user is not logged in, redirect them to the login page
  header('Location: login.php');
  exit;
}

// Connect to the database
$db = mysqli_connect("localhost", "username", "password", "database");

// Get the user information from the database
$username = $_SESSION['username'];
$query = "SELECT * FROM users WHERE username='$username'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

// Show the protected page
echo "Welcome, " . $user['username'] . "!";
echo "<br><a href='logout.php'>Logout</a>";
