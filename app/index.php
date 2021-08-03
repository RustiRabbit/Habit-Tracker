<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    function generateHabitElement($id, $name) {
        return '<div class="habit card"><h1>' . $name . '</h1><a href="#">Complete!</a></div>';
    }

    function generateGoalElement($id, $name, $completedTimes) {
        return '<div class="habit card"><h1>' . $name . '</h1><p>You\'ve completed the goal ' . $completedTimes . ' times</p></div>';
    }

    $habits = "";
    $goals = "";
    
    $habits_result 

    $habits_sql = "SELECT * FROM `habits` WHERE `user_id` = " . $_SESSION["id"];
    $habits_result = $SQL_DB->CreateConnection()->query($habits_sql);

    if ($habits_result->num_rows > 0) {
        while($row = $habits_result->fetch_assoc()) {
            $id = $row["id"];
            $name = $row["name"];
            $habits .= generateHabitElement($row["id"], $row["name"]);
            
            $goals_sql = "SELECT * FROM habits_completed WHERE `habit_id` = " . $id;
            $goals_result = $SQL_DB->CreateConnection()->query($goals_sql);
            $goals .= generateGoalElement($id, $name, $goals_result->num_rows);
        }
    } else {
        echo "0 results";
    }
    $SQL_DB->CreateConnection()->close();
?>

<!DOCTYPE>
<html>
    <head>
        <title>Habit Tracker</title>

        <link rel="stylesheet" href="/public/css/pages/dashboard.css">

        <?php include("partials/head.php") ?>
    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <h1 class="welcome">Welcome <?php echo $user->first ?>!</h1>

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