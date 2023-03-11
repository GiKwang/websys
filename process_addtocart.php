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

// Check if the cart array is set in the session
if (!isset($_SESSION['cart'])) {
    // If not, initialize it as an empty array
    $_SESSION['cart'] = array();
}

// Loop through the cart array to check if the same product already exists
$cart = $_SESSION['cart'];
$cartCount = count($cart);
$found = false;

for ($i = 0; $i < $cartCount; $i++) {
    $item = &$cart[$i];
    if ($item['name'] === $name && $item['brand'] === $brand) {
        // If the same product already exists, update the quantity and subtotal value
        $item['quantity']++;
        $item['subtotal'] += $price;

        $found = true;
        break;
    }
}

if (!$found) {
    // If the same product does not exist, add it to the cart array
    $product = array(
        'price' => $price,
        'name' => $name,
        'brand' => $brand,
        'imgsrc' => $imgsrc,
        'quantity' => 1,
        'subtotal' => $price
    );

    $_SESSION['cart'][] = $product;
}

// Check if the product with the same email is already in the cart table
$quantity = 1;
$subtotal = $price;
$sql = "SELECT * FROM cart WHERE email = ? AND name = ? AND brand = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $userEmail, $name, $brand);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // If the same product with the same email already exists, update the quantity and subtotal value
    $row = $result->fetch_assoc();
    $quantity = $row['quantity'] + 1;
    $subtotal = $row['subtotal'] + $price;

    $sql = "UPDATE cart SET quantity = ?, subtotal = ? WHERE email = ? AND name = ? AND brand = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dssss", $quantity, $subtotal, $userEmail, $name, $brand);
    $stmt->execute();
} else {
// If the same product with the same email does not exist, add it to the cart table
    $sql = "INSERT INTO cart (price, name, brand, quantity, subtotal, imgsrc, email) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $quantity = 1;
    $subtotal = $price;
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("dssidss", $price, $name, $brand, $quantity, $subtotal, $imgsrc, $userEmail);
    $stmt->execute();
    
    // Close database connection
    $stmt->close();
    mysqli_close($conn);
}

