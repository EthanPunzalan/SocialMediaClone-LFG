<?php
require_once 'includes/db.inc.php';
session_start();
    if (isset($_SESSION['userid'])) 
    {
        if(!empty($_GET['tag'])){
            $tag = $_GET['tag'];
        }else{

        }
        
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

    <div class="mainContainer">
        <!-- create post -->
        <div class="createPost_container">
            <div class="createP_icon">
            <?php 
                if($row['photo'] > 0){
                    echo "<img class='profile_PictureNav' src='uploads/".$row['photo']."'>";
                }else{
                    echo "<img class='profile_PictureNav' src='imgs\profile.jpg'>";
                } 
            ?>
            </div>
            <div class="createPost">
                <div class="dropdown">
                <button class="dropbtn">Tags:</button>
                    <div class="dropdown-content">
                        <a href="homePage.php">None</a>
                        <a href="homePage.php?tag=Minecraft">Minecraft</a>
                        <a href="homePage.php?tag=Valorant">Valorant</a>
                        <a href="homePage.php?tag=ApexLegends">Apex Legends</a>
                        <a href="homePage.php?tag=MarioKart">Mario Kart</a>
                    </div>
                </div>
                <form action="includes/createPost.inc.php<?php if(!empty($tag)){
                        echo "?tag=".$tag;
                    }else{

                    }?>" method="POST" enctype="multipart/form-data">  
                    <textarea name="userPost" class="userPost" placeholder="What's on your mind..."></textarea>
                    <div class="postBtn">
                        <input type="submit" name="submit" value="Post">
                        <label class="uploadFileLabel" for="uploadFile"><i class="fas fa-cloud-upload-alt"></i></label>
                        <img class="previewFile" src="" id="picture">
                        <input id="uploadFile" type="file" name="fileUpload" onchange="view()">
                        <?php 
                    if(!empty($tag)){
                        echo "<p class='tag'>".$tag."</p>";
                    }else{

                    }
                ?>
            </div>
                    </div>
                </form>
        </div>
        <!-- post area/ news feed -->
        <?php  
            include('includes/posts.inc.php');  
        ?>
    </div>
</body>
</html>

<?php
        }
    }
}
?>