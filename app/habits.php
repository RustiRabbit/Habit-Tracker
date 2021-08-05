<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    function createHabit($id, $name) {
        return "<p>ID: " . $id . ", Name: " . $name . "</p>";
    }
    
    $conn = $SQL_DB->CreateConnection();

    $habits = "";

    // Initial SQL Request to get list of user habits 
    $habits_sql = "SELECT * FROM `habits` WHERE `user_id` = " . $_SESSION["id"];
    $habits_result = $SQL_DB->CreateConnection()->query($habits_sql); // Query Database

    if ($habits_result->num_rows > 0) { // Check that habits actually exist
        while($row = $habits_result->fetch_assoc()) { // Loop through the returned rows
            $id = $row["id"];
            $name = $row["name"];
            $habits .= createHabit($row["id"], $row["name"]); // Add Habit Element to the Page
        }
    } else {
        $habits = "<p>No habits</p>";
    }
    $SQL_DB->CreateConnection()->close();
?>

<!DOCTYPE>
<html>
    <head>
        <title>Habit Tracker</title>

        <link rel="stylesheet" href="/public/css/pages/habits.css">

        <?php include("partials/head.php") ?>
    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <div class="top">
            <h1>Habits</h1>
            <a>Add</a>
        </div>
        <?php
        echo $habits;
        ?>
    </body>

</html>