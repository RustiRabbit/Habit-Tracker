<?php 
    include_once("../php/CONFIG.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="/public/css/pages/auth.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />

    </head>
    <body>
        <div class="content">
            <div class="card">
                <h1>Habit Tracker</h1>
                <h3>Signup</h3>
                <form action="" method="POST">
                    <div class="input">
                        <p>First Name</p>
                        <input type="text" id="first_name" name="first_name" value="">
                    </div>
                    <div class="input">
                        <p>Last Name</p>
                        <input type="text" id="last_name" name="last_name" value="">
                    </div>
                    <div class="input">
                        <p>Email</p>
                        <input type="text" id="email" name="email" value="">
                    </div>
                    <div class="input">
                        <p>Password</p>
                        <input type="password" id="password" name="password" value="">
                    </div>
                    <div class="button">
                        <input type="submit" value="Signup">
                    </div>
                </form>
                <p>Already have an account? <a href="/auth/login.php">Log in</a></p>
            </div>
        </div>
        
        
    </body>
</html>