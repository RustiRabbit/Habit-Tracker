<?php 
    include_once("../php/CONFIG.php");
    $message = "";

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        // Check if message has been set
        if(isset($_GET["message"]) == true) {
            $message = "<p class='message'>" . $_GET["message"] . "</p>";
        }
    }

    // Attempt to log the user into the application
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST["email"]; 
        $password = $_POST["password"];

        // Create SQL Database Connection
        $conn = $SQL_DB->CreateConnection();

        // Run SQL Query
        $sql = "SELECT * FROM users WHERE email=\"" . $email . "\" AND password=\"" . $password . "\";";
        $result = $conn->query($sql);

        if($result->num_rows == 1) {
            // Username & Password Worked
            $row = $result->fetch_assoc();
            
            // Create Authentication Session
            session_start();
            $_SESSION["id"] = $row["id"];
            $_SESSION["first"] = $row["first_name"];
            $_SESSION["last"] = $row["last_name"];

            header("Location: /app/index.php");

        } else {
            // Username & Password not found
            $message = "<p class='message'>" . "Username or Password was incorrect"  . "</p>";
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
            <div class="card">
                    <h1>Habit Tracker</h1>
                    <h3>Login</h3>
                    <?php echo $message ?>
                    <form action="" method="POST">
                        <div class="input">
                            <p>Email</p>
                            <input type="text" id="email" name="email" value="">
                        </div>
                        <div class="input">
                            <p>Password</p>
                            <input type="password" id="password" name="password" value="">
                        </div>
                        <div class="button">
                            <input type="submit" value="Login">
                        </div>
                    </form>
                    <p>Dont have an account? <a href="/auth/signup.php">Sign Up</a></p>
            </div>
        </div>
        
        
    </body>
</html>