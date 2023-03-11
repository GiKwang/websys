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

        <?php
        include "process_productsdetails.php";
        // Call the get_productsdetails function with the product name
        get_productsdetails(array('NG WEI SHEN JACKSON'));
        ?>
        
        <section id="product1" class="section-p1">
            <h2>Featured Products </h2>
            <p>Must-Have Products for Your Hair</p>
        </section>

        <section id="product1" class="section-p1">
            <div class="pro-container">
                <?php
                include 'process_products.php';
                $products = array('jackson', 'NG WEI SHEN JACKSON'); // Replace with the names of the products you want to display
                get_products($products);
                ?>
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


        <script>
            var MainImg = document.getElementById("MainImg");
            var smallimg = document.getElementsByClassName("small-img");

            smallimg[0].onclick = function () {
                MainImg.src = smallimg[0].src;
            }
            smallimg[1].onclick = function () {
                MainImg.src = smallimg[1].src;
            }
            smallimg[2].onclick = function () {
                MainImg.src = smallimg[2].src;
            }
            smallimg[3].onclick = function () {
                MainImg.src = smallimg[3].src;
            }
        </script>


    </body>

</html>