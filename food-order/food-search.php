<?php include('partials-front/menu.php');?>
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            
            // get the search keyword
            $search=$_POST['search'];

            ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php


            //crete sql wuwrry for food based on search keyword
            $sql="SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";
            
            //exceute the query
            $res = mysqli_query($conn,$sql);

            //count rows
            $count = mysqli_num_rows($res);

            //chech wther food is avilabe or not
            if($count>=0)
            {
                // food avilabe
                while($row= mysqli_fetch_assoc($res))
                {
                    // get tghe details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    ?>

            <div class="food-menu-box">
                <div class="food-menu-img">

                    <?php
                    if($image_name=="")
                    {
                        echo "<div class='error'>image is not avilabve</div>";
                    }
                    else{
                        ?>
                    <img src="<?php echo SITEURL?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                        <?php

                    }
                    
                    ?>


                    <img src="images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title;?></h4>
                    <p class="food-price"><?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?>
                    </p>
                    <br>

                    <a href="#" class="btn btn-primary">Order Now</a>
                </div>
            </div>

                    <?php
                }
            }
            else{
                // food not avilabe
                echo "<div class='error'>food not avilale</div>";
            }
            ?>



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php');?>
