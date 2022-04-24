<?php
    //session_start();
    $serverName = "localhost";
    $username = "gd-ticketing";
    $password = "gd-ticketing-123";
    $dbName = "gd_ticketing_db";
    
    // Create connection
    $conn = new mysqli($serverName, $username, $password, $dbName);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
?>