<?php 
    // Check Authentication
    include("partials/auth_check.php");

    function createHabit($id, $name, $desc) {
        return "<li>ID: " . $id . ", Name: " . $name . "<p>" . $desc . "</p></li>";
    }
    
?>

<!DOCTYPE>
<html>
    <head>
        <title>Habit Tracker</title>

        <link rel="stylesheet" href="/public/css/pages/habits.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <?php include("partials/head.php") ?>
    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <div class="top">
            <h1>Habits</h1>
            <a>Add</a>
        </div>
        <div class="habits">
            <div>
                <h3>Go for a run</h3>
                <i class="fa fa-edit"></i> 
                <i class="fa fa-trash"></i>
            </div>
            <?php 
                echo createHabit("1", "WESLEY", "lol man");
            ?>
        </ul>

    </body>

</html>