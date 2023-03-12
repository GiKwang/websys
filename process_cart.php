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
    $sql = "SELECT name, price, quantity, imgsrc, subtotal FROM cart WHERE email = ?";

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
        <div class="row mt-3 mx-3 black-text" style="margin-top:25px;">
            <div class="col-lg-12" style="margin-left: 50px;">
                <div class="row justify-content-center">
                    <div class="col-md-9">
                        <div class="card card-custom pb-4">
                            <div class="card-body mt-0 mx-5">
                                <div id="shipping-details" class="text-center mb-3 pb-2 mt-3 shippingdetails">
                                    <h4 style="color: #495057; font-size:30px;">Shipping Details</h4>
                                </div>
                                <form class="mb-0">
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="form9Example1" class="form-control input-custom" placeholder="Enter your first name" />
                                                <label class="form-label" for="form9Example1">First name</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="form9Example2" class="form-control input-custom" placeholder="Enter your last name" />
                                                <label class="form-label" for="form9Example2">Last name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="form9Example3" class="form-control input-custom" placeholder="Enter your city" />
                                                <label class="form-label" for="form9Example3">City</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="form9Example4" class="form-control input-custom" placeholder="Enter your zip code" />
                                                <label class="form-label" for="form9Example4">Zip</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="form9Example6" class="form-control input-custom" placeholder="Enter your address" />
                                                <label class="form-label" for="form9Example6">Address</label>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

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
            <form action="update_orders.php" method="post">
                    <button class="normal" type="submit">Proceed to checkout</button>
                </form>
            </div>
        </section>
        ';
    } else {
        echo "No products found.";
    }
}
