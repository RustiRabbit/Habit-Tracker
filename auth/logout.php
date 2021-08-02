<?php 
    // Needs to destroy the session
    session_start();
    unset($_SESSION["id"]);
    unset($_SESSION["first"]);
    unset($_SESSION["last"]);
    session_destroy();
    header("Location: /"); // Redirect the user to the homepage
?>