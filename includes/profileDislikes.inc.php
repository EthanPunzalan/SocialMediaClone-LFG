<?php
require_once "db.inc.php";

session_start();
$_SESSION['postID'] = $_GET['id'];
$postId = $_SESSION['postID'];


$sql = "UPDATE posts SET dislikes=dislikes + 1 WHERE id='$postId'";
$res = mysqli_query($db,$sql);

if($res){
    header("location:../profile.php#".$postId);
    exit();
}else{
    header("location:../profile.php?error=error");
    exit();
}