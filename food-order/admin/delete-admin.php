<?php

    //include contant.php here
    include('../config/constant.php');

    //1. to get the id of admin to be deleted

   echo $id= $_GET['id'];

    //2. create sql query to delete admin
    $sql="DELETE FROM tbl_admin WHERE id=$id";

    //execute the query
    $res = mysqli_query($conn,$sql);

    //check whether the execute or not
    if($res==TRUE){
        // echo"admin deleted";
        //crate session var to display mass
        $_SESSION['delete']="<div class='success'>Admin deleted Suceesfully</div>";
        //redirect to header 
        header('location:'.SITEURL.'admin/manage-admin.php');

    }else{
        // echo"not deleted";
        $_SESSION['delete'] = "<div class='error'>failed to delet admin,try again</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');


    }

    //3. redirect to manage admin page succes or error


?>