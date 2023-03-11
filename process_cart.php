<?php

function get_cartorders($names) {
    // Create database connection
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }

    // Retrieve products data from database
    if (empty($names)) {
        $sql = "SELECT name, price, quantity, imageSrc, link FROM products";
    } else {
        $placeholders = implode(',', array_fill(0, count($names), '?'));
        $sql = "SELECT name,, price, quantity, imageSrc, link FROM products WHERE name IN ($placeholders)";
    }

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters, if any
    if (!empty($names)) {
        $stmt->bind_param(str_repeat('s', count($names)), ...$names);
    }

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

//generate the product details dynamically
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            
        <section id="cart" class="section-p1">
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

                <tbody>
                    <tr>
                        <td>/*delete users row by clicking this button*/ <i class="far fa-times-circle"></i>  </a></td>
                        <td><img src="$imgsrc" alt=""></td>
                        <td>$name</td>
                        <td>$price</td>
                        <td>$quantity</td>
                        <td>$subtotal</td>
                    </tr>
                </tbody
                
            </table>
        </section>
                
        }
    } else {
        echo "No products found.";
    }

}
