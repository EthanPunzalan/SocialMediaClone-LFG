<?php
require_once "db.inc.php";

session_start();
$postId = $_GET['postId'];
$_SESSION['commentID'] = $_GET['id'];
$commentId = $_SESSION['commentID'];




$sql = "DELETE FROM comments WHERE id='$commentId';";
$res = mysqli_query($db,$sql);

if($res){
    header("location:../comment.php?id=".$postId);
    exit();
}else{
    header("location:../homePage.php?error=error");
    exit();
}