<?php 
    $name = "";
    if(isset($user->first) == true) {
        $name = $user->first . " " . $user->last;
    } else {
        $name = "User Auth Not Setup";
    }
?>

<div class="navbar">
    <div class="title">
        <h1><a href="/app">Habit Tracker</a></h1>
        <a onclick="toggle()" class="icon">&#9776;</a>
    </div>
    <div id="mobile-dropdown" class="drop-hide" style="flex-grow: 1;">
        <div class="mobile-dropdown">
            <div class="pages">
                <ul>
                    <li><a href="/app">Dashboard</a></li>
                    <li><a href="/app/habits.php">Habits</a></li>
                    <li><a href="/app/calendar.php">Calendar</a></li>
                </ul>
            </div>

            <div class="account-dropdown">
                <p id="desktop">
                    <?php echo $name ?>
                </p>
                <div class="dropdown-content">
                    <ul>
                        <li><a href="/app/acc_settings.php">Account Settings</a></li>
                        <li><a href="/auth/logout.php">Logout</a></li>
                    </ul>
                </div>
                <p id="mobile">
                    <?php echo $name ?>
                </p>
            </div>
        </div>
    </div>
    
</div>

<script>
    function toggle() {
        var element = document.getElementById("mobile-dropdown");
        if(element.className === "drop-hide") {
            element.className = "drop-show";
        } else {
            element.className = "drop-hide";

        }
    }

</script>

