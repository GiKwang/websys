<?php

session_start();

// Create database connection
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Get the user email from session
$userEmail = $_SESSION['email'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if order ID is null for any cart
$sql = "SELECT * FROM cart WHERE email = '$userEmail' AND order_id IS NULL";
$result = $conn->query($sql);

// If order ID is null, set all order ID to be the same
if ($result->num_rows > 0) {
    $order_id = "ORDER" . time() . mt_rand(100000, 999999);
    $sql = "UPDATE cart SET order_id = '$order_id' WHERE email = '$userEmail' AND order_id IS NULL";
    if ($conn->query($sql) === TRUE) {
        // Update cart table
        echo "Order IDs updated successfully";
        
        // Insert data into trackorder table
        $sql = "INSERT INTO trackorder (order_id, fname, lname, city, email, deliveryaddress)
                SELECT order_id, fname, lname, city, email, homeaddress FROM cart WHERE email = '$userEmail' AND order_id = '$order_id'
                ON DUPLICATE KEY UPDATE fname = VALUES(fname), lname = VALUES(lname), city = VALUES(city), deliveryaddress = VALUES(deliveryaddress)";
        if ($conn->query($sql) === TRUE) {
            echo "Data inserted into trackorder table successfully";
        } else {
            echo "Error inserting data into trackorder table: " . $conn->error;
        }
    } else {
        echo "Error updating order IDs: " . $conn->error;
    }
}

// Close MySQL connection
$conn->close();

