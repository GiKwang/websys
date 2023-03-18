<?php

session_start();

// Create database connection
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}

// Get the user email from session
$userEmail = $_SESSION['email'];

// Get the product details from the AJAX request
$price = $_POST['price'];
$name = $_POST['name'];
$brand = $_POST['brand'];
$imgsrc = $_POST['imgsrc'];
$userquantity = $_POST['quantity'];

// Check if the cart array is set in the session
if (!isset($_SESSION['cart'])) {

    // If not, initialize it as an empty array
    $_SESSION['cart'] = array();
}

// Check if the product with the same email and null order_id is already in the cart table
$quantity = $userquantity;
$subtotal = $price;
$sql = "SELECT * FROM cart WHERE email = ? AND name = ? AND brand = ? AND order_id IS NULL";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $userEmail, $name, $brand);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the same product with the same email and null order_id already exists, update the quantity and subtotal value
    $row = $result->fetch_assoc();
    $quantity = $row['quantity'] + $userquantity;
    $subtotal = $row['subtotal'] + $price;

    $sql = "UPDATE cart SET quantity = ?, subtotal = ? WHERE email= ? AND name = ? AND brand = ? AND order_id IS NULL";
    
    // Get the maximum quantity from the products table for the respective product
    $maxQuantitySql = "SELECT quantity FROM products WHERE name = ? AND brand = ?";
    $maxQuantityStmt = $conn->prepare($maxQuantitySql);
    $maxQuantityStmt->bind_param("ss", $name, $brand);
    $maxQuantityStmt->execute();
    $maxQuantityResult = $maxQuantityStmt->get_result();

    if ($maxQuantityResult->num_rows > 0) {
        $maxQuantity = $maxQuantityResult->fetch_assoc()['quantity'];
        // If the quantity exceeds the maximum quantity, set it to the maximum quantity
        if ($quantity > $maxQuantity) {
            $quantity = $maxQuantity;
            $subtotal = $quantity * $price;
        }
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dssss", $quantity, $subtotal, $userEmail, $name, $brand);
    $stmt->execute();
} else {
    
    // If the same product with the same email and null order_id does not exist, add it to the cart table
    $sql = "INSERT INTO cart (price, name, brand, quantity, subtotal, imgsrc, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $quantity = $userquantity;
    $subtotal = $price;
    
    // Get the maximum quantity from the products table for the respective product
    $maxQuantitySql = "SELECT quantity FROM products WHERE name = ? AND brand = ?";
    $maxQuantityStmt = $conn->prepare($maxQuantitySql);
    $maxQuantityStmt->bind_param("ss", $name, $brand);
    $maxQuantityStmt->execute();
    $maxQuantityResult = $maxQuantityStmt->get_result();

    if ($maxQuantityResult->num_rows > 0) {
        $maxQuantity = $maxQuantityResult->fetch_assoc()['quantity'];
        
        // If the quantity exceeds the maximum quantity, set it to the maximum quantity
        if ($quantity > $maxQuantity) {
            $quantity = $maxQuantity;
            $subtotal = $quantity * $price;
        }
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dssidss", $price, $name, $brand, $quantity, $subtotal, $imgsrc, $userEmail);
    $stmt->execute();

// Close database connection
    $stmt->close();
    mysqli_close($conn);
}