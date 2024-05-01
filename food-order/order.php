<?php 
include('partials-front/menu.php');?>


    <?php
    
    //chehck food id is set or not
    if(isset($_GET['food_id']))
    {

        // get the food id and detials of selected foood
        $food_id = $_GET['food_id']; 

        //get the detials of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //count the rows
        $count= mysqli_num_rows($res);

        //chehck whether the data is avilabe or not
        if($count==1)
        {
            //we have data
            //get the data from db
            $row = mysqli_fetch_assoc($res);
            $title=$row['title'];
            $price=$row['price'];
            // $description=$row['description'];
            $image_name=$row['image_name'];

            //display the data


        }
        else{
            //we dont have data food
            header('location:'.SITEURL);

        }
    }
    else{
        //redirect to homepage
        header('location:'.SITEURL);
    }
    ?>


    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">

                    <?php
                    
                    //check image is avilabe or not
                    if($image_name=="")
                    {
                        //image is not avilabe
                        echo "<div class='error'>Image is not avilabe</div>";
                    }
                    else{
                        // inmage is avilable
                        ?>

                        <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">


                        <?php

                    }
                    
                    ?>

                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        
                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">



                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full_name" placeholder="E.g. Sachin Singh" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. writemail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </foprice
            <?php
            
            //check submit button is clicked or not
            if(isset($_POST['submit']))
            {
                // get all the details from the form

                $food =$_POST['food'];
                $price =$_POST['price'];
                $qty =$_POST['qty'];
                $total =$price * $qty;
                
                $order_date= date("Y-m-d h:i:sa");

                $status="ordered"; // oerdered, on delelvery, deleverd,cancel

                $customer_name=$_POST['full_name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];

                //save th ordeer in db
                //creste sql to save the data in db
                $sql2 ="INSERT INTO tbl_order SET
                food='$food',
                price=$price,
                qty=$qty,
                total=$total,
                order_date='$order_date',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address'
                
                ";

                // echo $sql2; die();
                
                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //chehck whether query executed ot not
                if($res2==true)
                {
                    //query executed and order saved
                    $_SESSION['order'] = "<div class= 'success text-center'> food order sucessfully</div>";
                    header('location:'.SITEURL);

                }else{

                    //failed to save order
                    $_SESSION['order'] = "<div class= 'error text center'> failed to food order</div>";
                    header('location:'.SITEURL);


                }

                
            }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <?php include('partials-front/footer.php');?>