<?php

if(isset($_POST['login'])){
    
    $username = $_POST['username'];
    $pwd = $_POST['password'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';

    loginUser($db,$username,$pwd);
}else{
    header('location:../index.php');
    exit();
}