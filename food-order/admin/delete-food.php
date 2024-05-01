<?php 
// include constants page 
include('../config/constant.php');

// echo "Delete food page"
if (isset($_GET['id']) && isset($_GET['image_name'])) //either you can use AND or && 
{
    // process to delete 
    // echo"Process to delete";
    //1.  get ID and Image Name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //2. Remove the Image if available
    // check weather the image is available or not and delete only if available
    if ($image_name!= "") {
        // it has image and need to remove from folder 
        // get the image path 
        $path = "../images/food/".$image_name;
        // remove image file from folder
        $remove = unlink($path);
        // check weather the image is removed or not
        if ($remove==false) {
            //failed to remove image  
            $_SESSION['upload'] = "<div class = 'error'> Failed to remove image file.</div>";
            // Redirect to manage food
            header('Location:'.SITEURL.'admin/manage-food.php');
            // stop the process of deleting food  
            die();
        }

    }

    //3. delete food from database
    $sql  = "DELETE FROM tbl_food WHERE id =$id";
    // execute the Query
    $res = mysqli_query($conn, $sql);
    
    // check weather the query executed or not and set the session message respectively
    //4. REdirect to manage food with session message
    if ($res==true) {
        // food delete
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successful </div>";
        header('Location:'.SITEURL.'admin/manage-food.php');
    }
    else {
        // failed to delete food        
        $_SESSION['delete'] = "<div class='Error'>Failed to delete food.</div>"; 
        header('Location:'.SITEURL.'admin/manage-food.php'); 
    }

}
else {
    // Redirect to manage food page
    // echo"Redirect";
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized access.</div>";
    header('Location:'.SITE_URL.'admin/manage-food.php');
}

?>