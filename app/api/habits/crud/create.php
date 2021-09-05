<?php 
    // Check Authentication
    include("../../../partials/auth_check.php");
    include("../../../../php/CONFIG.php");

    $habit_name = $_GET["habit_name"];
    $habit_desc = $_GET["habit_desc"];
    $habit_freq = $_GET["habit_freq"];

    $start_date = DateTime::createFromFormat('Y-m-d H:i:s', (new DateTime())->setTimestamp(time())->format('Y-m-d 00:00:00'))->getTimestamp()-(60*60*12);


    $conn = $SQL_DB->CreateConnection();
    $sql = 'INSERT INTO `habits` (`name`,`description`, `frequency`, `user_id`, `start_date`) VALUES (\'' . $habit_name . '\', \'' . $habit_desc . '\', \'' . $habit_freq . '\', \'' . $user->id . '\', \'' . $start_date . '\')';

    if($conn->query($sql) === TRUE) {
        echo "ok";
    } else {
        echo $conn->error;
        echo "error";
    }
?>