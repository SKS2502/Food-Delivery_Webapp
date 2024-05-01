<?php 
// check wether the the user is logged in or not
if (!isset($_SESSION['user'])) // if user session is not set         
{
    // User is not logged in
    // redirect to login page with message
    $_SESSION['no-login-message'] = "<div class='error text-center>Please login to access Admin panel.</div>";
    // redirect to login page 
    header('Location:'.SITEURL.'/admin/login.php'); 
}
?>