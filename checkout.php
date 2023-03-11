<?php
$page = 'cart'; // change this to match the name of the page
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

        <section id="page-header" class="about-header">

            <h2>#checkout</h2>
            <p>You are 30 seconds away from completing your order!</p>

        </section>

        <div class="container py-5">

            <!-- For demo purpose -->
            <div class="row mb-4">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="display-4">Choose Your Payment Method</h1>
                    <p class="lead mb-0">Select the payment method that works best for you</p>
                    <p class="lead">We accept all major credit cards, PayPal, and bank transfers.</p>
                </div>
            </div>
            <!-- End -->

            <div class="row">
                <div class="col-lg-7 mx-auto">
                    <div class="bg-white rounded-lg shadow-sm p-5">
                        <!-- Credit card form tabs -->
                        <ul role="tablist" class="nav bg-light nav-pills rounded-pill nav-fill mb-3">
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-card" class="nav-link active rounded-pill">
                                    <i class="fa fa-credit-card"></i>
                                    Credit Card
                                </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-paypal" class="nav-link rounded-pill">
                                    <i class="fa"></i>
                                    Paypal
                                </a>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="pill" href="#nav-tab-bank" class="nav-link rounded-pill">
                                    <i class="fa fa-university"></i>
                                    Bank Transfer
                                </a>
                            </li>
                        </ul>
                        <!-- End -->


                        <!-- Credit card form content -->
                        <div class="tab-content">

                            <!-- credit card info-->
                            <div id="nav-tab-card" class="tab-pane fade show active">
                                <p class="alert alert-success">Some text success or error</p>
                                <form role="form">
                                    <div class="form-group">
                                        <label for="username">Full name (on the card)</label>
                                        <input type="text" name="username" placeholder="Jason Doe" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="cardNumber">Card number</label>
                                        <div class="input-group">
                                            <input type="text" name="cardNumber" placeholder="Your card number" class="form-control" required>
                                            <div class="input-group-append">
                                                <span class="input-group-text text-muted">
                                                    <i class="fa fa-cc-visa mx-1"></i>
                                                    <i class="fa fa-cc-amex mx-1"></i>
                                                    <i class="fa fa-cc-mastercard mx-1"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label><span class="hidden-xs">Expiration</span></label>
                                                <div class="input-group">
                                                    <input type="number" placeholder="MM" name="" class="form-control" required>
                                                    <input type="number" placeholder="YY" name="" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-4">
                                                <label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV
                                                    <i class="fa fa-question-circle"></i>
                                                </label>
                                                <input type="text" required class="form-control">
                                            </div>
                                        </div>



                                    </div>
                                    <button type="button" class="subscribe btn btn-primary btn-block rounded-pill shadow-sm"> Confirm  </button>
                                </form>
                            </div>
                            <!-- End -->

                            <!-- Paypal info -->
                            <div id="nav-tab-paypal" class="tab-pane fade">
                                <p>Paypal is easiest way to pay online</p>
                                <p>
                                    <a href="https://www.paypal.com/" target="_blank" rel="noopener noreferrer">
                                        <button type="button" class="btn btn-primary rounded-pill"><i class="fa mr-2"></i> Log into my Paypal</button>
                                    </a>
                                </p>
                                <p class="text-muted">By clicking "Log into my PayPal," you will be directed to the PayPal website to complete your purchase. PayPal is a secure and easy way to pay online, and offers buyer protection and other benefits.</p>
                            </div>
                            <!-- End -->

                            <!-- bank transfer info -->
                            <div id="nav-tab-bank" class="tab-pane fade">
                                <h6>Bank account details</h6>
                                <dl>
                                    <dt>Bank</dt>
                                    <dd> THE WORLD BANK</dd>
                                </dl>
                                <dl>
                                    <dt>Account number</dt>
                                    <dd>7775877975</dd>
                                </dl>
                                <dl>
                                    <dt>IBAN</dt>
                                    <dd>CZ7775877975656</dd>
                                </dl>
                                <p class="text-muted">Please make your payment using the information provided above. Once payment has been received and processed, your order will be shipped promptly. Thank you for your business!
                                </p>
                            </div>
                            <!-- End -->
                        </div>
                        <!-- End -->

                    </div>
                </div>
            </div>
        </div>

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