<?php 
    // Check Authentication
    include("partials/auth_check.php");

    // Disable Cache for Development
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
?>

<!DOCTYPE>
<html>
    <head>
        <title>Habit Tracker</title>
        <?php include("partials/head.php") ?>

        <script src="/public/js/calendar.js" type="module"></script>
    </head>
    <body>
        <?php include("partials/navbar.php") ?>
        <noscript>Javascript is required for this page</noscript>
        <div id="calendar">

        </div>
    </body>

</html>