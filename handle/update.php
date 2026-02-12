<?php 

//connect 
require_once '../inc/conn.php'; // seesion 
//check  => laravel => csrf
if(isset($_POST['submit']) && isset($_GET['id'])){// form => submit 
    $id = $_GET['id'];
    // select one 
    $query = "select * from posts where id = $id";
    $result=  mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1 ){
        //old image ???
        $post= mysqli_fetch_assoc($result);
        $old_image = $post['image'];
        //catch 
        trim(htmlspecialchars(extract($_POST)));

        //valid
        //errors 
        $errors = [];
        if(empty($title)){
            $errors[] = "title is required";
        }elseif(is_numeric($title)){
            $errors[]= "title must be string";
        }

        //body 
        if(empty($body)){
            $errors[] = "body is required";
        }elseif(is_numeric($body)){
            $errors[]= "body must be string";
        }
        if(!empty($_FILES['image']['name'])){
            //file => image  => sent or not 
            // var_dump($_FILES['image']);
            $image = $_FILES['image'];
            $image_name = $image['name'];
            $tmp_name= $image['tmp_name'];

            $image_error = $image['error'];
            $size = $image['size']/(1024*1024); // mb
            $image_ext = strtolower(pathinfo($image_name,PATHINFO_EXTENSION)); //PNG , png  xxxxxxxxx  png , jpg , jpeg
            // valid image 
            $ext = ["png","jpeg","jpg"];
            if($image_error != 0 ){
                $errors[]= "image not correct";
            }elseif($size > 1){
                $errors[]= "image size must be less than 1 mb";
            }elseif(!in_array($image_ext,$ext)){
                $errors[]= "image type must be in (jpg , png , jpeg)";
            }
            // errors or not
            $new_name = uniqid().".$image_ext";
            //445sdh454.png
        }else{
            $new_name = $old_image;
        }

        if(empty($errors)){
            // insert 
            $query = "update posts set title='$title',body = '$body',image='$new_name' where id = $id";
            $result= mysqli_query($conn,$query);
            if($result){
                if(!empty($_FILES['image']['name'])){
                    // remove 
                    unlink("../uploads/$old_image"); // remove ???????
                    // move file => image 
                    move_uploaded_file($tmp_name,"../uploads/$new_name"); // move
                }
                // success 
                $_SESSION['success'] = "post updated success";
                header("location:../viewPost.php?id=$id");
            }else{
                $_SESSION['errors'] = ["error while update post"];
                header("location:../editPost.php?id=$id");
            }
        }else{
            $_SESSION['title']= $title;
            $_SESSION['body']= $body;

            $_SESSION['errors'] = $errors;
            header("location:../editPost.php?id=$id");
        }



    }else{
        header("location:../errors/404.php");

    }


} else{
    header("location:../errors/404.php");
}