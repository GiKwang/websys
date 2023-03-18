<?php

function get_ordersforwishlist($email) {

    // Create database connection
    $config = parse_ini_file('../../private/db-config.ini');
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    }

    // Retrieve products data from database
    $sql = "SELECT name, brand, price, imageSrc, quantity, subtotal FROM wishlist WHERE email = ?";

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
        <table width="100%" style="table-layout: fixed;">
            <thead>
                <tr>
                    <td width="30%">Add to Cart</td>
                    <td width="10%">Remove</td>
                    <td width="10%">Image</td>
                    <td width="25%">Product</td>
                    <td width="5%">Price</td>
                    <td width="5%">Quantity</td>
                    <td width="10%">Subtotal</td>
                </tr>
            </thead>
            <tbody>';
        while ($row = $result->fetch_assoc()) {
            $imageSrc = $row['imageSrc'];
            $name = $row['name'];
            $brand = $row['brand'];
            $price = $row['price'];
            $quantity = $row['quantity'];
            $subtotal = $row['subtotal'];
            $total += $subtotal; 

            echo "<tr data-name='$name' data-brand='$brand' data-quantity='$quantity'>
        <td width='30%'><a href='#' class='move-to-cart' onclick='moveToCart(event, this)'>Move to Cart</a></td>
        <td width='10%'><a href='#' class='delete-row' onclick='deleteRowcart(event, this)'><i class='far fa-times-circle'></i></a></td>
        <td width='10%'><img src='$imageSrc' alt=''></td>
        <td width='25%'>$name</td>
        <td width='5%'>$$price</td>
        <td width='5%'>$quantity</td>
        <td width='10%'>$$subtotal</td>
        </tr>";
        }


        echo '</tbody></table></section>';

        echo'        
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
        echo '<div style="text-align:center; margin-top:50px;">
                <i class="fas fa-heart-broken" style="font-size: 80px; color: #DD4132;"></i>
                <p style="font-size: 24px; margin-top: 25px;">Your wishlist is feeling a bit neglected. Time to give it some love by adding your favorite products.</p>
                <p style="font-size: 24px;">Why not explore our shop and add some products?</p>
                <a href="shop.php" class="btn btn-primary btn-lg" style="margin-top: 25px;">Go to Shop</a>
            </div>';
    }
}
