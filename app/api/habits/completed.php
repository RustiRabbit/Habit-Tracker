<?php 
    // This file gets all completed habits between two unix time stamps (intended between a month)
    
    // Check Authentication
    include("../../partials/auth_check.php");

    // Include Database
    include("../../../php/CONFIG.php");

    // First thing required is to get all of the habits associated with the user
    $conn = $SQL_DB->CreateConnection();
    $habits_query = "SELECT * FROM `habits` WHERE `user_id`=" . $user->id;
    $habits_result = $conn->query($habits_query);

    $habits = array();

    if($habits_result->num_rows > 0) {
        while($row = $habits_result->fetch_assoc()) {
            $habits[$row["id"]] = array(
                "name" => $row["name"]
            );
        }
    }

    // Generate query to select completed habits
    $id = implode("', '", array_keys($habits));
    $habits_completed_query = "SELECT * FROM `habits_completed` WHERE `habit_id` in ('$id')";
    $habits_completed_result = $conn->query($habits_completed_query);

    if($habits_completed_result->num_rows > 0) {
        while($row = $habits_completed_result->fetch_assoc()) {
            $habits[$row["habit_id"]]["times"][$row["id"]] = $row["time_completed"];
        }
    }

    echo json_encode($habits);


?>