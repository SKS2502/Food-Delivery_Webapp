<?php

    //start session
    session_start();



    // create constant for non repeating values

    //execute query and save data in data db 
    //database connection
    //constant is named in capital letter and variable in small
    define('SITEURL','http://localhost/food-order/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');

    $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
    //selecting db
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //selecting db       

    


?>