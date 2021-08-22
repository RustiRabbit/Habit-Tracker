<?php 
    // This file allows you to edit and update a habit

    // THIS IS AN API PAGE - NO HTML

    // Include Authentication
    include("../../partials/auth_check.php");
    
    // Include Config
    include("../../../php/CONFIG.php");

    /* 
        Register GET Params
        habit_name
        habit_desc
        habit_freq
        habit_id
    */
    $habit_name = $_GET["habit_name"];

    // Create SQL Connection
    $conn = $SQL_DB->CreateConnection();
    /*
        Create SQL Query and Save in variable
        Reference -> https://www.w3schools.com/sql/sql_update.asp

        Include WHERE condition for user_id
    */

    // Create Result variable that runs SQL Query eg: $conn->query(SQL)

    // Check if the result variable equals true;
    // https://www.w3schools.com/php/php_mysql_update.asp - Look at example (bottom 10ish lines)

    // If result is true echo "ok"
    // If result is else echo "error"
?>