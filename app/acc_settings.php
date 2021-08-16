<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    function getDetails($firstname, $lastname, $email, $password) {
        return "<p>ID: " . $id . ", Name: " . $name . "</p><div>Description:" .  $desc ."</div>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = $SQL_DB->CreateConnection();
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "UPDATE `users` SET `first_name` = '" . $firstname . "', `last_name` = '" . $lastname . "', `email` = '" . $email . "', `password` = '" . $password . "' WHERE `id` = " . $user->id;
        echo $sql;
        $conn->query($sql);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo 'get';
    } 
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
        <form action="/app/acc_settings.php" method="POST">
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