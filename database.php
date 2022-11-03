<?php

    // database login details
    require 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $host = $_ENV['DB_HOST'];
    $user = $_ENV['DB_USER'];
    $password = $_ENV['DB_PASSWORD'];
    $database = $_ENV['DB_DATABASE'];
    global $connect;
    //CONNECT TO DATABASE
    $connect = mysqli_connect($host, $user, $password, $database);

    // Check connection
    if(!$connect){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
    // Print host information
    // echo "Connect Successfully. Host info: " . mysqli_get_host_info($connect);
?>


