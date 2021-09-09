<?php 
    $name = "";
    if(isset($user->first) == true) {
        $name = $user->first . " " . $user->last;
    } else {
        $name = "User Auth Not Setup";
    }

    // Disable Cache for Development
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>

<div class="navbar">
    <div class="top">
        <h1><a href="/app">Habit Tracker</a></h1>
        <div class="account">
            <p><?php echo $name ?></p>
            <a href="/app/acc_settings.php">
                <?php echo file_get_contents("../public/images/icons/settings.svg"); ?>
            </a>
            <a href="/auth/logout.php">
                <?php echo file_get_contents("../public/images/icons/logout.svg"); ?>
            </a>
        </div>
    </div>
    <div class="bottom">
        <ul>
            <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/app' or $_SERVER['REQUEST_URI'] == '/app/' or $_SERVER['REQUEST_URI'] == '/app/index.php') ? 'active':'' ?>"><a href="/app">dashboard</a></li>
            <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/app/habits.php' or $_SERVER["REQUEST_URI"] == "/app/habits.php?create=1") ? 'active':'' ?>"><a href="/app/habits.php">habits</a></li>
            <li class="<?php echo ($_SERVER['REQUEST_URI'] == '/app/calendar.php') ? 'active':'' ?>"><a href="/app/calendar.php">calendar</a></li>
        </ul>
    </div>
</div>