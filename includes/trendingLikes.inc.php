<?php
require_once "db.inc.php";

session_start();
$_SESSION['postID'] = $_GET['id'];
$postId = $_SESSION['postID'];


$sql = "UPDATE posts SET likes=likes + 1 WHERE id='$postId'";
$res = mysqli_query($db,$sql);

if($res){
    header("location:../trending.php#".$postId);
    exit();
}else{
    header("location:../homePage.php?error=error");
    exit();
}