<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    function generateHabitElement($id, $name) {
        return '<div class="habit card"><h1>' . $name . '</h1><a onclick="completeGoal(this)">Complete!</a></div>';
    }

    function generateGoalElement($id, $name, $completedTimes) {
        return '<div class="habit card"><h1>' . $name . '</h1><p>' . $completedTimes . '</p></div>';
    }

    $habits = "";
    $goals = "";

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
        $habits = "<p>No habits</p>";
        $goals = "<p>No goals</p>";
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

        <script>
            function completeGoal(element) {
                // TODO - Run PHP API Request
                
                element.style.animation="finish 0.5s ease-in-out";
                window.setTimeout(function() {
                    element.innerText = "Done!";
                }, 250)
            }

        </script>

    </body>

</html>