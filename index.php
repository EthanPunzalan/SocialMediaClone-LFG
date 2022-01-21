<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.style.css">
    <title>LFG|Login</title>
</head>
<body>
    <div class="center">
        <h1>Welcome to LFG</h1>
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == "wronglogin"){
                    echo "<p class='errorMsg'>Invalid username or password</p>";
                }
            }   
        ?>
        <form action="includes/login.inc.php" method="POST">
            <div class="loginDetails">
                <input type="text" name="username" required>
                <span></span>
                <label>Username/Email</label>
            </div>
            <div class="loginDetails">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <input type="submit" name="login" value="Login">
            <div class="signupLink">
                Don't have an account? <a href="signup.php">Sign Up</a>
            </div>
        </form>

    </div>

    <?php
    session_destroy();
    ?>
</body>
</html>