<?php 
    include_once("../php/CONFIG.php");
    $message = "";

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        // Check if message has been set
        if(isset($_GET["message"]) == true) {
            $message = $_GET["message"];
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
            $message = "Username & Password not found";
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
    </head>
    <body>
        <h1>Login</h1>
        <?php echo $message ?>
        <form action="" method="POST">
            <label for="username">Email:</label><br>
            <input type="text" id="email" name="email" value=""><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" value=""><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html>