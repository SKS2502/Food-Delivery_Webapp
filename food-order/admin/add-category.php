<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <br>
        <h1>Add category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>
<br><br>

    <!-- add category form starts -->
    <form action="" method="POST" enctype="multipart/form-data"> 
<!-- enctype="multipart/form-data this property allow to upload file or image -->

    <table class="tbl-30">
        <tr>
            <td>Title: </td>
            <td>
                <input type="text" name="title" placeholder="category title">
            </td>
        </tr>

        <tr>
            <td>Select image</td>
            <td>
                <input type="file" name ="image">
            </td>
        </tr>


    <tr>
        <td>Featured: </td>
        <td>
            <!-- here value yes stored in db and outside input show in brower -->
            <input type="radio" name="featured" value="Yes">Yes
            <input type="radio" name="featured" value="No">No
        </td>
    </tr>

    <tr>
        <td>Active:</td>
        <td>
            <input type="radio" name="active" value="Yes">Yes
            <input type="radio" name="active" value="No">No
        </td>
    </tr>

    <tr>
        <td colspan="2">
        <input type="submit" name="submit" value="Add category" class="btn-secondary">
        </td>
    </tr>

    </table>
    </form>
    <!-- add category form end -->

    <?php
    
    //check whether the button is clicked or not
    if(isset($_POST['submit']))
    {
        // echo "cleicked";
        //to get the value from category form
        $title=$_POST['title'];

        //for radio input type whether the button is selected or not
        if(isset($_POST['featured']))
        {
            // if selescted we get the value
            $featured=$_POST['featured'];

        } else{
            $featured="No";

        }

        if(isset($_POST['active']))
        {
            $active=$_POST['active'];
        }
        else{
            $active="No";
        }

        //check wheteher the image is selected or not
        // print_r($_FILES['image']);
// echo doesnot display the array value and FILES is an array
        // die();
        if(isset($_FILES['image']['name']))
        {
            //upload the image
            // to upload image we need image name and source path and des path
            $image_name=$_FILES['image']['name'];

            //renaiming the image
            //get the extension of our image jpg,png,gif,etc
            $ext = end(explode('.',$image_name));

            //rename the image
            $image_name="Food_Category_".rand(000,999).'.'.$ext;

            $source_path =$_FILES['image']['tmp_name'];

            $destination_path="../images/category/".$image_name;
            // upload the image
            $upload = move_uploaded_file($source_path,$destination_path);

            // check image is uploaded or not
            //if not then we will stop the process redirect with error message
            if($upload==FALSE){
                //set message
                $_SESSION['upload'] ="<div class='error'>failed to uplaod image</div>";
                header('location:'.SITEURL.'admin/add-category.php');
                //stope the process
                die();
            }

        }
        
        else{
            //dont upload image and set the image name value blank
            $image_name="";
        }


        //2. queery to insert category into db
        $sql="INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

        // execute the query and save into db
        $res = mysqli_query($conn,$sql);

        // check wheter query executed or not data added or not
        if($res==TRUE){
            //query executed and category added
            $_SESSION['add'] = "<div class ='success'>Category added successfully</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else{
            $_SESSION['add'] = "<div class ='error'>failed to add</div>";
            header('location:'.SITEURL.'admin/add-category.php');
        }

    }
    ?>

<br><br>

    </div>
</div>





















<?php include('partials/footer.php')?>