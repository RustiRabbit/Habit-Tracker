<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    function getDetails($firstname, $lastname, $email, $password) {
        return "<p>ID: " . $id . ", Name: " . $name . "</p><div>Description:" .  $desc ."</div>";
    }
    
    $conn = $SQL_DB->CreateConnection();

    $sql = "UPDATE `users` SET `first_name` = " . $firstname . "AND `last_name` = " . $lastname . "AND `email` = " . $email . "AND `password` = " . $password . "WHERE `users`.id` = " . $id;
    $conn->query($sql)
?>

<!DOCTYPE>
<html>
    <head>
        <title>Habit Tracker</title>
        <?php include("partials/head.php") ?>
    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <h1>Account Settings</h1>
        <form action="/app/acc_settings.php">
            <label for="firstname">First name:</label><br>
            <input type="text" id="firstname" name="firstname" value=<?php echo $user->first?>><br>
            <label for="lastname">Last name:</label><br>
            <input type="text" id="lastname" name="lastname" value=<?php echo $user->last?>><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value=<?php echo $user->email?>><br>
            <label for="password">Password:</label><br>
            <input type="text" id="password" name="password" value=<?php echo $user->password?>><br>
            <input type="submit" value="Save">
        </form>
    </body>

</html>