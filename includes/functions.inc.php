<?php

function pwdMatch($pwd,$pwdConfirm){
    $result;
    if($pwd !== $pwdConfirm){
        $result = true;
    }else{
        $result=false;
    }
    return $result;
}

function usernameExists($db,$username,$email){
    $sql="SELECT * FROM users WHERE username= ? OR email=?;";
    $stmt =mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('location:../signup.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ss",$username,$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;

        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($db,$f_name,$l_name,$email,$username,$pwd){
    $sql="INSERT INTO users (f_name,l_name,email,username,password,photo) VALUES (?,?,?,?,?,?);";
    $stmt =mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('location:../signup.php?error=stmtfailed');
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $photo = "";

    mysqli_stmt_bind_param($stmt,"ssssss",$f_name,$l_name,$email,$username,$hashedPwd,$photo);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('location:../signup.php?error=noerror');
    exit();
}

function loginUser($db,$username,$pwd){
    $usernameExists = usernameExists($db,$username,$username);

    if($usernameExists === false){
        header('location:../index.php?error=wronglogin');
        exit();
    }

    $pwdHashed = $usernameExists['password'];
    $checkPwd= password_verify($pwd,$pwdHashed);

    if($checkPwd === false){
        header('location:../index.php?error=wronglogin');
        exit();
    }else if($checkPwd === true){
        session_start();
        $_SESSION['userid'] = $usernameExists['id'];
        $_SESSION['useruid'] = $usernameExists['username'];
        header('location:../homePage.php');
        exit();
    }
}

function newUsernameExists($db,$username,$email){
    session_start();
    $user = $_SESSION['userid'];
    $sql="SELECT * FROM users WHERE id!= ? AND username= ? OR id!= ? AND email= ? ;";
    $stmt =mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('location:../profile.php?error=stmtfailed');
        exit();
    }

    mysqli_stmt_bind_param($stmt,"ssss",$user,$username,$user,$email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if(mysqli_fetch_assoc($resultData)){
        $result = true;
    }else{
        $result = false;

        return $result;
    }

    mysqli_stmt_close($stmt);
}

function updateUser($db,$f_name,$l_name,$email,$username,$pwd,$pwdConfirm,$file){
    session_start();
    $user = $_SESSION['userid'];

    $fileName = $_FILES['photo']['name'];
    $fileTmpName = $_FILES['photo']['tmp_name'];
    $fileSize = $_FILES['photo']['size'];
    $file_new_name = rand().$fileName;

    if(empty($pwd)){
        if($fileSize > 0){
            if($fileSize > 5242880){
                header('location:../profile.php?error=filetoobig');
                exit();
            }else{
                $sql = "UPDATE users SET f_name='$f_name',l_name='$l_name',email='$email',username='$username',photo='$file_new_name' WHERE id='$user';";
                $result = mysqli_query($db,$sql);
                if($result){
                    move_uploaded_file($fileTmpName,"../uploads/".$file_new_name);
                    header('location:../profile.php?error=noerror');
                    exit();
                }else{
                    header('location:../profile.php?error=failedtoupdate');
                    exit();
                }
            }
        }else{
            $sql = "UPDATE users SET f_name='$f_name',l_name='$l_name',email='$email',username='$username' WHERE id='$user';";
                $result = mysqli_query($db,$sql);
                if($result){
                    header('location:../profile.php?error=noerror');
                    exit();
                }else{
                    header('location:../profile.php?error=failedtoupdate');
                    exit();
                }
        }
    }else{
        if($pwd !== $pwdConfirm){
            header('location:..profile.php?error=passworddoesnotmatch');
            exit();
        }else{
            if($fileSize > 0){
                if($fileSize > 5242880){
                    header('location:../profile.php?error=filetoobig');
                    exit();
                }else{

                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

                    $sql = "UPDATE users SET f_name='$f_name',l_name='$l_name',email='$email',username='$username',password='$hashedPwd',photo='$file_new_name' WHERE id='$user';";
                    $result = mysqli_query($db,$sql);
                    if($result){
                        move_uploaded_file($fileTmpName,"../uploads/".$file_new_name);
                        header('location:../profile.php?error=noerror');
                        exit();
                    }else{
                        header('location:../profile.php?error=failedtoupdate');
                        exit();
                    }
                }
            }else{
                $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                
                $sql = "UPDATE users SET f_name='$f_name',l_name='$l_name',email='$email',username='$username',password='$hashedPwd' WHERE id='$user';";
                    $result = mysqli_query($db,$sql);
                    if($result){
                        header('location:../profile.php?error=noerror');
                        exit();
                    }else{
                        header('location:../profile.php?error=failedtoupdate');
                        exit();
                    }
            }
        }
    }
}

function postEmpty($text,$fileName){
    $result;
    if(!empty($fileName) || !empty($text) ){
       $result = false;
    }else{
        $result = true;
    }

    return $result;
}

function createPost($db,$text,$tag){
    session_start();
    $user = $_SESSION['userid'];
    $sql="INSERT INTO posts (username,photo,post,likes,dislikes,image,tag) VALUES (?,?,?,?,?,?,?);";
    $stmt =mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('location:../signup.php?error=stmtfailed');
        exit();
    }

    $sqlRet = "SELECT * FROM users WHERE id='$user'";
    $resRet = mysqli_query($db,$sqlRet);

    if(mysqli_num_rows($resRet) >0 ){

        $resultRet=mysqli_query($db,"SELECT * FROM users WHERE id='$user'");
        while($row=mysqli_fetch_array($resultRet)){
            
            $username = $row['username'];
            $photo = $row['photo'];
            $likes = "0";
            $dislikes = "0";
            $image = "";

            if(empty($tag)){
                $tag = '';
            }

            mysqli_stmt_bind_param($stmt,"sssssss",$username,$photo,$text,$likes,$dislikes,$image,$tag);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header('location:../homePage.php?error=noerror');
            exit();

        }
    }else{
        header('location:../homePage.php?error=cantconnect');
            exit();
    }


}

function editPost($db,$text,$postId){
    $sql = "UPDATE posts SET post='$text' WHERE id='$postId';";
    $res = mysqli_query($db,$sql);

    if($res){
        header('location:../homePage.php?error=noerror');
        exit();
    }else{
        header('location:../editPost.php?error=editfailed');
        exit();
    }
}

function deletePost($db,$postId){
    $sql = "DELETE FROM posts WHERE id='$postId';";
    $res = mysqli_query($db,$sql);

    if($res){
        header('location:../homePage.php?error=postdeleted');
        exit();
    }else{
        header('location:../editPost.php?error=deletefailed');
        exit();
    }
}

function createComment($db,$text){
    session_start();
    $user = $_SESSION['userid'];
    $postId = $_SESSION['postID'];
    $sql="INSERT INTO comments (username,photo,comments,post_id,likes,dislikes) VALUES (?,?,?,?,?,?);";
    $stmt =mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('location:../signup.php?error=stmtfailed');
        exit();
    }

    $sqlRet = "SELECT * FROM users WHERE id='$user'";
    $resRet = mysqli_query($db,$sqlRet);

    if(mysqli_num_rows($resRet) >0 ){

        $resultRet=mysqli_query($db,"SELECT * FROM users WHERE id='$user'");
        while($row=mysqli_fetch_array($resultRet)){
            
            $username = $row['username'];
            $photo = $row['photo'];
            $likes = "0";
            $dislikes = "0";
     

            mysqli_stmt_bind_param($stmt,"ssssss",$username,$photo,$text,$postId,$likes,$dislikes);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            header('location:../comment.php?id='.$postId);
            exit();

        }
    }else{
        header('location:../homePage.php?error=cantconnect');
            exit();
    }


}

