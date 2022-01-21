<?php
    require_once 'includes/db.inc.php';
    $user = $_SESSION['useruid'];

    $sql = "SELECT * FROM posts";
    $res = mysqli_query($db,$sql);

    if(mysqli_num_rows($res) > 0){
            $result=mysqli_query($db,"SELECT * FROM posts order by id DESC");
            while($row=mysqli_fetch_array($result)){
?>
<div class="postFeed_container" id="<?php echo $row['id']?>">
    <div class="postFeed_icon">
            <?php 
                if($row['photo'] > 0){
                    echo "<img class='profile_PictureNav' src='uploads/".$row['photo']."'>";
                }else{
                    echo "<img class='profile_PictureNav' src='imgs/profile.jpg'>";
                } 
            ?>
            <span></span>
        <p class="usernamePost"><?php echo $row['username']?></p>   
    </div>
    <div class="postFeed">
        <p class="actualPost"><?php echo $row['post']?></p>
            <?php 
                if($row['image'] > 0){
                    echo "<img class='fileUpload' src='uploads/".$row['image']."'>";
                }else{
                    
                } 
            ?>
            <?php
            
            if(!empty($row['tag'])){
                echo "<p class='postTag'>".$row['tag']."</p>";
            }else{

            }

            ?>
    </div>
    <div class="postOptions_Container">
    <?php

if($row['username'] == $user){

?>
<div class="edit_deleteOption">
    <a href="editPost.php?id=<?php echo $row['id']?>">Edit</a><br>
    <a href="deletePost.php?id=<?php echo $row['id']?>">Delete</a>
</div>
<?php
}
?>
        <div class="likeBox">
            <p class="likes"><?php echo $row['likes']?></p>
            <a class="likeLabel" href="includes/like.inc.php?id=<?php echo $row['id']?>"><i class="fas fa-arrow-up"></i></a>
        </div>
        <div class="dislikeBox">
            <p class="dislikes"><?php echo $row['dislikes']?></p>
            <a class="dislikeLabel" href="includes/dislikes.inc.php?id=<?php echo $row['id']?>"><i class="fas fa-arrow-down"></i></a>
        </div>
        <div class="commentBox">
            <a class="commentLabel" href="comment.php?id=<?php echo $row['id']?>"><i class="fas fa-comments"></i></a>
        </div>
        
    </div>
</div>

<?php
    }
}
?>

