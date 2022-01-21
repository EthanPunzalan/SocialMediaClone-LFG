<?php
    require_once 'db.inc.php';
    $_SESSION['postID'] = $_GET['id'];

    $postId = $_SESSION['postID'];

    $sql = "SELECT * FROM posts WHERE id='$postId'";
    $res = mysqli_query($db,$sql);

    if(mysqli_num_rows($res) > 0){
            $result=mysqli_query($db,"SELECT * FROM posts WHERE id='$postId'");
            while($row=mysqli_fetch_array($result)){
?>

        <div class="post_container">
            <!-- icon -->
            <div class="post_icon">
            <?php 
                if($row['photo'] > 0){
                    echo "<img class='profile_PictureNav' src='uploads/".$row['photo']."'>";
                }else{
                    echo "<img class='profile_PictureNav' src='imgs/profile.jpg'>";
                } 
            ?>
                <p class="usernamePost"><?php echo $row['username']?></p>   
            </div>
            <!-- Post -->
            <div class="postFeed">
                <div class="actualPost">  
                    <p name="userPost" class=".actualPost"><?php echo $row['post']?></p>
                    <?php 
                    if($row['image'] > 0){
                        echo "<img class='fileUpload' src='uploads/".$row['image']."'>";
                    }else{
                        
                    } 
                    ?>
                </div>
            </div>
        </div>


<?php
    }
}
?>
   