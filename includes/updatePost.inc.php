<?php
session_start();
if(isset($_POST['submit'])){
    $text = $_POST['userPost'];
    $postId = $_SESSION['postID'];
    $image = $_FILES['fileUpload'];

    $fileName = $_FILES['fileUpload']['name'];



    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if(editpostEmpty($text) !== false){
        header('location:../editPost.php?id='.$postId);
        exit();
    }else if(!empty($fileName)){
        editPost_image($db,$text,$postId,$image);
    }else{
        editPost($db,$text,$postId);
    }

    
        

} else if(isset($_POST['delete'])){
    $postId = $_SESSION['postID'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    deletePost($db,$postId);
}


