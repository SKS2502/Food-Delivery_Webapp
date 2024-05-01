<?php include('partials-front/menu.php');?>

    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php

    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }

    ?>
 
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
            // crete sql auery to disaplay category from db
            $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
            //execute the query
            $res= mysqli_query($conn,$sql);

            // count the rows whether category avialbe or not
            $count= mysqli_num_rows($res);

            if($count>0)
            {
                //catefory available
                while($row= mysqli_fetch_assoc($res))
                {
                    //get the value like id title and image name
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];

                    ?>

                <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id?>">
                    <div class="box-3 float-container">

                    <?php
                    // check whether image is availabe or not
                    if($image_name=="")
                    {
                        echo "<div class='error'>Image is not avilable</div>";
                    }
                    else{
                        //iamge is avialbe
                        ?>

                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">


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
                //not avilabele
                echo "<div class='error'>Category not added</div>";
            }


            
            ?>



            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
            //getting food from db that are active and feature
            //sql query
            $sql2="SELECT * FROM tbl_food   WHERE active ='Yes' AND featured='Yes' LIMIT 6";
      
            //EXECUTE TH EQUERY
            $res2 = mysqli_query($conn, $sql2);

            //coubnt rows
            $count2 = mysqli_num_rows($res2);

            //chech wheter food avilabe or not
            if($count2>0)
            {
                //food avialbe
                while($row= mysqli_fetch_assoc($res2))
                {
                    //get all the va;ues
                    $id=$row['id'];
                    $title=$row['title'];
                    $price=$row['price'];
                    $description=$row['description'];
                    $image_name=$row['image_name'];

                    ?>

                <div class="food-menu-box">
                <div class="food-menu-img"> 

                    <?php
                    //check whether image avilabe or not
                    if($image_name=="")
                    {
                        // image not avilabe
                        echo "<div class='error'>image is not avilabe</div>";
                    }
                    else{
                        //image avilabe
                        ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                        <?php
                    }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title; ?></h4>
                    <p class="food-price"><?php echo $price; ?></p>
                    <p class="food-detail">
                    <?php echo $description; ?>
                    </p>
                    <br>

                    <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                    <?php
                }

            }
            else{

                // food not avilabe
                echo "<div class='error'> food not avilable</div>";
            }

            ?>





            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php')?>


<!-- https://github.com/SKS2502/prototype.git -->