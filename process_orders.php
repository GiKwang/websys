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
$firstName = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
$lastName = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
$city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
$zip = filter_var($_POST['zip_code'], FILTER_SANITIZE_STRING);
$address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);

// Check if all the inputs are filled
if (empty($firstName) || empty($lastName) || empty($city) || empty($zip) || empty($address)) {
    $errorMessage = 'Please fill all the inputs in the form.';
    $_SESSION['error_message'] = $errorMessage;
    header('Location: error.php');
    exit;
}

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
