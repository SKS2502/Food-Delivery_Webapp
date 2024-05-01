<?php 
    // include constants.php for SITEURL
    include('../config/constant.php');

    // destroy the session 
    session_destroy();


    // redirect to the login page 
    header('Location:'.SITEURL.'admin/login.php');
?>