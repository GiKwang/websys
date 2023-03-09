<?php
$page = 'about'; // change this to match the name of the page
include('nav.inc.php');

include 'register.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Groom & Go</title

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

            <h2>#KnowUs </h2>

            <p>Lorem ipsum dolor sit amet, consectetur </p>

        </section>

        <section id="about-head" class="section-p1">
            <img src="img/about/a6.jpg" alt="">
            <div>
                <h2>Who We Are?</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis auteirure
                    dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                <abbr title="">Create stunning images with as much or as little control as you like thanks to a choice of Basic and Creative modes.</abbr>

                <br><br>

                <marquee bgcolor="#ccc" loop="-1" scrollamount="5" width="100%">Create stunning images with as much or as little control as you like thanks to a choice of Basic and Creative modes.
                </marquee>
            </div>
        </section>

        <section id="about-app" class="section-p1">
            <h1>Download Our <a href="#">App</a> </h1>
            <div class="video">
                <video autoplay muted loop src="img/about/1.mp4"></video>
            </div>
        </section>

        <section id="feature" class="section-p1">
            <div class="fe-box">
                <img src="img/features/f1.png" alt="">
                <h6>Free Shipping</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f2.png" alt="">
                <h6>Online Order</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f3.png" alt="">
                <h6>Save Money</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f4.png" alt="">
                <h6>Promotions</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f5.png" alt="">
                <h6>Happy Sell</h6>
            </div>
            <div class="fe-box">
                <img src="img/features/f6.png" alt="">
                <h6>F24/7 Support</h6>
            </div>
        </section>

        <?php
        include "newsletter.inc.php";
        ?>
        
        <?php
        include "footer.inc.php";
        ?>


    </body>

</html>