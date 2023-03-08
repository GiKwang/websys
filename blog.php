<?php
$page = 'blog'; // change this to match the name of the page
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


        <section id="page-header" class="blog-header">

            <h2>#readmore</h2>

            <p>Read all case studies about our products! </p>

        </section>

        <section id="blog">
            <div class="blog-box">
                <div class="blog-img">
                    <img src="img/blog/b1.jpg" alt="">
                </div>
                <div class="blog-details">
                    <h4>The Cotton-Jersey Zip-Up Hoodie</h4>
                    <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies yr wolf chartreuse hexagon irony, godard…</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>13/01</h1>
            </div>
            <div class="blog-box">
                <div class="blog-img">
                    <img src="img/blog/b2.jpg" alt="">
                </div>
                <div class="blog-details">
                    <h4>How to Style a Quiff</h4>
                    <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies yr wolf chartreuse hexagon irony, godard…</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>13/04</h1>
            </div>
            <div class="blog-box">
                <div class="blog-img">
                    <img src="img/blog/b3.jpg" alt="">
                </div>
                <div class="blog-details">
                    <h4>Must-Have Skater Girl Items</h4>
                    <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies yr wolf chartreuse hexagon irony, godard…</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>12/01</h1>
            </div>
            <div class="blog-box">
                <div class="blog-img">
                    <img src="img/blog/b4.jpg" alt="">
                </div>
                <div class="blog-details">
                    <h4>Runway-Inspired Trends</h4>
                    <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies yr wolf chartreuse hexagon irony, godard…</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>16/01</h1>
            </div>
            <div class="blog-box">
                <div class="blog-img">
                    <img src="img/blog/b6.jpg" alt="">
                </div>
                <div class="blog-details">
                    <h4>AW20 Menswear Trends</h4>
                    <p>Kickstarter man braid godard coloring book. Raclette waistcoat selfies yr wolf chartreuse hexagon irony, godard…</p>
                    <a href="#">CONTINUE READING</a>
                </div>
                <h1>10/03</h1>
            </div>
        </section>

        <section id="pagination" class="section-p1">
            <a href="#">1</a>
            <a href="#">2</a>
            <a href="#"><i class="fal fa-long-arrow-alt-right"></i></a>
        </section>

        <section id="newsletter" class="section-p1 section-m1">

            <div class="newstext">
                <h4>Stay in the Loop</h4>
                <p>Stay up-to-date on <span>exclusive offers and styling guide.</span> </p>
            </div>

            <div class="form">
                <input type="text" placeholder="Your email address">
                <button class="normal">Sign Up</button>
            </div>

        </section>

        <?php
        include "footer.inc.php";
        ?>

        <?php
        include "register.php";
        ?>
        
    </body>

</html>