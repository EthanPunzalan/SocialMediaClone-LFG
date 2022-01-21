<?php
    require_once 'includes/db.inc.php';
    $user = $_SESSION['useruid'];
    $postId = $_SESSION['postID'];
    $sql = "SELECT * FROM comments";
    $res = mysqli_query($db,$sql);

    if(mysqli_num_rows($res) > 0){
        $result=mysqli_query($db,"SELECT * FROM comments WHERE post_id='$postId' order by id DESC");
        $i=0;
        while($row=mysqli_fetch_array($result)){
?>

<div class="postFeed_container">
    <div class="postFeed_icon">
            <?php 
                if($row['photo'] > 0){
                    echo "<img class='profile_PictureNav' src='uploads/".$row['photo']."'>";
                }else{
                    echo "<img class='profile_PictureNav' src='imgs/profile.jpg'>";
                } 
            ?>
        <p class="usernamePost"><?php echo $row['username']?></p>   
    </div>
    <div class="postFeed">
        <p class="actualPost"><?php echo $row['comments']?></p>
    </div>

    <div class="postOptions_Container">
    <?php

if($row['username'] == $user){

?>
<div class="edit_deleteOption">
    <a href="includes/deleteComment.inc.php?id=<?php echo $row['id']?>&&postId=<?php echo $row['post_id']?>">Delete</a>
</div>
<?php
}
?>
        <div class="likeBox">
            <p class="likes"><?php echo $row['likes']?></p>
            <a class="likeLabel" href="includes/commentLikes.inc.php?id=<?php echo $row['id']?>&&postId=<?php echo $row['post_id']?>"><i class="fas fa-arrow-up"></i></a>
        </div>
        <div class="dislikeBox">
            <p class="dislikes"><?php echo $row['dislikes']?></p>
            <a class="dislikeLabel" href="includes/commentDislike.inc.php?id=<?php echo $row['id']?>&&postId=<?php echo $row['post_id']?>"><i class="fas fa-arrow-down"></i></a>
        </div>  
    </div>
</div>

<?php
$i++;
    }
}
?>

