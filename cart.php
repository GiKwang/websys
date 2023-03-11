<?php
$page = 'cart'; // change this to match the name of the page
include "nav.inc.php";
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

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

        <section id="page-header" class="about-header">

            <h2>#cart</h2>
            <p>Add your coupon code & SAVE up to 70%!</p>

        </section>

        
        <?php include 'process_cart.php'; ?>
        <?php get_cartorders($email);?>

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
                        <td><a href="#"><i class="far fa-times-circle"></i></a></td>
                        <td><img src="img/products/f1.jpg" alt=""></td>
                        <td>Cartoon Astronaut T-Shirts</td>
                        <td>$118.19</td>
                        <td><input type="number" value="1" name="quantity" id="quantity"></td>
                        <td>$118.19</td>
                    </tr>
                </tbody>
            </table>
        </section>

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
        </div>

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
                        <td>$ 335</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>Free</td>
                    </tr>
                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong>$ 335</strong></td>
                    </tr>
                </table>
                <form action="checkout.php">
                    <button class="normal" type="submit">Proceed to checkout</button>
                </form>

            </div>
        </section>


        <?php
        include "newsletter.inc.php";
        ?>

        <?php
        include "footer.inc.php";
        ?>  

        <?php
        include "register.php";
        ?>

    </body>

</html>