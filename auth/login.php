


<html>
    <head>

    </head>
    <body> 
        <!-- Login form -->
        <form action="index.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit" name="login">Login</button>
        </form>
        <?php
        session_start();

        // Connect to the database
        $db = mysqli_connect("localhost", "username", "password", "database");

        if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // Check if the username and password are correct
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            // If they are correct, start a new session and store the username
            $_SESSION['username'] = $username;
            
            // Redirect the user to the protected page
            header('Location: protected.php');
            exit;
            // If the form was not submitted, show the login form
        } else {
            // If they are incorrect, show an error message
            echo "Incorrect username or password";
        }
        }  

        // If the form was not submitted, show the login form
        ?>
    </body>
</html>