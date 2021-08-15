<?php 
    // This file checks that the user has logged in and if they have, allows the page to load. Otherwise it redirects the user to the login page

    // Open Session
    session_start();

    // Create User Object
    class User {
        public $first;
        public $last;
        public $id;
        public $email;
        public $password;
    }
    $user = new User();
    if(isset($_SESSION["id"]) == false) {
        // User not logged in
        // Need to redirect to login page
        header("Location: /auth/login.php?message=You must log in first");
    } else {
        // Session Exists
        $user->id = $_SESSION["id"];
        $user->first = $_SESSION["first"];
        $user->last = $_SESSION["last"];
        $user->id = $_SESSION["id"];
        $user->email = $_SESSION["email"];
        $user->password = $_SESSION["password"];
    }
?>