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
                    $conn = $SQL_DB->CreateConnection();
                    $sql = "SELECT * FROM `habits` WHERE `user_id` = " . $_SESSION["id"];
                    $result = $conn->query($sql);
                
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo generateHabitElement($row["id"], $row["name"]);
                        }
                    } else {
                        echo "0 results";
                    }
                    $conn->close();
                ?>
            </div>
        </div>
        <div class="section">
            <h1>How are you going?</h1>
            <div class="goals">
                <?php 
                    echo generateGoalElement(1, "test", 15);
                ?>
            </div>
        </div>
    </body>

</html>