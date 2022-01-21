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

<div class="createPost_container">
            <div class="createP_icon">
            <?php 
                if($row['photo'] > 0){
                    echo "<img class='profile_PictureNav' src='uploads/".$row['photo']."'>";
                }else{
                    echo "<img class='profile_PictureNav' src='imgs/profile.jpg'>";
                } 
            ?>
            </div>
            <div class="createPost">
                <form class="postContainer" action="includes/updatePost.inc.php" method="POST">  
                    <p name="userPost" class=".actualPost"><?php echo $row['post']?></p>
                    <div class="deletebuttonContainer">
                        <div class="postBtn">
                            <input type="submit" name="delete" value="Delete">
                        </div>
                    </div>
                </form>
            </div>
        </div>

<?php
    }
}
?>
   