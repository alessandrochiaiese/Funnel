
<html>
    <head>

    </head>
    <body> 

        <!-- Signup form -->
        <form action="signup.php" method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
        </div>
        <button type="submit" name="signup">Sign Up</button>
        </form> 
        <?php
        
        if (isset($_POST['signup'])) {
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);

            // Check if the username is already taken
            $query = "SELECT * FROM users WHERE username='$username'";
            $results = mysqli_query($db, $query);
            if (mysqli_num_rows($results) == 0) {
                // If it's not taken, store the new username and password in the database
                $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
                mysqli_query($db, $query);
                
                // Redirect the user to the login page
                header('Location: login.php');
                exit;
            } else {
                // If it's taken, show an error message
                echo "Username is already taken";
            }
        }


        // If the form was not submitted, show the signup form
        ?>
    </body>
</html>