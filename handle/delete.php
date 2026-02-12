<?php 

require_once '../inc/conn.php';

if(isset($_POST['submit']) && isset($_GET['id'])){
    // select one 
    $id= $_GET['id'];
    //select one 
    $query = "select * from posts where id = $id";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) == 1){
    // old image 
    //fetch 
    $post = mysqli_fetch_assoc($result);
    $old_image= $post['image'];
    //delete 
    $query= "delete from posts where id = $id";
    $result= mysqli_query($conn,$query);
    if($result){
    //remove image unlink 
    if(!empty($old_image)){
        unlink("../uploads/$old_image");
    }
        // success 
    $_SESSION['success'] = "post deleted success";
    header("location:../index.php");

    }else{
            $_SESSION['errors'] = ["error while delete  post"];
            header("location:../index.php");
    }

    }else{
            header("location:../errors/404.php");
    }

}else{
        header("location:../errors/404.php");
}