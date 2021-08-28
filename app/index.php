<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // SQL Database
    include("../php/CONFIG.php");

    function generateHabitElement($id, $name, $completed) {
        $class = "";
        if($completed == true) {
            $class = "completed";
        }

        $html = '
            <div class="habit">
                <svg class="' . $class . '" width="32" height="32" viewBox="0 0 32 32" fill="none" onclick="Dashboard.Complete(' .  $id . ', this)">
                    <circle cx="16" cy="16" r="14" fill="#C4C4C4" stroke="#4D97DB" stroke-width="4"/>
                    <g id="tick">
                        <circle cx="16" cy="16" r="14" fill="#4D97DB"/>    
                        <line x1="7.06066" y1="15.9393" x2="14.0607" y2="22.9393" stroke="#C4C4C4" stroke-width="3"/>
                        <line x1="11.9393" y1="22.9393" x2="25.9393" y2="8.93934" stroke="#C4C4C4" stroke-width="3"/>    
                    </g>
                </svg>
                <h4>' . $name . '</h4>
            </div>
        ';

        return $html;
    }


    function generateGoalElement($id, $name, $completedTimes) {
        $html = '
            <div class="goal">
                <h4>' . $name .'</h4>
                <div>   
                    <p id="completed-' . $id . '">' . $completedTimes .'</p>
                </div>
            </div>
        ';
        
        return $html;
    
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

            $start = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp(time())->format('Y-m-d 00:00:00'))->getTimestamp();
            $finish = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp(time())->format('Y-m-d 23:59:59'))->getTimestamp();

            $habits_completed_query = "SELECT * FROM `habits_completed` WHERE `habit_id` = 2 AND `time_completed` BETWEEN '" . $start . "' AND '" . $finish . "'";
            
            $habits_completed_result = $SQL_DB->CreateConnection()->query($habits_completed_query);

            if ($habits_completed_result->num_rows > 0) {
                $habits .= generateHabitElement($row["id"], $row ["name"], true);
            } else {
                $habits .= generateHabitElement($row["id"], $row ["name"], false);
            }
            
            $goals_sql = "SELECT * FROM habits_completed WHERE `habit_id` = " . $id; // Second SQL Request to get indiviual number of times completed
            $goals_result = $SQL_DB->CreateConnection()->query($goals_sql); // Query the Database
            if(isset($goals_result->num_rows) != false) {
                // This means that the habits have actually been completed
                $goals .= generateGoalElement($id, $name, $goals_result->num_rows);
            }
        }
    } else {
        $habits = "<p>Time to start something <span>new...</span></p>";
        $goals = "<p>\"Life is empty without any <span>progress</span>\" - Me</p>";
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
        <div class="welcome">
            <h3>Welcome,</h3>
            <h1><?php echo $name ?></h1>
        </div>

        <div class="container">
            <div class="content">
                <h1>Complete a <span>habit!</span></h1>
                <div class="items">
                    <?php echo $habits ?>
                </div>
            </div>

            <div class="content">
                <h1>How are you <span>going?</span></h1>
                <div class="items">
                    <?php echo $goals ?>
                </div>
            </div>
        </div>
        
    </body>

</html>