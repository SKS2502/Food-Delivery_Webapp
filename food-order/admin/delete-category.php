<?php
//include constant files
// include('../config/constant.php');
include('../config/constant.php');



// check whether the id and image_name value is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
// get the vaue amd delete
$id=$_GET['id'];
$image_name=$_GET['image_name'];

// remove physical image file is avialbe
if($image_name!="")
{
    //iamge is avlible so remove it
    $path="../images/category/".$image_name;

    //remove the image
    $remove= unlink($path);

        // if failes to remove then add error mess and stop process
    if($remove==FALSE)
    {
        // set the session messse
        $_SESSION['remove']="<div class='error'>failed to remove category image</div>";
        //redirect to manage category page
        header('location:'.SITEURL.'admin/manage-category.php');
        //stop the process
        die();
    }

}


//delete data from db
//sql query for delete data from db
$sql= "DELETE FROM tbl_category WHERE id=$id";

//execute the query
// $res = mysqli_query($conn, $sql);
$res = mysqli_query($conn,$sql);


//check the whether the data is delete from db
if($res==TRUE)
{
    // set sucees message
    $_SESSION['delete'] = "<div class='success'>category deleted successfully</div>";

    //redirect tomanage category
    header('location:'.SITEURL.'admin/manage-category.php');
}
else{
        // set sucees message
        $_SESSION['delete'] = "<div class='error'>category deleted failed</div>";

        //redirect tomanage category
        header('location:'.SITEURL.'admin/manage-category.php');

}

//redirect to manage category page



}
else{
// redirect to manage category page
header('location'.SITEURL.'admin/manage-category.php');

}

?>