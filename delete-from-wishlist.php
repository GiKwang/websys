<?php

// Create database connection
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}

// sanitize user input
$name = mysqli_real_escape_string($conn, $_POST['name']);

// execute DELETE query
$sql = "DELETE FROM wishlist WHERE name = '$name'";
$result = mysqli_query($conn, $sql);

// Refresh the current page
header("Refresh:0");

// check if query was successful
if ($result) {
    echo 'Row deleted successfully';
} else {
    echo 'Error deleting row: ' . mysqli_error($conn);
}

// close database connection
mysqli_close($conn);
