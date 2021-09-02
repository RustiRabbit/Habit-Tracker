<?php 
    // Check Authentication
    include("partials/auth_check.php");
    include("../php/CONFIG.php");

    function createHabit($id, $name, $desc, $frequency) {
        $days = "";
        
        foreach(json_decode($frequency) as $key => $value) {
            $display = "";
            switch($key) {
                case 0:
                    $display = "M";
                    break;
                case 1:
                    $display = "T";
                    break;
                case 2:
                    $display = "W";
                    break;
                case 3:
                    $display = "T";
                    break;
                case 4:
                    $display = "F";
                    break;
                case 5:
                    $display = "S";
                    break;
                case 6:
                    $display = "S";
                    break;
            }

            if($value == 1) {
                $days .= "<span class='selected'>" . $display . "</span>";
            } else {
                $days .= "<span class=''>" . $display . "</span>";
            }
        }
        $html = '
            <div class="habit">
                <h1>' . $name . '</h1>
                <div id="days">' . $days . '</div>
                <a href="#" onclick="EDIT.Show(\''. $id . '\', \'' . $name . '\', \'' . $desc . '\')">' . file_get_contents("../public/images/icons/edit.svg") . '</a>
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
            $habits .= createHabit($row["id"], $row["name"], $row["description"], $row["frequency"]); // Add Habit Element to the Page
        }
    } else {
        $habits = '<p id="empty" onclick="CREATE.Show()">Create a habit</p>';
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
            <a href="#" onclick="CREATE.Show()"><?php echo file_get_contents("../public/images/icons/create.svg") ?></a>
        </div>

        <div class="habits">
            <?php echo $habits; ?>
        </div>

        <form id="edit-form" onsubmit="return false">
            <div class="modal" id="edit">
                <div class="modal-content">
                    <div class="top">
                        <h1>Editing</h1>
                        <a onclick="EDIT.Hide()"><?php echo file_get_contents("../public/images/icons/close.svg") ?></a>
                    </div>
                    
                    <div class="input">
                        <h2>Name:</h2>
                        <div class="text">
                            <input name="habit-name" type="text" placeholder="What do you want to accomplish?">
                        </div>
                    </div>
                    <div class="input">
                        <h2>Description:</h2>
                        <div class="text">
                            <textarea name="habit-desc" rows="4" cols="40" placeholder="Describe your habit"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <h2>Frequency:</h2>
                        <div class="days">
                            <div class="day">
                                <input name="mon" type="checkbox">
                                <span>M</span>
                            </div>
                            <div class="day">
                                <input name="tue" type="checkbox">
                                <span>T</span>
                            </div>
                            <div class="day">
                                <input name="wed" type="checkbox">
                                <span>W</span>
                            </div>
                            <div class="day">
                                <input name="thu" type="checkbox">
                                <span>T</span>
                            </div>
                            <div class="day">
                                <input name="fri" type="checkbox">
                                <span>F</span>
                            </div>
                            <div class="day">
                                <input name="sat" type="checkbox">
                                <span>S</span>
                            </div>
                            <div class="day">
                                <input name="sun" type="checkbox">
                                <span>S</span>
                            </div>
                        </div>
                    </div>
                
                    <div class="bottom">
                        <button type="submit" id="delete" onclick="EDIT.DELETE()">Delete</button>
                        <button type="submit" id="save" onclick="EDIT.UPDATE()">Update</button>
                    </div>
                </div>
            </div>
        </form>
        
        <form id="create-form" onsubmit="return false">
            <div class="modal" id="create">
                <div class="modal-content">
                    <div class="top">
                        <h1>Create</h1>
                        <a href="#" onclick="CREATE.Hide()"><?php echo file_get_contents("../public/images/icons/close.svg") ?></a>
                    </div>
                    
                    <div class="input">
                        <h2>Name:</h2>
                        <div class="text">
                            <input name="habit-name" type="text" placeholder="What do you want to acomplish?">
                        </div>
                    </div>
                    <div class="input">
                        <h2>Description:</h2>
                        <div class="text">
                            <textarea name="habit-desc" rows="4" cols="40" placeholder="Describe your habit"></textarea>
                        </div>
                    </div>
                    <div class="input">
                        <h2>Frequency:</h2>
                        <div class="days">
                            <div class="day">
                                <input name="mon" type="checkbox">
                                <span>M</span>
                            </div>
                            <div class="day">
                                <input name="tue" type="checkbox">
                                <span>T</span>
                            </div>
                            <div class="day">
                                <input name="wed" type="checkbox">
                                <span>W</span>
                            </div>
                            <div class="day">
                                <input name="thu" type="checkbox">
                                <span>T</span>
                            </div>
                            <div class="day">
                                <input name="fri" type="checkbox">
                                <span>F</span>
                            </div>
                            <div class="day">
                                <input name="sat" type="checkbox">
                                <span>S</span>
                            </div>
                            <div class="day">
                                <input name="sun" type="checkbox">
                                <span>S</span>
                            </div>
                        </div>
                    </div>
                
                    <div class="bottom">
                        <button id="save" onclick="CREATE.Create()">Create</button>
                    </div>
                </div>
            </div>
        </form>
        

    </body>

</html>