
<?php include('partials-front/menu.php');?>
    <!-- Navbar Section Ends Here -->



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            
        <?php
        // display all the category which are active
        //sql query
        $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //counrt the rows
        $count = mysqli_num_rows($res);

        //chehck wheteher category is avialabe or not
        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                //get the value
                $id=$row['id'];
                $title=$row['title'];
                $image_name=$row['image_name'];

                ?>


            <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id?>">
                <div class="box-3 float-container">

                <?php
                if($image_name=="")
                {
                    //iamge is not avilabe
                    echo "<div class='error'>iamge is not found</div>";

                }else{
                    // image avilabe
                    ?>
                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">

                    <?php

                }
                ?>


                    <h3 class="float-text text-white"><?php echo $title; ?></h3>
                </div>
            </a>


                <?php

            }
        }
        else{

            echo "<div class='error'>Categroy is not avilabe</div>";
        }
        
        ?>





            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <?php include('partials-front/footer.php');?>