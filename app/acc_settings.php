<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    // Checks the request method is post
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = $SQL_DB->CreateConnection(); // Create database connection

        // Gets details from form
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "UPDATE `users` SET `first_name` = '" . $firstname . "', `last_name` = '" . $lastname . "', `email` = '" . $email . "', `password` = '" . $password . "' WHERE `id` = " . $user->id; // SQL query
        $conn->query($sql); // Updates database

        // Updates session
        $_SESSION["id"] = $user->id;
        $_SESSION["first"] = $firstname;
        $_SESSION["last"] = $lastname;
        $_SESSION["email"] = $email;
        $_SESSION["password"] = $password;

        // Updates the form
        $user->first = $firstname;
        $user->last = $lastname;
        $user->email = $email;
        $user->password = $password;
    }
?>

<!DOCTYPE>
<html>
    <head>
        <title>Habit Tracker</title>
        <?php include("partials/head.php") ?>
        <link rel="stylesheet" href="/public/css/pages/acc_settings.css">
    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <div class="settings">
            <h1>Account Settings</h1>
            <form action="/app/acc_settings.php" method="POST">
                <div class="input">
                    <p>First Name:</p>
                    <input type="text" id="firstname" name="firstname" value=<?php echo $user->first?>><br>
                </div>
                <div class="input">
                    <p>Last Name:</p>
                    <input type="text" id="lastname" name="lastname" value=<?php echo $user->last?>><br>
                </div>
                <div class="input">
                    <p>Email:</p>
                    <input type="text" id="email" name="email" value=<?php echo $user->email?>><br>
                </div>
                <div class="input">
                    <p>Password:</p>
                    <input type="text" id="password" name="password" value=<?php echo $user->password?>><br>
                </div>
                <div class="submit">
                    <input type="submit" value="Save">
                </div>
            </form>
        </div>
        
    </body>

</html>