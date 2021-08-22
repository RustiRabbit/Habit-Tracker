<?php 
    // This API endpoint deletes a habit

     // THIS IS AN API PAGE - NO HTML

    // Include Authentication
    include("../../partials/auth_check.php");
    
    // Include Config
    include("../../../php/CONFIG.php");

    /* 
        Register GET Params
        habit_id
    */
    $habit_id = $_GET["habit_id"];

    // Create SQL Connection
    $conn = $SQL_DB->CreateConnection();
    /*
        Create SQL Query and Save in variable
        Reference -> https://www.w3schools.com/sql/sql_delete.asp

        Include WHERE condition for user_id - make sure that only the right person can access the database
    */

    // Create Result variable that runs SQL Query eg: $conn->query(SQL)

    // Check if the result variable equals true;
    // https://www.w3schools.com/php/php_mysql_delete.asp - Look at example (bottom 10ish lines)

    // If result is true echo "ok"
    // If result is else echo "error"
?>