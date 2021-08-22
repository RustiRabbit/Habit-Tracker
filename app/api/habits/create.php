<?php 
    // Check Authentication
    include("../../partials/auth_check.php");
    include("../../../php/CONFIG.php");

    $habit_name = $_GET["habit_name"];
    $habit_desc = $_GET["habit_desc"];
    $habit_freq = $_GET["habit_freq"];

    $conn = $SQL_DB->CreateConnection();
    $sql = "INSERT INTO `habits` (`name`,`description`, `user_id`) VALUES ('" . $habit_name ."', '" . $habit_desc . "', '" . $user->id . "')";

    if($conn->query($sql) === TRUE) {
        echo "ok";
    } else {
        echo $conn->error;
        echo "error";
    }


?>