<?php
// Check if the user is an admin and redirect to login page if not
session_start();
if (!isset($_SESSION['usertype']) || $_SESSION['usertype'] !== 'admin') {
    header('Location: index.php');
    exit;
}

// Create database connection.
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    $errorMsg = "Connection failed: " . $conn->connect_error;
    $success = false;
}

// Create Product
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $link = $_POST['link'];
    $imageSrc = $_POST['imageSrc'];
    $description = $_POST['description']; // new
    $category = $_POST['category']; // new
    $stmt = $conn->prepare("INSERT INTO products (name, brand, quantity, price, link, imageSrc, description, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssidssss", $name, $brand, $quantity, $price, $link, $imageSrc, $description, $category);
    if ($stmt->execute()) {
        $successMsg = "Product created successfully";
        $success = true;
    } else {
        $errorMsg = "Error creating product: " . $conn->error;
        $success = false;
    }
    $stmt->close();
}

// Read Product
if (isset($_POST['read'])) {
    $productname = $_POST['name'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE name = ?");
    $stmt->bind_param("s", $productname);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $brand = $row['brand'];
        $quantity = $row['quantity'];
        $price = $row['price'];
        $link = $row['link'];
        $imageSrc = $row['imageSrc'];
        $description = $row['description']; // new
        $category = $row['category']; // new
        $success = true;
    } else {
        $errorMsg = "Product not found";
        $success = false;
    }
    $stmt->close();
}

// Update Product
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    // Prepare the statement
    $stmt = $conn->prepare("UPDATE products SET brand=?, quantity=?, price=?, description=?, category=? WHERE name=?");

    // Bind the parameters
    $stmt->bind_param("sidsss", $brand, $quantity, $price, $description, $category, $name);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Product updated successfully";
    } else {
        echo "Error updating product: " . $conn->error;
    }
}


// Add Quantity to Existing Product
if (isset($_POST['addQuantity'])) {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];

    // Retrieve existing quantity
    $stmt = $conn->prepare("SELECT quantity FROM products WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $existing_quantity = $row['quantity'];

        // Add new quantity to existing quantity
        $new_quantity = $existing_quantity + $quantity;

        // Prepare the statement
        $stmt = $conn->prepare("UPDATE products SET quantity=? WHERE name=?");

        // Bind the parameters
        $stmt->bind_param("ds", $new_quantity, $name);

        if ($stmt->execute()) {
            $successMsg = "Quantity added successfully.";
        } else {
            $errorMsg = "Error: " . $stmt->error;
        }
    } else {
        $errorMsg = "Product not found.";
    }
}

// Delete Product
if (isset($_POST['delete'])) {
    $productname = $_POST['name'];

    // Prepare the statement
    $stmt = $conn->prepare("DELETE FROM products WHERE name = ?");

    // Bind the parameters
    $stmt->bind_param("s", $productname);

    if ($stmt->execute()) {
        $successMsg = "Product deleted successfully";
        $success = true;
    } else {
        $errorMsg = "Error deleting product: " . $stmt->error;
        $success = false;
    }
}
?>

<!DOCTYPE html>
<html>

    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <?php include('nav.inc.php'); ?>

        <main>
            <h1>Admin Page</h1>

            <!-- Create Product Form -->
            <h2 id="create">Create Product</h2>
            <form action="" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" required>
                <label for="brand">Brand:</label>
                <input type="text" name="brand" required>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" required>
                <label for="price">Price:</label>
                <input type="number" name="price" step="0.01" required>
                <label for="imageSrc">Image Source:</label>
                <input type="text" name="imageSrc">
                <label for="link">Link:</label>
                <input type="text" name="link">
                <label for="description">Description:</label>
                <input type="text" name="description">
                <label for="category">Category:</label>
                <input type="text" name="category">
                <input type="submit" name="create" value="Create">
            </form>

            <!-- Update Product Form -->
            <h2 id="update">Update Product</h2>
            <form action="" method="post">
                <label for="name">Product Name:</label>
                <input type="text" name="name" id="name" required>
                <label for="brand">New Brand:</label>
                <input type="text" name="brand" id="brand" required>
                <label for="quantity">New Quantity:</label>
                <input type="number" name="quantity" id="quantity" required>
                <label for="price">New Price:</label>
                <input type="number" name="price" id="price" step="0.01" required>
                <label for="description">Product Description:</label>
                <input type="text" name="description" id="description" required>
                <label for="category">Product Category:</label>
                <input type="text" name="category" id="category" required>
                <input type="submit" value="Update" name="update">
            </form>

            <!-- Add Quantity to Existing Product Form -->
            <h2 id="add-quantity">Add Quantity to Existing Product</h2>
            <form method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" required><br><br>
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" required><br><br>
                <input type="submit" name="addQuantity" value="Add Quantity">
            </form>

            <!-- Delete Product Form -->
            <h2 id="delete">Delete Product</h2>
            <form action="" method="post">
                <label for="name">Product Name:</label>
                <input type="text" name="name" id="name" required>
                <input type="submit" value="Delete" name="delete">
            </form>

            <!-- Read Product Form -->
            <h2 id="read">Read Product</h2>
            <form action="" method="post">
                <label for="name">Product Name:</label>
                <input type="text" name="name" id="name-read" required>
                <input type="submit" value="Read" name="read">
            </form>


        </main>
    </body>
</html>