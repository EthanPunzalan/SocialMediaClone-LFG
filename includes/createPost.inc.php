<?php

if(isset($_POST['submit'])){
    session_start();
    $text = $_POST['userPost'];
    $image = $_FILES['fileUpload'];
    $_SESSION['postTag'] = $_GET['tag'];
    $tag = $_SESSION['postTag'];

    $fileName = $_FILES['fileUpload']['name'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if(postEmpty($text,$fileName) !== false){
        header('location:../homePage.php?error=postempty');
        exit();
    }

    if(!empty($fileName)){
        createPost_image($db,$text,$image,$tag);   
    }else{
        createPost($db,$text,$tag);
    }
    
}