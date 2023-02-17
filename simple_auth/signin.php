
<html>
    <head>

    </head>
    <body> 
        <form action="signup.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit">Sign Up</button>
        </form>
        <?php
        if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        // Store the new username and password in a database
        // ...
        
        // Redirect the user to the login page
        header('Location: login.php');
        exit;
        }

        // If the form was not submitted, show the signup form
        ?>
    </body>
</html>