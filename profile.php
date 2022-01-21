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
    <link rel="stylesheet" href="css/profile.styles.css">
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
            <div class="nameContainer">
                <p class="firstName"><?php echo $row['f_name']?> <?php echo $row['l_name']?></p>
                <p><?php echo $row['username']?></p>
                <p><?php echo $row['email']?></p>
            </div>
            <div class="editProfileContainer">
                <a href="profileEdit.php">Edit Profile</a>
            </div>
        </div>

        <?php
            include('includes/profile.inc.php');
        ?>
    </div>
</body>
</html>

<?php
        }
    }
}
?>