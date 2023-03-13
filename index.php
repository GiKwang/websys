<?php
$page = 'index'; // change this to match the name of the page
include('nav.inc.php');
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Groom & Go</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="notification-box flex items-center justify-center">
            <!-- Notification container -->
        </div>

        <!-- Start of slider with carousel effect by bootstrap -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <section id="hero" >

                        <h4>Unleash Your Hair's Potential</h4>
                        <h2>Where Style Meets Substance</h2>

                        <h1><span class="magic">
                                <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>    <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>    <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>
                                <span class="magic-text">Your Hair, Your Rules</span>
                            </span></h1>

                    </section>
                </div>
                <div class="carousel-item">
                    <section id="hair" >
                        <h4>Not Just a New Look</h4>
                        <h2>We Help You Feel</h2>

                        <h1><span class="magic">
                                <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>    <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>    <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>
                                <span class="magic-text1">Confident and Beautiful</span>
                            </span></h1>

                    </section>
                </div>
                <div class="carousel-item">
                    <section id="commercial" >

                        <h4>The Art of Gentleman</h4>
                        <h2>Modern Men, Modern Style</h2>

                        <h1><span class="magic">
                                <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>    <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>    <span class="magic-star">
                                    <svg viewBox="0 0 512 512">
                                    <path d="M512 255.1c0 11.34-7.406 20.86-18.44 23.64l-171.3 42.78l-42.78 171.1C276.7 504.6 267.2 512 255.9 512s-20.84-7.406-23.62-18.44l-42.66-171.2L18.47 279.6C7.406 276.8 0 267.3 0 255.1c0-11.34 7.406-20.83 18.44-23.61l171.2-42.78l42.78-171.1C235.2 7.406 244.7 0 256 0s20.84 7.406 23.62 18.44l42.78 171.2l171.2 42.78C504.6 235.2 512 244.6 512 255.1z" />
                                    </svg>
                                </span>
                                <span class="magic-text2">Bold, Confident, Unstoppable</span>
                            </span></h1>

                    </section>
                </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <!--=========Start of Feature section====================== -->
        <section id="product1" class="section-p1">
            <h2>Featured Products</h2>
            <p>Must-Have Products for Your Hair</p>

            <div class="pro-container">

                <?php
                $products = array('Untangle Me', 'Minuel Hair Spray', 'Japanese Blue Wax', 'Japanese Red Wax'); // Replace with the names of the products you want to display
                get_products($products);
                ?>

        </section>

        <!-- here we will do slider -->
        <section id="GroomGallery" class="section-p1">
            <h2>Strands in Style</h2>
            <p>Unlock the Secret to Perfect Hair Days</p>
        </section>
        <section id="slider" class="sliding">
            <div id="image-track" data-mouse-down-at="0" data-prev-percentage="0">
                <img class="image" src="https://images.unsplash.com/photo-1504439904031-93ded9f93e4e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=436&q=80" draggable="false" />
                <img class="image" src="https://images.unsplash.com/photo-1558487661-9d4f01e2ad64?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" draggable="false" />
                <img class="image" src="https://images.unsplash.com/photo-1519699047748-de8e457a634e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=580&q=80" draggable="false" />
                <img class="image" src="https://images.unsplash.com/photo-1516817206129-e2fcbc3169cc?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" draggable="false" />
                <img class="image" src="https://images.unsplash.com/photo-1586057708056-6149710c46cd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=386&q=80" draggable="false" />
                <img class="image" src="https://images.unsplash.com/photo-1569518082290-b170f86999d4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" draggable="false" />
                <img class="image" src="https://images.unsplash.com/photo-1511039912745-8bfa0bc56aeb?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80" draggable="false" />
                <img class="image" src="https://images.unsplash.com/photo-1589525231707-f2de2428f59c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80" draggable="false" />
            </div>
        </section>


        <!-- here we will discounted products -->
        <section id="product1" class="section-p1">
            <h2>Score More, Spend Less</h2>
            <p>Make a Statement on Your First Day</p>

            <div class="pro-container">

                <?php
                $products = array('Heat Protection Serum', 'Round Hair Brush', 'Fudge Matte Hed Styling Wax', 'L\'oreal Hair Repair Shampoo');
                get_products($products);
                ?>

        </section>

        <section id="sm-banner" class="section-p1">

            <div class="banner-box">
                <h4>Stock Up and Save</h4>
                <h2>Buy 3, Get 1 Free</h2>
                <button class="white">Learn More</button>
            </div>

            <div class="banner-box banner-box2">
                <h4>Get To Know Your Style Persona</h4>
                <h2>Need a Helping Hand?</h2>
                <button class="white">Guidance</button>
            </div>

            <div class="banner-box banner-box2">
                <h4>The best selection for you</h4>
                <h2>Spoiled For Choices</h2>
                <button class="white">Collection</button>
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