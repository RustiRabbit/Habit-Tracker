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
        <div class="content">
            <h1>Signup</h1>
            <div class="card">
                <div class="form">
                    <form action="" method="POST">

                        <div class="input">
                            <p>First Name</p>
                            <input type="text" id="first_name" name="first_name" value="">
                        </div>
                        <div class="input">
                            <p>Last Name</p>
                            <input type="text" id="last_name" name="last_name" value="">
                        </div>
                        <div class="input">
                            <p>Email</p>
                            <input type="text" id="email" name="email" value="">
                        </div>
                        <div class="input">
                            <p>Password</p>
                            <input type="password" id="password" name="password" value="">
                        </div>
                        <div class="button">
                            <input type="submit" value="Signup">
                            <p>Already have an account? <a href="/auth/login.php">Log in</a></p>

                        </div>
                    </form>
                </div>
                
            </div>
        </div>
        
        
    </body>
</html>