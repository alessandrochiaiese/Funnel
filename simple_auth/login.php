


<html>
    <head>

    </head>
    <body> 
        <form action="login.php" method="post">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>
            <button type="submit">Login</button>
        </form>
        <?php
        session_start();

        if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Check if the username and password are correct
        // ...

        // If they are correct, start a new session and store the username
        $_SESSION['username'] = $username;
        
        // Redirect the user to the protected page
        header('Location: protected.php');
        exit;
        }

        // If the form was not submitted, show the login form
        ?>
    </body>
</html>