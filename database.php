<?php

    // database login details
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "youcodescrumboard";

    //CONNECT TO DATABASE
    $connect = mysqli_connect($host, $user, $password, $database);

    // Check connection
    if($connect === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    // Print host information
    // echo "Connect Successfully. Host info: " . mysqli_get_host_info($connect);
?>


