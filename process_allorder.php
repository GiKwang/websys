<?php
session_start();

// Create database connection
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if searchOrderId is passed
if (isset($_POST['searchOrderId'])) {
    $searchOrderId = mysqli_real_escape_string($conn, $_POST['searchOrderId']);
    // Query the database for the specific order_id
    $sql = "SELECT order_id, ship_date, deliveryid, order_status FROM trackorder WHERE order_id='$searchOrderId'";
} else {
    // Query the database for all orders
    $sql = "SELECT order_id, ship_date, deliveryid, order_status FROM trackorder";
}


$result = mysqli_query($conn, $sql);

// Check if any orders were found
if (mysqli_num_rows($result) > 0) {

// Generate HTML for each order
    while ($row = mysqli_fetch_assoc($result)) {
        $order_id = $row['order_id'];
        $ship_date = $row['ship_date'];
        $deliveryid = $row['deliveryid'];
        $order_status = $row['order_status'];

        // Set active class based on order status
        if ($order_status == 'orderprocessed') {
            $step1_class = 'step0 active text-center';
            $step2_class = 'step0 text-center';
            $step3_class = 'step0  text-center';
        } elseif ($order_status == 'ordershipped') {
            $step1_class = 'step0 active text-center';
            $step2_class = 'step0 active text-center';
            $step3_class = 'step0 text-center';
        } elseif ($order_status == 'orderenroute') {
            $step1_class = 'step0 active text-center';
            $step2_class = 'step0 active text-center';
            $step3_class = 'step0 active text-center';
        } else {
            $step1_class = 'step0 text-center';
            $step2_class = 'step0 text-center';
            $step3_class = 'step0  text-center';
        }
        echo '<script>var userType = "' . $_SESSION['usertype'] . '";</script>';

        echo'                            
        
<section>
                                <div class="col-12 justify-content-center align-items-center">
                                    <div class="card card-stepper text-black" style="border-radius: 16px;">

                                        <div class="card-body p-5">

                                            <div class="d-flex justify-content-between align-items-center mb-5">
                                                <div>
                                                    <h5 class="mb-0">ORDER ID <span class="text-primary font-weight-bold">#' . $order_id . '</span></h5>
                                                </div>
                                                <div class="text-end">
                                <p class="mb-0">Expected Arrival <span>' . $ship_date . '</span></p>
                                                    <p class="mb-0">Ninja Van <span class="font-weight-bold">' . $deliveryid . '</span></p>
                                                </div>
                                            </div>

                                            <ul id="progressbar-2" class="d-flex justify-content-between mx-0 mt-0 mb-5 px-0 pt-0 pb-2">
                                                <li class="' . $step1_class . '" id="step1">Step 1</li>
                                                <li class="' . $step2_class . '" id="step2">Step 2</li>
                                                <li class="' . $step3_class . '" id="step3">Step 3</li>
                                                <li class="step0 text-muted text-end" id="step4">Step 4</li>
                                            </ul>

                                            <div class="d-flex justify-content-between">
                                                <div class="d-lg-flex align-items-center">
                                                    <i class="fas fa-clipboard-list fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                                    <div>
                                                        <p class="fw-bold mb-1">Order</p>
                                                        <p class="fw-bold mb-0">Processed</p>
                                                    </div>
                                                </div>
                                                <div class="d-lg-flex align-items-center">
                                                    <i class="fas fa-box-open fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                                    <div>
                                                        <p class="fw-bold mb-1">Order</p>
                                                        <p class="fw-bold mb-0">Shipped</p>
                                                    </div>
                                                </div>
                                                <div class="d-lg-flex align-items-center">
                                                    <i class="fas fa-shipping-fast fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                                    <div>
                                                        <p class="fw-bold mb-1">Order</p>
                                                        <p class="fw-bold mb-0">En Route</p>
                                                    </div>
                                                </div>
                                                <div class="d-lg-flex align-items-center">
                                                    <i class="fas fa-home fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                                    <div>
                                                        <p class="fw-bold mb-1">Order</p>
                                                        <p class="fw-bold mb-0">Arrived</p>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                            


<div class="d-flex justify-content-end button-containertrackorder">
                            <button type="button" class="btn btn-primary" onclick="showOrderDetails(\'' . $order_id . '\')">Check Order</button>
                            <button type="button" class="btn btn-primary" onclick="handleCancelOrder(\'' . $order_id . '\')">Cancel Order</button>
<select class="form-select" id="statusDropdown-' . $order_id . '">
        <option value="orderprocessed">Order Processed</option>
        <option value="ordershipped">Order Shipped</option>
        <option value="orderenroute">Order En Route</option>
    </select>
                                <button type="button" class="btn btn-primary" onclick="updateOrderStatus(\'' . $order_id . '\')">Update Order</button>
</div>


                                        </div>
                                    </div>
                                </div>
                            </section>';
    }
} else {
    echo 'No order has been made.';
}
?>             

<script>
    async function showOrderDetails(orderId) {
        console.log('showOrderDetails called with orderId:', orderId);

        try {
            const response = await fetch('fetch_order_details.php', {
                method: 'POST',
                body: JSON.stringify({orderId}),
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const data = await response.json();
            const orderDetails = data.orderDetails;
            const total = data.total;
            const couponname = data.couponname;
            let orderDetailsHtml = '';

            orderDetails.forEach(detail => {
                orderDetailsHtml += `
                <div>
                    <strong>Name:</strong> ${detail.name} <br>
                    <strong>Quantity:</strong> ${detail.quantity} <br>
                    <strong>Subtotal:</strong> $${detail.subtotal} <br>
                    <hr>
                </div>
            `;
            });

            // Append the total and couponname to the order details HTML
            orderDetailsHtml += `
            <div>
                <strong>Coupon Used:</strong> ${couponname} <br>
                <strong>Total Paid:</strong> $${total} <br>
            </div>
        `;

            document.getElementById('orderDetailsContent').innerHTML = orderDetailsHtml;
            const modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
            modal.show();
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
        }
    }

    async function updateOrderStatus(orderId) {
        const selectedStatus = document.getElementById(`statusDropdown-${orderId}`).value;

        try {
            const response = await fetch('update_order_status.php', {
                method: 'POST',
                body: JSON.stringify({orderId, updatedStatus: selectedStatus}),
                headers: {
                    'Content-Type': 'application/json'
                }
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const updatedStatus = await response.json();
            console.log('Updated status:', updatedStatus);
            location.reload(); // Refresh the page to reflect the changes
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
        }
    }




</script>