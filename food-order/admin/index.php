<?php include('partials/menu.php') ?>

<!-- Menu section end -->

<!-- main content section start -->

<div class="main-content">
    <div class="wrapper">

    <?php 
                if (isset($_SESSION['login'])) 
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if (isset($_SESSION['no-login-message'])) {
                    echo  $_SESSION['no-login-message'];
                    unset( $_SESSION['no-login-message']);
                }
        ?>


    <h1>DASHBOARD</h1>

    <div class="col-4 text-center">
        
        <?php
        // sql query 
        $sql="SELECT * FROM tbl_category";

        //execute query
        $res= mysqli_query($conn,$sql);

        //count th erows
        $count = mysqli_num_rows($res);
        
        ?>
        <h1><?php echo $count; ?></h1>
        <br />
        Categories
    </div>

    <div class="col-4 text-center">

    <?php
        // sql query 
        $sql2="SELECT * FROM tbl_food";

        //execute query
        $res2= mysqli_query($conn,$sql2);

        //count th erows
        $count2 = mysqli_num_rows($res2);
        
        ?>

        <h1><?php echo $count2; ?></h1>


        


        <br /> 
        Foods
    </div>    
    <div class="col-4 text-center">

    <?php
        // sql query 
        $sql3="SELECT * FROM tbl_order";

        //execute query
        $res3= mysqli_query($conn,$sql3);

        //count th erows
        $count3 = mysqli_num_rows($res3);
        
        ?>

        <h1><?php echo $count3?></h1>
        <br />
        Total Orders
    </div>    
    <div class="col-4 text-center">

    <?php
    
    //crete sql query to get total revenue generator
    // aggregate function in sql
    $sql4="SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

    //execute the query
    $res4 = mysqli_query($conn, $sql4);
    
    //get teh value
    $row4 = mysqli_fetch_assoc($res4);

    // get the Total revenue
    $total_revenue = $row4['Total'];
    
    
    ?>


        <h1>Rs.<?php echo $total_revenue; ?></h1>
        <br />
        Revenue Generated
    </div>
    <div class="clearfix"></div>
    </div>
</div>

<!-- main content section start -->

<!-- footer section starts -->
<?php include('partials/footer.php') ?>


    </body>
</html>
