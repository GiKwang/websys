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
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Groom & Go</title>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
        <link rel="stylesheet" href="style.css">

        <!-- ====== Custom Js ====== -->
        <script defer src="script.js"></script>

        <!-- ====== Boxicons ====== -->
        <link
            href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
            rel="stylesheet"
            />
        <!--jQuery--> 
        <script defer 
                src="https://code.jquery.com/jquery-3.4.1.min.js" 
                integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" 
                crossorigin="anonymous">
        </script> 

        <!--Bootstrap JS--> 
        <script defer 
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" 
                integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" 
                crossorigin="anonymous">
        </script> 


    </head>

    <body>
        <?php include('nav.inc.php'); ?>



        <section class="py-5 my-5">
            <div class="container">
                <h1 class="mb-5">Admin Page</h1>
                <div class="bg-white shadow rounded-lg d-block d-sm-flex">


                    <div class="profile-tab-nav border-right">
                        <div class="p-4">
                            <div class="img-circle text-center mb-3">
                                <img src="img/user2.jpg" alt="Image" class="shadow">
                            </div>
                            <?php if (isset($_SESSION['fname']) && isset($_SESSION['lname'])) { ?>
                                <h4 class="text-center"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname']; ?></h4>
                            <?php } ?>

                        </div>

                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                                <i class="fa fa-home text-center mr-1"></i> 
                                Create Product
                            </a>
                            <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                                <i class="fa fa-key text-center mr-1"></i> 
                                Replace Existing Product
                            </a>
                            <a class="nav-link" id="notification-tab" data-toggle="pill" href="#list" role="tab" aria-controls="notification" aria-selected="false">
                                <i class="fa fa-bell text-center mr-1"></i> 
                                Edit Existing Product
                            </a>
                        </div>
                    </div>


                    <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <h3 class="mb-4">Create Product</h3>

                            <!-- Create Product Form -->
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
                        </div>

                        <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">

                            <h3 class="mb-4">Replace Existing Product</h3>

                            <!-- Update Product Form -->
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

                        </div>

                        <!-- List Products -->
                        <div class="tab-pane fade" id="list" role="tabpanel" aria-labelledby="list-tab">
                            <h3 class="mb-4">Product Lists</h3>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="search">Search by Category or Product Name:</label>
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Type 'all' to display all products">
                                </div>

                                <input type="submit" value="Search" name="search_submit" class="btn btn-primary">
                            </form>
                            <?php
                            if (isset($_POST['search_submit'])) {
                                $search = $_POST['search'];
                                if ($search == "all") {
                                    $stmt = $conn->prepare("SELECT * FROM products");
                                } else {
                                    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR category LIKE ?");
                                    $searchTerm = "%" . $search . "%";
                                    $stmt->bind_param("ss", $searchTerm, $searchTerm);
                                }
                                $stmt->execute();
                                $result = $stmt->get_result();
                            } else {
                                $stmt = $conn->prepare("SELECT * FROM products");
                                $stmt->execute();
                                $result = $stmt->get_result();
                            }

                            // Display products in a table
                            if ($result->num_rows > 0) {
                                echo '<table class="table table-bordered">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Image</th>';
                                echo '<th>Name</th>';
                                echo '<th>Category</th>';
                                echo '<th>Quantity</th>';
                                echo '<th>Update Quantity</th>';
                                echo '<th>Action</th>';
                                echo '</tr>';
                                echo '</thead>';
                                echo '<tbody>';
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td><img src="' . $row['imageSrc'] . '" height="50"></td>';
                                    echo '<td>' . $row['name'] . '</td>';
                                    echo '<td>' . $row['category'] . '</td>';
                                    echo '<td>' . $row['quantity'] . '</td>';
                                    echo '<td>
                <form action="" method="post">
                    <input type="hidden" name="name" value="' . $row['name'] . '">
                    <input type="number" name="quantity" value="' . $row['quantity'] . '">
                    <input type="submit" value="Update" name="update_quantity" class="btn btn-primary">
                </form>
            </td>';
                                    echo '<td>
                <form action="" method="post">
                    <input type="hidden" name="name" value="' . $row['name'] . '">
                    <input type="submit" value="Delete" name="delete" class="btn btn-danger">
                </form>
            </td>';
                                    echo '</tr>';
                                }
                                echo '</tbody>';
                                echo '</table>';
                            } else {
                                echo '<p>No products found</p>';
                            }
                            $stmt->close();

                            // Update quantity of the product
                            if (isset($_POST['update_quantity'])) {
                                $name = $_POST['name'];
                                $quantity = $_POST['quantity'];
                                $stmt = $conn->prepare("UPDATE products SET quantity=? WHERE name=?");
                                $stmt->bind_param("is", $quantity, $name);
                                $stmt->execute();
                                $stmt->close();

                                header("Location: {$_SERVER['REQUEST_URI']}");
                                exit();
                            }
                            ?>
                        </div>





                    </div>
                </div>
        </section> 




        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>