<?php
    $servername = "database-1.cylaelg1aaut.us-east-1.rds.amazonaws.com";
    $username = "admin";
    $password = "#dccQPY8hv6y!hYG";
    $database = "mydb";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>