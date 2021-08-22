<?php 
    // Check Authentication
    include("partials/auth_check.php");
    include("../php/CONFIG.php");

    function createHabit($id, $name, $desc) {
        $html = '
            <div class="habit">
                <h1>' . $name . '</h1>
                <a href="#">' . file_get_contents("../public/images/icons/edit.svg") . '</a>
            </div>        
        ';
        return $html;
    }
    
    $conn = $SQL_DB->CreateConnection();

    $habits = "";

    // Initial SQL Request to get list of user habits 
    $habits_sql = "SELECT * FROM `habits` WHERE `user_id` = " . $_SESSION["id"];
    $habits_result = $SQL_DB->CreateConnection()->query($habits_sql); // Query Database

    if ($habits_result->num_rows > 0) { // Check that habits actually exist
        while($row = $habits_result->fetch_assoc()) { // Loop through the returned rows
            $id = $row["id"];
            $name = $row["name"];
            $desc = $row["description"];
            $habits .= createHabit($row["id"], $row["name"], $row["description"]); // Add Habit Element to the Page
        }
    } else {
        $habits = "<p>No habits</p>";
    }
    $SQL_DB->CreateConnection()->close();
?>
<html>
    <head>
        <title>Habit Tracker</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php include("partials/head.php") ?>
        <link rel="stylesheet" href="/public/css/pages/habits.css">
        <script src="/public/js/habits.js"></script>

    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <div class="title">
            <h1>Habits</h1>
        </div>

        <div class="habits">
            <?php echo $habits; ?>
        </div>

    </body>

</html>