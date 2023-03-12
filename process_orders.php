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

// Get the shipping details entered by the user
$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$city = $_POST['city'];
$zip = $_POST['zip_code'];
$address = $_POST['address'];


// Insert the shipping details into the cart table
$sql = "UPDATE cart SET fname = '$firstName', lname = '$lastName', homeaddress = '$address', city = '$city', zip = '$zip' WHERE email = '$userEmail' AND order_id IS NULL";
if ($conn->query($sql) === TRUE) {
    echo "Shipping details updated successfully";
} else {
    echo "Error updating shipping details: " . $conn->error;
}

// redirect to checkout.php
header("Location: checkout.php");
exit;

// Close MySQL connection
$conn->close();
