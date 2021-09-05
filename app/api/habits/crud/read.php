<?php 
    // This page returns all habits to the calendar javascript page
    
    // Auth Check
    include("../../../partials/auth_check.php");

    // Include Database
    include("../../../../php/CONFIG.php"); 

    $habits_sql = "SELECT * FROM `habits` WHERE `user_id`=" . $user->id;;

    if(isset($_GET["id"])) {
        $habits_sql = "SELECT * FROM `habits` WHERE `user_id`=" . $user->id . " AND id=" . $_GET["id"];
    }

    $result = array();

    $conn = $SQL_DB->CreateConnection();
    
    $habits_result = $conn->query($habits_sql);
    if($habits_result->num_rows > 0) {
        while($row = $habits_result->fetch_assoc()) {
            // Parse Frequency JSON
            $row["frequency"] = json_decode($row["frequency"]);

            // Add Habit to return api
            $result[$row["id"]] = $row;

            // Query Habits Completed
            $habits_completed_sql = "SELECT * FROM `habits_completed` WHERE `habit_id`=" . $row["id"];
            $habits_completed_result = $conn->query($habits_completed_sql);

            // Create empty array incase the habit hasn't been completed
            $result[$row["id"]]["completed"] = array();

            if($habits_completed_result->num_rows > 0) {
                while($completed_row = $habits_completed_result->fetch_assoc()) {
                    $result[$row["id"]]["completed"][$completed_row["id"]] = $completed_row;
                }
            }

        }
    }


    echo json_encode($result);

?>