<?php  include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <br><br>

        <?php 
        if (isset($_SESSION['upload'])) 
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']); 
        }
        
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="10" placeholder="description of the food"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                            
                            // create PHP code to display categories from database
                            // 1. create sql to get all active categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active = 'Yes'";
                            // executing query
                            $res = mysqli_query($conn, $sql);
                            // count rows to check weather we have categories or not
                            $count = mysqli_num_rows($res);
                            // IF count is greater than zero, we have categories else we don't have categories
                            if ($count>0) {
                                    // we have categories
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        // get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"> <?php echo $title; ?></option>

                                        <?php
                                    }
                            }
                            else {
                                // we don't have categories
                                ?>
                                 <option value="0">no categories found</option>
                                <?php
                            }
                            
                            ?>
                           
                        </select>
                    </td>
                </tr>
                <tr> 
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No       
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No       
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
        // check weather the button is clicked or not
        if (isset($_POST['submit'])) {
            // add the food in database
            // echo "Clicked";
            // 1.get the data from Form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // check weather radion for featured and active are checked or not
            if (isset($_POST['featured'])) {
                $featured = $_POST['featured'];
            }
            else{
                $featured = 'No';// setting the default value
            }
            if (isset($_POST['active'])) {
                $active = $_POST['active'];
            }
            else {
                $active = "No"; //setting default value
            }
            // 2.upload the image if selected
            // checked weather the selected image is clicked or not and upload the image only if the image is selected
            if (isset($_FILES['image']['name'])) {
            // Get the details of the selected image 
            $image_name = $_FILES['image']['name'];
                // check weather the image is selected or not and upload the image only if selected
                if ($image_name!="") {
                    //image is selected
                    // 1. rename the image
                    // get the extension of the selected image(jpg, png, gif, etc...)
                    $ext = end(explode('.',$image_name));
                    // create New Name for Image
                    $image_name = "Food-Name-".rand(0000,9999).'.'.$ext;//new Image name may be "Food_Name-435.jpg"                    
                    // 2. upload the image
                    // get the src path and destination path

                    // src path is the current location of the image 
                    $src = $_FILES['image']['tmp_name'];

                    // destination path for the image to be uploaded
                    $dst = "../images/food/".$image_name; // Image of the Food 

                    // Finally Uploaded the Food image
                    $upload = move_uploaded_file($src, $dst);

                    // check weather image uploaded or not
                    if ($upload == false) {
                        // failed to upload the image
                        // redirect to add food page with error message
                        $_SESSION['upload'] = "<div class = 'error'>Failed to upload the image</div>"; 
                        header('location:'.SITEURL.'admin/add-food.php');
                        // stop the process
                        die();
                    }
                }

            }           
            else {
                $image_name = ""; //setting default value as blank 
            }
            // 3.Insert into database
            // create a SQL query to save or add food
            
            $sql2 = "INSERT INTO tbl_food SET
              title = '$title',
              description = '$description',
              price = $price,
              image_name = '$image_name',
              category_id = $category,
              featured = '$featured',
              active = '$active'
            ";
            // execute the Query  
            $res2 = mysqli_query($conn, $sql2);
            // check weather the data is inserted or not 
            // 4.redirect the message to manage food page
            if ($res2 == true) {
                // Data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else {
                // failed to insert data successfully
                $_SESSION['add'] = "<div class='error'>Failed to add food</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
            }

        }
        
        ?>



    </div>
</div>


<?php  include('partials/footer.php');?>