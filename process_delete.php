<?php

session_start();

// Create database connection
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete Product
$productname = $_POST['name'];
// Prepare the statement
$stmt = $conn->prepare("DELETE FROM products WHERE name = ?");

// Bind the parameters
$stmt->bind_param("s", $productname);

if ($stmt->execute()) {
    $_SESSION['product_deleted'] = true;
    $success = true;
    header("Location: admin.php");
    exit();
} else {
    $_SESSION['product_deleted'] = false;
    $success = false;
    header("Location: admin.php");
    exit();
}
$stmt->close();
