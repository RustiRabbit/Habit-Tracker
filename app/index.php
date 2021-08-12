<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    // Create Helper Functions to create elements
    function generateHabitElement($id, $name) {
        return '<div class="habit card"><h1>' . $name . '</h1><a onclick="Dashboard.Complete(' . $id .', this)">Complete!</a></div>';
    }

    function generateGoalElement($id, $name, $completedTimes) {
        return '<div class="habit card"><h1>' . $name . '</h1><p>' . $completedTimes . '</p></div>';
    }

    $habits = "";
    $goals = "";

    // Initial SQL Request to get list of user habits 
    $habits_sql = "SELECT * FROM `habits` WHERE `user_id` = " . $_SESSION["id"];
    $habits_result = $SQL_DB->CreateConnection()->query($habits_sql); // Query Database

    if ($habits_result->num_rows > 0) { // Check that habits actually exist
        while($row = $habits_result->fetch_assoc()) { // Loop through the returned rows
            $id = $row["id"];
            $name = $row["name"];
            $habits .= generateHabitElement($row["id"], $row["name"]); // Add Habit Element to the Page
            
            $goals_sql = "SELECT * FROM habits_completed WHERE `habit_id` = " . $id; // Second SQL Request to get indiviual number of times completed
            $goals_result = $SQL_DB->CreateConnection()->query($goals_sql); // Query the Database
            if(isset($goals_result->num_rows) != false) {
                // This means that the habits have actually been completed
                $goals .= generateGoalElement($id, $name, $goals_result->num_rows);
            }
        }
    } else {
        $habits = "<p>No habits</p>";
        $goals = "<p>Looks like you just started!</p>";
    }
    $SQL_DB->CreateConnection()->close();
?>

<!DOCTYPE>
<html>
    <head>
        <title>Habit Tracker</title>

        <link rel="stylesheet" href="/public/css/pages/dashboard.css">
        <script src="/public/js/dashboard.js"></script>

        <?php include("partials/head.php") ?>
    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <h1 class="welcome">Welcome <span><?php echo $user->first ?></span></h1>

        <div class="section">
            <h1>Ready to complete a habit?</h1>
            <div class="habits">
                <?php
                echo $habits;
                ?>
            </div>
        </div>
        <div class="section">
            <h1>How are you going?</h1>
            <div class="goals">
                <?php 
                    echo $goals;
                ?>
            </div>
        </div>
    </body>

</html>