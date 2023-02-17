<?php
session_start();

// Connect to the database
$db = mysqli_connect("localhost", "username", "password", "database");

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Prepare and bind the statement
  $stmt = $db->prepare("SELECT * FROM users WHERE username=? AND password=?");
  $stmt->bind_param("ss", $username, $password);

  // Execute the statement and get the result
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 1) {
    // If they are correct, start a new session and store the username
    $_SESSION['username'] = $username;
    
    // Redirect the user to the protected page
    header('Location: protected.php');
    exit;
  } else {
    // If they are incorrect, show an error message
    echo "Incorrect username or password";
  }
}

if (isset($_POST['signup'])) {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  // Prepare and bind the statement
  $stmt = $db->prepare("SELECT * FROM users WHERE username=?");
  $stmt->bind_param("s", $username);

  // Execute the statement and get the result
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows == 0) {
    // If the username is not taken, store the new username and hashed password in the database
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    // Redirect the user to the login page
    header('Location: login.php');
    exit;
  } else {
    // If the username is taken, show an error message
    echo "Username is already taken";
  }
}
?>

<!-- Login form -->
<form action="index.php" method="post">
    <div>
       <label for="username">Username:</label>
       <input type="text" id="username" name="username" required>
    </div>
    <div>
       <label for="password">Password:</label>
       <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" name="login">Login</button>
</form>

<!-- Signup form -->
<form action="index.php" method="post">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password">
    </div>
    <div>
        <input type="password" id="confirm_password" name="confirm_password" required>
        <label for="confirm_password">Confirm Password:</label>
    </div>
    <button type="submit" name="signup">Signup</button>
</form>

<!-- Logout button -->
<?php if (isset($_SESSION['username'])) { ?>
    <form action="logout.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
<?php } ?>
