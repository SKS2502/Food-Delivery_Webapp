<?php include('partials/menu.php')?>


<!-- main content section start -->

<div class="main-content">
    <div class="wrapper">
    <h1>Manage Admin</h1>
    <br />


    <?php
    if(isset($_SESSION['add']))
    {
        echo $_SESSION['add']; // displaying the session
        unset($_SESSION['add']); // removinf the session
    }

    if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }

    ?>
    <br /><br />
    <!-- button to add admin -->
    <a href ="add-admin.php" class="btn-primary">Add admin</a>

    <br />
    <br />
    <br />

    <table class="tbl-full">
    <tr>
        <th>S.no</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
    </tr>

    <?php  // query to get all admin
        $sql = "SELECT*FROM tbl_admin";
        // excute the query
        $res= mysqli_query($conn, $sql);

        // check the query is executed or not
        if($res==TRUE){
            //count rows to check wheteer we have data in database
            $count= mysqli_num_rows($res); // function to get all the rows in db

            $sn=1; // create a var and assign tghe value

            //check th enum of eows
            if($count>0){
                //we have data in db
                while($rows=mysqli_fetch_assoc($res))
                {
                    //using while loop to get all the data gfrpom db
                    // while will execute as long as we have data in db
                    // fet individual data
                    $id=$rows['id'];
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];

                    //display the value in table
                    ?> 
                    

                    <tr>
                    <td><?php echo $sn++;?> </td>
                    <td><?php echo $full_name;?></td>
                    <td><?php echo $username;?></td>

                    <td>
            <!-- <a href="#" class="btn-secondary">Update Admin</a> -->
            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="btn-danger">delete Admin</a>
        </td>
    </tr>





                    <?php
                }
            }
            else{
                //we dont have
            }
        }

    ?>


</table>



    </div>
</div>

<!-- main content section start -->

<!-- footer section starts -->
<?php include('partials/footer.php')?>
<!-- footer section ends -->



    </body>
</html>
