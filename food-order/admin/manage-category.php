<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage categroy</h1> 

        <br />
    <br />
    <?php
        if(isset($_SESSION['add'])){
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }




        ?>
        <br><br>
    <!-- button to add admin -->
    <a href ="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add category</a>

    <br />
    <br />
    <br />

    <table class="tbl-full">
    <tr>
        <th>S.no</th>
        <th>Title</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
    </tr>

        <?php
        
        //query to get all data from db
        $sql="SELECT * FROM tbl_category";

        //execute query
        $res=mysqli_query($conn,$sql);

        //count rows
        $count = mysqli_num_rows($res);

        //create serial number variable
        $sn=1;

        //check whetehr we have data in databse or not
        if($count>0)
        {
            //we have data
            // to get the data and display
            while($row=mysqli_fetch_assoc($res))
            {
                $id=$row['id'];
                $title=$row['title'];
                $image_name=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];

                ?>
            <tr>
            <td><?php echo $sn++; ?>.</td>
            <td><?php  echo $title;?></td>

            <td>
            <?php 
            // check whethrr imange name is avilable or nor
            if($image_name!="")
            {
                //display image
                ?>
                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" width="200px">
                <?php

            }
            else{
                //display the message
                echo "<div class='error'>Image not added</div>";
            }
            
            ?>
            </td>


            <td><?php echo $featured; ?></td>
            <td><?php echo $active; ?></td>
        <!-- <td></td> -->
            <td>
            <!-- <a href="#" class="btn-secondary">Update Category</a> -->
            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name;?>" class="btn-danger">delete Category</a>
            </td>
            </tr>



                <?php
            }

        }
        else{
            //we don have data
            // we will display the message inside the table

                // breaking the php for writing html
        ?>

        <tr>
            <td colspan="6"><div class="error">No category added</div></td>
        </tr>

        <?php
        }


    ?>

<!--     <tr>
        <td>1. </td>
        <td>sachin</td>
        <td>sks2502</td>
        <td></td>
        <td></td>
        <td>
            <a href="#" class="btn-secondary">Update Category</a>
            <a href="#" class="btn-danger">delete Category</a>
        </td> -->
    <!-- </tr> -->


</table>
    </div>
</div>


<?php include('partials/footer.php'); ?>
