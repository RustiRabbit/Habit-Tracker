<?php 
    // Check Authentication
    include("../../partials/auth_check.php");
    include("../../../php/CONFIG.php");

    $habit_name = $_GET["habit_name"];
    $habit_desc = $_GET["habit_desc"];

    $conn = $SQL_DB->CreateConnection();
    $sql = "INSERT INTO `habits` (`name`,`description`, `user_id`) VALUES ('" . $habit_name ."', '" . $habit_desc . "', '" . $user->id . "')";

    if($conn->query($sql) === TRUE) {
        $responce = array("message"=>"ok");
        echo json_encode($responce);
    } else {
        echo $conn->error;
        $responce = array("message"=>"error");
        echo json_encode($responce);
    }


?>