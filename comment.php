<?php
require_once 'includes/db.inc.php';
session_start();
    if (isset($_SESSION['userid'])) 
    {
        $_SESSION['postID'] = $_GET['id'];
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
    <link rel="stylesheet" href="css/comments.css">
    <script defer src="scripts/all.js"></script>
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
                <a class="nav-link" href="">
                    <i class="fas fa-star fa-4x"></i>
                    <span class="link-text">Trending</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-users fa-4x"></i>
                    <span class="link-text">About</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
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
    
            <?php
                include('includes/comment.inc.php');
            ?>
                  
        <!-- Comment box -->
        <div class="comment_container">
            <div class="comment_icon">
            <?php 
                if(mysqli_num_rows($res) > 0){
                    $result=mysqli_query($db,"SELECT * FROM users WHERE id='$user'");
                    while($row=mysqli_fetch_array($result)){
                        
                if($row['photo'] > 0){
                    echo "<img class='profile_PictureNav' src='uploads/".$row['photo']."'>";
                }else{
                    echo "<img class='profile_PictureNav' src='imgs\profile.jpg'>";
                } 
                }
            }
            ?>
            </div>
            <div class="createComment">
                <form action="includes/postComment.inc.php" method="POST">  
                    <textarea name="userComment" class="userComment" placeholder="What's on your mind..."></textarea>
                    <div class="postBtn">
                        <input type="submit" name="submit" value="Comment">
                    </div>
                </form>
            </div>
        </div>
        <!-- post area/ news feed -->
        <?php
            // $sqlPost = 'SELECT comments FROM posts order by id DESC';
            // $resPost = mysqli_query($db,$sqlPost);
            
            // if(mysqli_num_rows($resPost) > 0){
            //     $result=mysqli_query($db,"SELECT comments FROM posts order by id DESC");
            //     while($row=mysqli_fetch_array($result)){
                    include('includes/newComments.inc.php');
            //     }
            // }
        ?>
    </div>
    </div> 
</body>
</html>

<?php
        }
    }
}
?>