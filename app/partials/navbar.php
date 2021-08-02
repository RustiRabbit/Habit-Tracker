<div class="header">
    <h1><a href="/app">Habit Tracker</a></h1>
    <div class="menu">
        <p><a href="/app">Dashboard</a></p>
        <p><a href="/app/calander.php">Calendar</a></p>
        <p><a href="/app/habits.php">Habits</a></p>
    </div>
    <div class="dropdown">
        <p>
        <?php 
            if(isset($user->first) == true) {
                echo $user->first . " " . $user->last;
            } else {
                echo "User Auth Not Setup";
            }
        ?>
        </p>
        <div class="dropdown-content">
            <ul>
                <li><a href="#">Account Settings</a></li>
                <li><a href="/auth/logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</div>