<?php
$page = 'shop'; // change this to match the name of the page
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

        <?php
        include "nav.inc.php";
        ?>

        <section id="page-header">

            <h2>#Hairspiration</h2>
            <p>Save more with coupons & up to 70% off!</p>

        </section>

<!--        <section id="feature" class="section-p1">
            <div class="fe-box">
                <img src="img/features/f1.png" alt="">
                <h6>Free Shipping</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f2.png" alt="">
                <h6>Next Day Delivery</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f3.png" alt="">
                <h6>Low Price</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f6.png" alt="">
                <h6>Buyer Protection</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f5.png" alt="">
                <h6>Premium Quality Guarantee</h6>
            </div>
        </section>-->
        
        <br>
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-4">
                    <form class="form-inline" action="search.php" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" id="search" name="Search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <section id="product1" class="section-p1">
            <div class="pro-container">

                <!-- Display all products -->
                <?php get_products([]); ?>

            </div>
        </section>

        <section id="pagination" class="section-p1">
            <a href="#"><i class="fal fa-long-arrow-alt-left"></i></a>
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
        </section>


        <section id="banner" class="section-m1">
            <h4>We got you!</h4>
            <h2>Up to <span>70% Off</span> – All Hair Products</h2>
            <button class="normal">Explore More</button>
        </section> 
        
        <?php
        include "footer.inc.php";
        ?>

        <?php
        include "register.php";
        ?>

    </body>

</html>
