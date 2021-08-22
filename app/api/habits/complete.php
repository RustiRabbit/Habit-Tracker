<?php 
    // Adds a completed habit into the database

    // Check Authentication
    include("../../partials/auth_check.php");
    include("../../../php/CONFIG.php");

    $conn = $SQL_DB->CreateConnection();

    $habits_sql = "SELECT * FROM `habits` WHERE `id` = " . $_GET["habit_id"] . " AND `user_id` = " . $user->id;
    $habits_result = $conn->query($habits_sql);
    if($habits_result->num_rows > 0) {
        $complete_sql = "INSERT INTO `habits_completed` (`id`, `habit_id`, `time_completed`) VALUES (NULL, '" . $_GET["habit_id"] . "', '" . time() . "')";    

        $complete_result = $conn->query($complete_sql);
        echo "ok";
    } else {
        echo "error";
    }
?>