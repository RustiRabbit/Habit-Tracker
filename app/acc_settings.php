<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    function getDetails($firstname, $lastname, $email, $password) {
        return "<p>ID: " . $id . ", Name: " . $name . "</p><div>Description:" .  $desc ."</div>";
    }
    
    $conn = $SQL_DB->CreateConnection();

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
        <form>
            <label for="firstname">First name:</label><br>
            <input type="text" id="firstname" name="firstname"><br>
            <label for="lastname">Last name:</label><br>
            <input type="text" id="lastname" name="lastname"><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email"><br>
            <label for="password">Last name:</label><br>
            <input type="text" id="password" name="password"><br>
        </form>
    </body>

</html>