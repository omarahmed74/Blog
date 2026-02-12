<?php

// connect
require_once '../inc/conn.php';

// check from 
if(isset($_POST['submit'])){
// catch
trim(htmlspecialchars(extract($_POST)));

//validiation
$errors=[];
if(empty($title)){
    $errors[]= "title is requried";
}elseif(is_numeric($title)){
    $errors[]= "title must be string";
}

if(empty($body)){
    $errors[]= "body is requried";
}elseif(is_numeric($body)){
    $errors[]= "body must be string";
}

//send or not
$image = $_FILES['image'];
$image_name = $image['name'];
$temp_name = $image['tmp_name'];
$size = $image['size']/(1024*1024);
$image_error = $image['error'];
//ext
$image_ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION));
// image valid
$ext = ["png" , "jpeg" , "jpg"];
if($image_error != 0 ){
        $errors[]= "image not founded";
    }elseif($size > 1){
        $errors[]= "image size must be less than 1 mb";
    }elseif(!in_array($image_ext,$ext)){
        $errors[]= "image type must be in (jpg , png , jpeg)";
    }
    // errors or not
    $new_name = uniqid().".$image_ext";
    //445sdh454.png
    if(empty($errors)){
        // insert 
        $query = "insert into posts (`title`,`body`,`image`,`user_id`) values ('$title','$body','$new_name',1)";
        $result= mysqli_query($conn,$query);
        if($result){
            // move file => image 
            move_uploaded_file($temp_name,"../uploads/$new_name"); // move  
            
            // success 
            $_SESSION['success'] = "post added success";
            header("location:../index.php");
        }else{
            $_SESSION['errors'] = ["error while add post"];
            header("location:../addPost.php");
        }
    }else{
        $_SESSION['title']= $title;
        $_SESSION['body']= $body;

        $_SESSION['errors'] = $errors;
        header("location:../addPost.php");
    }
//errors
}
else{
    header("location:../errors/404.php");
}