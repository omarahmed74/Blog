<?php


require_once "../inc/conn.php";

if(isset($_POST['submit'])){
    // catch 
    
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(($_POST['password']));
    // password => hash valid.
    // hash??
    //validation ??
    $errors=[];
 
    if(empty($email)){
    $errors[]= "<div class='error-msg'>email is requried</div>";
    }elseif(! filter_var($email , FILTER_VALIDATE_EMAIL)){
    $errors[]= "<div class='error-msg'>email must has @</div>";
    }

    if(empty($password)){
    $errors[]= "<div class='error-msg'>password is requried</div>";
    }elseif(strlen($password ) < 6){
    $errors[]= "<div class='error-msg'>password must be more than 6 char</div>";
    }

    // now the hash
    // uifhjbdfjhbdfhjib48949 => 123456789
    
    if(empty($errors)){
        $query = "select * from users where email = '$email'";
        $result = mysqli_query($conn , $query);
        if(mysqli_num_rows($result) == 1){
        // old password => hashed
        $user = mysqli_fetch_assoc($result);
        $old_password = $user['password'];
        // verfiy to remove the hashed in interface dsjvfjkfjblk=123
        $is_verify = password_verify($password,$old_password);
        // is verfied or not ????
        if($is_verify){ 
        $_SESSION['user_id'] = $user['id'];    
        $_SESSION['success'] = "<div class='error-msg' style='background:#e6ffe6;color:#009900;border-color:green;'>Loginout success</div>";
        header("location:../index.php");
        }else{
        $_SESSION['errors'] = ["email or password not correct (2)"];
        header("location:../Login.php");
        }

    }else {
        $_SESSION['errors'] = ["email or password not correct (1)"];
        header("location:../Login.php");
    }
    }else{
     $_SESSION['email'] = $email;
     $_SESSION['errors'] = $errors;
     header("location:../Login.php");
    }
}else{
    header("location:../errors/404.php");
}
