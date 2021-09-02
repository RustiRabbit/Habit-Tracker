<?php 
    // Include Authentication
    include("../../partials/auth_check.php");
    
    // Include Config
    include("../../../php/CONFIG.php");

    $habit_id = $_GET["habit_id"];

    // Create SQL Connection
    $conn = $SQL_DB->CreateConnection();
    $delete_query = "DELETE FROM `habits` WHERE `user_id` = " . $user->id . " AND `id` = " . $habit_id;

    // Check if SQL query worked
    if ($conn->query($delete_query) === TRUE) {
        echo "ok";
        } else {
        echo "error" . $conn->error;
        }
?>