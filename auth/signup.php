<?php 
    // Include Database Authentication
    include_once("../php/CONFIG.php");

    // Check that Request is POST
    if($_SERVER["REQUEST_METHOD"] == "POST") {

        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $conn = $SQL_DB->CreateConnection();
        
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (\"" . $first_name .  "\", \"" . $last_name . "\", \"" . $email . "\", \"" . $password . "\")";
        if ($conn->query($sql) === TRUE) {
            // Means the insert has worked
            header("Location: /auth/login.php?message=User Account created successfully");
        } else {
            // Means the insert has failed
            header("Location: /auth/login.php?message=User Account failed");
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="/public/css/pages/auth.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Habit Tracker</h1>
                <h3>Sign up</h3>
            </div>

            <div class="form">
                <form method="post">
                    <div class="double">
                        <div class="text">
                            <p>First</p>
                            <input type="text" name="first_name">
                        </div>
                        <div class="text">
                            <p id="right">Last</p>
                            <input type="text" name="last_name">
                        </div>
                    </div>
                    <div class="text">
                        <p>Email</p>
                        <input type="text" name="email">
                    </div>
                    <div class="text">
                        <p>Password</p>
                        <input type="password" name="password">
                    </div>
                    <div class="footer">
                        <p class="bottom-message"><a href="/auth/login.php">Already have an <span>account?</span></a></p>
                        <input type="submit" value="Signup">
                    </div>
                </form>
            </div>   
        </div>
        
        
    </body>
</html>