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
    <a href="index.php"><img src="img/groom&gologo.png" class="logo" alt="" width="90" height="70"></a>
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

            <li id="lg-wishlist"><a <?php
                if ($page == 'wishlist') {
                    echo 'class="active"';
                }
                ?> href="wishlist.php"><i class="far fa-heart"></i></a></li>
        </ul>
    </div>

    <div id="mobile">
        <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
        <i id="bar" class="fas fa-outdent"></i>
    </div>
</section>


<script>
    function addToCart(product, quantity) {
        $.ajax({
            type: "POST",
            url: "process_addtocart.php",
            data: {
                price: product.price,
                name: product.name,
                brand: product.brand,
                imgsrc: product.imageSrc,
                quantity: quantity
            },
            success: function (response) {
                // parse the response as JSON
                var cart = JSON.parse(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }


    function moveToCart(event, link) {
        // Prevent the link from being followed
        event.preventDefault();

        // Get the table row for the product
        const row = link.closest("tr");

        // Get the product details from the row
        const name = row.dataset.name;
        const brand = row.dataset.brand;
        const imageSrc = row.querySelector("img").getAttribute("src");
        const price = row.querySelector("td:nth-child(5)").textContent.replace(/^\$\s*/, '');
        const quantity = row.dataset.quantity;
        alert(quantity);

        // Add the product to the cart using the addToCart function
        const product = {name, brand, imageSrc, price};
        addToCart(product, quantity);

        // Remove the row from the wishlist using the deleteRowcart function
        deleteRowcart(event, link);

    }




    function addToWishlist(product) {
        $.ajax({
            type: "POST",
            url: "process_addtowishlist.php",
            data: {
                price: product.price,
                name: product.name,
                brand: product.brand,
                imageSrc: product.imageSrc
            },
            success: function (response) {
                // parse the response as JSON
                var wishlist = JSON.parse(response);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>

