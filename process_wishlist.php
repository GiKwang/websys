<?php

function get_ordersforcart($email) {

    // Create database connection
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }
    
    // Retrieve products data from database
    $sql = "SELECT name, price, quantity, imgsrc, subtotal FROM cart WHERE email = ? AND order_id IS NULL";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        printf("Error: %s\n", $conn->error);
        exit();
    }

    // Bind parameter
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();

    //initialize total variable
    $total = 0;

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
            $imgsrc = $row['imgsrc'];
            $name = $row['name'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $subtotal = $row['subtotal'];
            $total += $subtotal; //update total

            echo "<tr data-name='$name'>
            <td><a href='#' class='delete-row' onclick='deleteRow(event, this)'><i class='far fa-times-circle'></i></a></td>
            <td><img src='$imgsrc' alt=''></td>
            <td>$name</td>
            <td>$$price</td>
            <td>$quantity</td>
            <td>$$subtotal</td>
            </tr>";
        }
        echo '</tbody></table></section>';

        echo'        
            <section id="cart-add" class="section-p1">
            <div id="cuopon">
                <h3>Apply Coupon</h3>
                <div>
                    <input type="text" name="" id="" placeholder="Enter Your Coupon">
                    <button class="normal">Apply</button>
                </div>
            </div>

            <div id="subtotal">
                <h3>Cart Totals</h3>
                <table>
                    <tr>
                        <td>Cart Subtotal</td>
                    <td>$' . $total . '</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                    <td><strong>$' . $total . '</strong></td>
                    </tr>
                </table>
            </div>
        </section>
        ';

    } else {
        echo "No products found.";
    }
    
}
