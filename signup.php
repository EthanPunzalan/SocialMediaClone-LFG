<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/signup.style.css">
    <title>LFG|Registration Page</title>
</head>
<body>
    <div class="center">
        <h1>Registration</h1>
        <?php
            if(isset($_GET['error'])){
                if($_GET['error'] == "passwordsdontmatch"){
                    echo "<p class='errorMsg'>Password don't match</p>";
                }else if ($_GET['error'] == "usernametaken"){
                    echo "<p class='errorMsg'>Username Already Taken</p>";
                }else if ($_GET['error'] == "noerror"){
                    echo "<p class='success'>Successfuly signed up!</p>";
                }
            }   
        ?>
        <form action="includes/signup.inc.php" method="POST">
            <div class="loginDetails">
                <input type="text" name="f_name" required>
                <span></span>
                <label>First Name</label>
            </div>
            <div class="loginDetails">
                <input type="text" name="l_name" required>
                <span></span>
                <label>Last Name</label>
            </div>
            <div class="loginDetails">
                <input type="email" name="email" required>
                <span></span>
                <label>Email</label>
            </div>
            <div class="loginDetails">
                <input type="text" name="username" required>
                <span></span>
                <label>Username</label>
            </div>
            <div class="loginDetails">
                <input type="password" name="password" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="loginDetails">
                <input type="password" name="C_password" required>
                <span></span>
                <label>Confirm Password</label>
            </div>
            <input id="signup" type="submit" name="signup" value="Sign Up!">
            <div class="loginLink">
                Already have an account? <a href="index.php">Log in</a>
            </div>
        </form>
    </div>
</body>
</html>