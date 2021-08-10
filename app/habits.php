<?php 
    // Check Authentication
    include("partials/auth_check.php");
    include("../php/CONFIG.php");

    function createHabit($id, $name, $desc) {
        return '<div class="habit-card"><h3>' . $name . '</h3><div class="icons"><a onclick="Edit.Open(\'' . $id  .'\', \'' . $name .'\', \'' . $desc .'\')"><i class="fa fa-edit"></i></a><a><i class="fa fa-trash"></i></a></div></div>';
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
        <div class="top">
            <h1>Habits</h1>
            <a onclick="New.Open()">Add</a>
        </div>
        <div class="habits">
            <?php
                echo $habits;
            ?>
        </div>

        <div class="popup hide" id="edit">
            <div class="popup-bg">
                <div class="popup-top">
                    <h3>Editing</h3>
                    <a onclick="Edit.Close()">Close</a>
                </div>
                <div class="popup-content">
                    <p>Name: </p><input id="edit-name" type="text">
                    <p>Description: </p><input id="edit-description" type="text">
                </div>
                <div class="popup-bottom">
                    <a>Save</a>
                </div>
                
            </div>
        </div>

        <div class="popup hide" id="create">
            <div class="popup-bg">
                <div class="popup-top">
                    <h3>Create</h3>
                    <a onclick="New.Close()">Close</a>
                </div>
                <div class="popup-content">
                    <p>Name: </p><input id="new-name" type="text">
                    <p>Description: </p><input id="new-description" type="text">
                </div>
                <div class="popup-bottom">
                    <a onclick="New.Create()">Create</a>
                </div>
                
            </div>
        </div>

    </body>

</html>