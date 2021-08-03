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
                    echo generateHabitElement(1, "Go for a run");
                    echo generateHabitElement(1, "Do 10 Pushups");
                    echo generateHabitElement(1, "Go for a run");
                    echo generateHabitElement(1, "Do 10 Pushups");

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