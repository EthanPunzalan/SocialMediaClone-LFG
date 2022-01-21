<?php
require_once 'includes/db.inc.php';
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
    <link rel="stylesheet" href="css/homePage.css">
    <script defer src="scripts/all.js"></script>
    <script>
        function view(){
            picture.src=URL.createObjectURL(event.target.files[0]);
            picture.style.display = "block";
        }
    </script>
    <title>LFG|Homepage</title>
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
        <!-- create post -->
        <div class="createPost_container">
            <h1 class="about">CONTACTS</h1>
        </div>
        <!-- post area/ news feed -->
        <div class="postFeed_container" style="text-align:center;">
            <h2 style="color:white; font-weight:100; font-size:3rem">
                You can contact me through my email regarding any bugs found or for any suggestions to make the website better. 
                You can also let me know what other games I can add to the tags.<br><br>
                <span style="color: #2691d9">EMAIL: </span>punzalan.ethan@gmail.com<br>             
            </h2>
            
        </div>
    </div>
</body>
</html>

<?php
        }
    }
}
?>