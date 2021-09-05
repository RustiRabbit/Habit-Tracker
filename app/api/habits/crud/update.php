<?php 
    // Include Authentication
    include("../../../partials/auth_check.php");
    
    // Include Config
    include("../../../../php/CONFIG.php");

    $habit_name = $_GET["habit_name"];
    $habit_desc = $_GET["habit_desc"];
    $habit_freq = $_GET["habit_freq"];
    $habit_id = $_GET["habit_id"];

    // Create SQL Connection
    $conn = $SQL_DB->CreateConnection();
    $edit_query = "UPDATE `habits` SET `name` = '" . $habit_name . "', `description` = '" . $habit_desc . "', `frequency` = '" . $habit_freq . "' WHERE `user_id` = '" . $user->id . "' AND `id` = " . $habit_id;

    $result = $conn->query($edit_query);

    if ($result === TRUE) {
        if ($conn->affected_rows == 0) {
            echo "nothing changed";
        } elseif ($conn->affected_rows == 1){
            echo "ok";
        } else {
            echo "error";
        }
    } else {
        echo "error";
        echo $conn->error;
    }

?>