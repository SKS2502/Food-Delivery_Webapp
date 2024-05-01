<?php include('partials/menu.php')?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />

        <?php
            if(isset($_SESSION['add'])) // checking whether session is set or not
            {
                echo $_SESSION['add']; // display session mess
                unset($_SESSION['add']); //remove session message
            }
        ?> 

    <form action="" method="POST">

    <table class="tbl-30">
    <tr>
        <td>Full name: </td>
        <td><input type="text" name="full_name" placeholder="enter your name"></td>
    </tr>

    <tr>
        <td>Username: </td>
        <td>
        <input type="text" name="username" placeholder="your username"></td>
    </tr>

    <tr>
        <td>Password: </td>
        <td>
        <input type="password" name="password" placeholder="your password"></td>
    </tr>

    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
        </td>
    </tr>

</table>



    </form>

    </div>
</div>



<?php include('partials/footer.php')?>


<?php
// process the value from Form and save it to database
//check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    // button clicked 
    // echo "button clicked";
    //get the data from form
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   $password=md5($_POST['password']); //pass encrypoted wuth md5

    //sql query to save the data into db

    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";

    // execute query and save data in data db
    // $res=mysqli_query($conn, $sql) or die(mysqli_error());
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));


    //check data is inserted or not
    if($res==TRUE){

        //data insterted
        //echo"data inserted";
        //crete a seesion to display
        $_SESSION['add'] ="Admin added susccesfully";
        //redriect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');

    }
    else{

        //data not inserted
        //echo"data is not inserted";
        //crete a seesion to display
        $_SESSION['add'] ="Admin added Failed";
        //redriect page to manage admin
        header("location:".SITEURL.'admin/add-admin.php');

    }

}
?>


