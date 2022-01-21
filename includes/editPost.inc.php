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
            <p class="usernamePost"><?php echo $row['username']?></p>   
            </div>
            <div class="createPost">
                <form action="includes/updatePost.inc.php" method="POST" enctype="multipart/form-data">  
                    <textarea name="userPost" class="userPost"><?php echo $row['post']?></textarea>
                    <?php 
                        if($row['image'] > 0){
                            echo "<img class='fileUpload' id='picture' src='uploads/".$row['image']."'>";
                        }else{
                            echo '<img class="fileUpload" src="" id="picture">';
                        } 
                    ?>
                    <div class="buttonContainer">
                        <div class="postBtn">
                       
                            <label class="uploadFileLabel" for="uploadFile"><i class="fas fa-cloud-upload-alt"></i></label>
                            <a href="includes/deleteImage.inc.php?id=<?php echo $row['id']?>">Delete Image</a>
                            <input id="uploadFile" type="file" name="fileUpload" onchange="view()">
                            <input type="submit" name="submit" value="Save">
                        </div>
                    </div>
                </form>
            </div>
        </div>

<?php
    }
}
?>
   