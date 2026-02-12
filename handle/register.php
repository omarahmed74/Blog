<?php


require_once "../inc/conn.php";

if(isset($_POST['submit'])){
    // catch 
    $name = trim(htmlspecialchars($_POST['name']));
    $email = trim(htmlspecialchars($_POST['email']));
    $password = trim(htmlspecialchars($_POST['password']));
    $phone = trim(htmlspecialchars($_POST['phone']));

    // password => hash valid.
    // hash??
    //validation ??
    $errors=[];
    if(empty($name)){
    $errors[]= "<div class='error-msg'>name is requried</div>";
    }elseif(is_numeric($name)){
    $errors[]= "<div class='error-msg'>name must be string</div>";
    }

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

    if(empty($phone)){
    $errors[]= "<div class='error-msg'>phone is requried</div>";
    }elseif(! is_numeric($phone)){
    $errors[]= "<div class='error-msg'>phone must be a number</div>";
    }
    
    // now the hash
    $password = password_hash($password , PASSWORD_DEFAULT);
    if(empty($errors)){
    // insert
    $query = "insert into users (`name`,`email` , `password` , `phone`) values ('$name' , '$email' , '$password' , '$phone')";
    $result = mysqli_query($conn , $query);
    if($result){
        $_SESSION['success'] = "User register success";
        header("location:../Login.php");
    }else {
        $_SESSION['errors'] = ["errors while register"];
        header("location:../register.php");
    }
    }else{
     $_SESSION['name'] = $name;
     $_SESSION['email'] = $email;
     $_SESSION['phone'] = $phone;
     $_SESSION['errors'] = $errors;
     header("location:../register.php");
    }
}else{
    header("location:../errors/404.php");
}