function createPost_image($db,$text,$image,$tag){
    session_start();
    $user = $_SESSION['userid'];

    $fileName = $_FILES['fileUpload']['name'];
    $fileTmpName = $_FILES['fileUpload']['tmp_name'];
    $fileSize = $_FILES['fileUpload']['size'];
    $file_new_name = rand().$fileName;

    if($fileSize > 5242880){
        header('location:../homePage.php?error=filetoobig');
        exit();
    }else{

    $sql="INSERT INTO posts (username,photo,post,likes,dislikes,image,tag) VALUES (?,?,?,?,?,?,?);";
    $stmt =mysqli_stmt_init($db);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('location:../homePage.php?error=stmtfailed');
        exit();
    }

    $sqlRet = "SELECT * FROM users WHERE id='$user'";
    $resRet = mysqli_query($db,$sqlRet);

    if(mysqli_num_rows($resRet) >0 ){

        $resultRet=mysqli_query($db,"SELECT * FROM users WHERE id='$user'");
        while($row=mysqli_fetch_array($resultRet)){
            
            $username = $row['username'];
            $photo = $row['photo'];
            $likes = "0";
            $dislikes = "0";
            
            if(empty($tag)){
                $tag = '';
            }
     

            mysqli_stmt_bind_param($stmt,"sssssss",$username,$photo,$text,$likes,$dislikes,$file_new_name,$tag);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            move_uploaded_file($fileTmpName,"../uploads/".$file_new_name);
            header('location:../homePage.php?error=noerror');
            exit();
            }
        }else{
            header('location:../homePage.php?error=cantconnect');
                exit();
        }
    }
}

function editPost_image($db,$text,$image){
    $user = $_SESSION['userid'];
    $postId = $_SESSION['postID'];

    $fileName = $_FILES['fileUpload']['name'];
    $fileTmpName = $_FILES['fileUpload']['tmp_name'];
    $fileSize = $_FILES['fileUpload']['size'];
    $file_new_name = rand().$fileName;

    if($fileSize > 5242880){
        header('location:../homePage.php?error=filetoobig');
        exit();
    }else{
        $sql = "UPDATE posts SET post='$text', image='$file_new_name' WHERE id='$postId';";
        $res = mysqli_query($db,$sql);

        if($res){
            move_uploaded_file($fileTmpName,"../uploads/".$file_new_name);
            header('location:../homePage.php?error=noerror');
            exit();
        }else{
            header('location:../editPost.php?id='.$postId.'?error=editfailed');
            exit();
        }
        
    }
}

function editpostEmpty($text){
    $result;
    if(!empty($text)){
        $result = false;
    }else{
        $result= true;
    }
    return $result;
}