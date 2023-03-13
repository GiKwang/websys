<?php
session_start();

var_dump($_SESSION['email']);
if (isset($_SESSION['email'])) {
    echo "User is logged in!";
} else {
    echo "User is not logged in.";
}
?>

<?php
include 'process_products.php';
include "process_productsdetails.php";
?>

<div class="notification-box flex items-center justify-center">
    <!-- Notification container -->
</div>


<section id="header">
    <a href="#"><img src="img/groom&gologo.png" class="logo" alt="" width="90" height="80"></a>
    <div>
        <ul id="navbar">
            <li><a <?php
if ($page == 'index') {
    echo 'class="active"';
}
?> href="index.php">Home</a></li>
            <li><a <?php
                if ($page == 'shop') {
                    echo 'class="active"';
                }
?> href="shop.php">Shop</a></li>

            <?php if (isset($_SESSION['email'])) { ?>
                <li><a <?php
                if ($page == 'profile') {
                    echo 'class="active"';
                }
                ?> href="accountsetting.php">Profile</a></li>
                    <?php } ?>

            <?php if (isset($_SESSION['usertype']) && $_SESSION['usertype'] == 'admin') { ?>
                <li><a <?php
                if ($page == 'admin') {
                    echo 'class="active"';
                }
                ?> href="admin.php">Admin</a></li>
                    <?php } ?>


            <li><a <?php
                    if ($page == 'about') {
                        echo 'class="active"';
                    }
                    ?> href="about.php">About</a></li>

            <li><a <?php
                if ($page == 'contact') {
                    echo 'class="active"';
                }
                    ?> href="contact.php">Contact</a></li>

            <?php if (isset($_SESSION['email'])) { ?>
                <li class="icons d-flex">
                    <div class="icon logout-link d-flex">
                        <a class="logout-link" href="process_logout.php">Logout</a> 
                    </div>
                </li>
            <?php } else { ?>
                <li class="icons d-flex">
                    <div class="icon user-icon d-flex">
                        <a class="user-link" href="#">Login</a>
                    </div>
                </li>
            <?php } ?>

            <li id="lg-bag"><a <?php
            if ($page == 'cart') {
                echo 'class="active"';
            }
            ?> href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
        </ul>
    </div>

    <div id="mobile">
        <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>


<script>
    function addToCart(product) {
        $.ajax({
            type: "POST",
            url: "process_addtocart.php",
            data: {
                price: product.price,
                name: product.name,
                brand: product.brand,
                imgsrc: product.imageSrc
            },
            success: function (response) {
                // parse the response as JSON
                var cart = JSON.parse(response);

                // check if the current cart quantity is less than the product quantity
                if (cart[product.name] < product.quantity) {
                    sendNotification('success', 'Added to cart!');
                } else {
                    sendNotification('error', 'Product quantity in cart is already at maximum!');
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>

