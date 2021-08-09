<?php 
    // Check Authentication
    include("partials/auth_check.php");

    function createHabit($id, $name, $desc) {
        return '<div class="habit-card"><h3>' . $name . '</h3><div class="icons"><a onclick="Modal.Open(\'' . $id  .'\', \'' . $name .'\', \'' . $desc .'\')"><i class="fa fa-edit"></i></a><a><i class="fa fa-trash"></i></a></div></div>';
    }
    
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
        <div class="top">
            <h1>Habits</h1>
            <a>Add</a>
        </div>
        <div class="habits">
            <?php 
                echo createHabit("2", "Go for a run", "test");
            ?>
        </div>

        <div class="popup hide" id="popup">
            <div class="popup-bg">
                <div class="popup-top">
                    <h3>Editing</h3>
                    <a onclick="Modal.Close()">Close</a>
                </div>
                <div class="popup-content">
                    <p>Name: </p><input id="name" type="text">
                    <p>Description: </p><input id="description" type="text">
                </div>
                <div class="popup-bottom">
                    <a>Save</a>
                </div>
                
            </div>
        </div>


    </body>

</html>