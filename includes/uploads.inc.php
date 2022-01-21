<?php

if(isset($_POST['submit'])){
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $pwdConfirm = $_POST['C_password'];
    $file = $_FILES['photo'];

    require_once 'db.inc.php';
    require_once 'functions.inc.php';


    if(newUsernameExists($db,$username,$email) !== false){
        header('location:../profile.php?error=usernametaken');
        exit();
    }else{

        updateUser($db,$f_name,$l_name,$email,$username,$pwd,$pwdConfirm,$file);
    }   
}