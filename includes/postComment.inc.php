<?php

if(isset($_POST['submit'])){
    $text = $_POST['userComment'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    if(postEmpty($text) !== false){
        header('location:../homePage.php?error=postempty');
        exit();
    }

    createComment($db,$text);
}