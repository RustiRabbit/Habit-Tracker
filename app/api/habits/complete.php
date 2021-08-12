<?php 
    // Check Authentication
    include("../../partials/auth_check.php");
    
    // Database
    include("../../../php/CONFIG.php"); 
    
    $habit_id = $_GET["habit_id"];

    // Create Connection
    $conn = $SQL_DB->CreateConnection();
    $sql = "INSERT INTO `habits_completed` (`habit_id`, `time_completed`) VALUES (" . $habit_id . ", " . time() .") ";

    if($conn->query($sql) === TRUE) {
        $responce = array("message"=>"ok");
        echo json_encode($responce);
    } else {
        echo $conn->error;
        $responce = array("message"=>"error");
        echo json_encode($responce);
    }

?>