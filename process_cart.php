<?php


function get_cartorders($email) {
    
    // Create database connection
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }

    // Retrieve products data from database
    $sql = "SELECT name, price, quantity, imageSrc FROM cart WHERE email = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    //generate the product details dynamically
    if ($result->num_rows > 0) {
        
        echo '<section id="cart" class="section-p1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Remove</td>
                        <td>Image</td>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                    </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            $imgsrc = $row['imageSrc'];
            $name = $row['name'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $subtotal = $price * $quantity;
            echo "<tr>
                    <td><a href='#'><i class='far fa-times-circle'></i></a></td>
                    <td><img src='$imgsrc' alt=''></td>
                    <td>$name</td>
                    <td>$price</td>
                    <td>$quantity</td>
                    <td>$subtotal</td>
                  </tr>";
        }
        echo '</tbody></table></section>';
    } else {
        echo "No products found.";
    }
}

