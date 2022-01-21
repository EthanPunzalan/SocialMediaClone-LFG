<?php
include_once 'includes/db.inc.php';
session_start();
    if (isset($_SESSION['userid']))
    {
        $user = $_SESSION['userid'];
        $sql = "SELECT * FROM users WHERE id='$user'";
        $res = mysqli_query($db, $sql);

        if(mysqli_num_rows($res) > 0){
            $result=mysqli_query($db,"SELECT * FROM users WHERE id='$user'");
            while($row=mysqli_fetch_array($result)){
    ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profileEdit.css">
    <script defer src="scripts/all.js"></script>
    <script>
        function view(){
            picture.src=URL.createObjectURL(event.target.files[0]);
        }
    </script>
    <title>LFG|Profile</title>
</head>
<body>
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="profile.php" class="nav-link">
                    <?php 
                        if($row['photo'] > 0){
                            echo "<img class='profile_PictureNav' src='uploads/".$row['photo']."'>";
                        }else{
                            echo "<img class='profile_PictureNav' src='imgs\profile.jpg'>";
                        } 
                    ?>
                    <span class="link-text"><?php echo $row['username']?></span>
                    <span class="underline"></span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="homePage.php">
                    <i class="fas fa-home fa-4x"></i>
                    <span class="link-text">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="trending.php">
                    <i class="fas fa-star fa-4x"></i>
                    <span class="link-text">Trending</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-users fa-4x"></i>
                    <span class="link-text">About</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">
                    <i class="fas fa-id-card fa-4x"></i>
                    <span class="link-text">Contacts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="includes/logout.inc.php">
                    <i class="fas fa-sign-out-alt fa-4x"></i>
                    <span class="link-text">Logout</span>
                </a>
            </li>
        </ul>
    </nav>
    
    <!-- <div class="topBar">
        <h1>Hello <?php echo $row['username']?>! Welcome to LFG </h1>
    </div> -->

    <div class="mainContainer">
        <div class="profilePic_container">
            <div class="profilePic">
                <?php 
                    if($row['photo'] > 0){
                        echo "<img class='profile_Picture' src='uploads/".$row['photo']."'>";
                    }else{
                        echo "<img class='profile_Picture' src='imgs\profile.jpg'>";
                    } 
                ?>
            </div>
        </div>
        <div class="infoContainer">
                <?php
                    if(isset($_GET['error'])){
                        if($_GET['error'] == "noerror"){
                            echo "<p class='success'>Successfuly updated profile!</p>";
                        }
                    }
                ?>
            <form action="includes/uploads.inc.php" method="POST" enctype="multipart/form-data">
                <input class="info" type="text" name="f_name" placeholder="First Name" value="<?php echo $row['f_name']?>" required>
                <input class="info" type="text" name="l_name" placeholder="Lase Name" value="<?php echo $row['l_name']?>" required>
                <input class="info" type="email" name="email" placeholder="Email" value="<?php echo $row['email']?>" required>
                <input class="info" type="text" name="username" placeholder="Username" value="<?php echo $row['username']?>" required>
                <input class="info" type="password" name="password" placeholder="Change Password">
                <input class="info" type="password" name="C_password" placeholder="Confirm New Password">
                <label class="btnLabel" for="">Change Profile Picture</label>
                <?php  
                    if($row['photo'] > 0){
                        echo "<label for='infoFile'><img class='profile_Picture_change' id='picture' src='uploads/".$row['photo']."'></label>";
                    }else{
                        echo "<label for='infoFile'><img class='profile_Picture_change' id='picture' src='imgs\profile.jpg'></label>";
                    }
                ?>
                <input id="infoFile" type="file" name="photo" onchange="view()">
                <span class="spacer"></span>
                <button class="infoBtn" type="submit" name="submit">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php
        }
    }
}
?>