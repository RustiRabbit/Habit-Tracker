<?php 
    // Check Authentication
    include("partials/auth_check.php");
    include("../php/CONFIG.php");

    function createHabit($id, $name, $desc) {
        $html = '
            <div class="habit">
                <h1>' . $name . '</h1>
                <a href="#">' . file_get_contents("../public/images/icons/edit.svg") . '</a>
            </div>        
        ';
        return $html;
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
            $desc = $row["description"];
            $habits .= createHabit($row["id"], $row["name"], $row["description"]); // Add Habit Element to the Page
        }
    } else {
        $habits = "<p>No habits</p>";
    }
    $SQL_DB->CreateConnection()->close();
?>
<html>
    <head>
        <title>Habit Tracker</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php include("partials/head.php") ?>
        <link rel="stylesheet" href="/public/css/pages/habits.css">
        <script src="/public/js/habits.js"></script>

    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <div class="title">
            <h1>Habits</h1>
        </div>

        <div class="habits">
            <?php echo $habits; ?>
        </div>

        <div class="modal show">
            <div class="modal-content">
                <div class="top">
                    <h1>Editing</h1>
                    <a><?php echo file_get_contents("../public/images/icons/close.svg") ?></a>
                </div>
                
                <div class="input">
                    <h2>Name:</h2>
                    <div class="text">
                        <input type="text" placeholder="What do you want to acomplish?">
                    </div>
                </div>
                <div class="input">
                    <h2>Description:</h2>
                    <div class="text">
                        <textarea rows="4" cols="40" placeholder="Describe your habit"></textarea>
                    </div>
                </div>
                <div class="input">
                    <h2>Frequency:</h2>
                    <div class="days">
                        <div class="day">
                            <input type="checkbox">
                            <span>M</span>
                        </div>
                        <div class="day">
                            <input type="checkbox">
                            <span>T</span>
                        </div>
                        <div class="day">
                            <input type="checkbox">
                            <span>W</span>
                        </div>
                        <div class="day">
                            <input type="checkbox">
                            <span>T</span>
                        </div>
                        <div class="day">
                            <input type="checkbox">
                            <span>F</span>
                        </div>
                        <div class="day">
                            <input type="checkbox">
                            <span>S</span>
                        </div>
                        <div class="day">
                            <input type="checkbox">
                            <span>S</span>
                        </div>
                    </div>
                </div>
            
                <div class="bottom">
                    <a href="#" id="delete">
                        Delete
                    </a>
                    <a href="#" id="save">
                        Save
                    </a>
                </div>
            </div>
        </div>

    </body>

</html>