<?php 
    // Include Authentication
    include("../../partials/auth_check.php");
    
    // Include Config
    include("../../../php/CONFIG.php");

    $habit_name = $_GET["habit_name"];
    $habit_desc = $_GET["habit_desc"];
    $habit_freq = $_GET["habit_freq"];
    $habit_id = $_GET["habit_id"];

    // Create SQL Connection
    $conn = $SQL_DB->CreateConnection();
    $edit_query = "UPDATE `habits` SET `name` = '" . $habit_name . "', `description` = '" . $habit_desc . "', `frequency` = '" . $habit_freq . "' WHERE `user_id` = " . $user->id . " AND `id` = " . $habit_id;

    // Check if SQL query worked
    if ($conn->query($edit_query) === TRUE) {
        echo "Ok";
        } else {
        echo "Error" . $conn->error;
        }
?>