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

        <?php
        include "nav.inc.php";
        ?>

        <?php
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $pwd = isset($_POST['password']) ? $_POST['password'] : "";
        $errorMsg = "";
        $success = true;

        if (empty($_POST["email"])) {
            $success = false;
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $success = false;
            }
        }

        if (empty($_POST["password"])) {
            $success = false;
        }

        if ($success) {
            authenticateUser();
        }

        /*
         * Helper function to authenticate the login.
         */

        function authenticateUser() {
            global $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;

            // Create database connection.
            $config = parse_ini_file('../../private/db-config.ini');
            $conn = new mysqli($config['servername'], $config['username'],
                    $config['password'], $config['dbname']);

            // Check connection
            if ($conn->connect_error) {
                $errorMsg = "Connection failed: " . $conn->connect_error;
                $success = false;
            } else {

                // Prepare the statement:
                $stmt = $conn->prepare("SELECT * FROM world_of_pets_members WHERE
            email=?");

                // Bind & execute the query statement
                $stmt->bind_param("s", $email); //this means the first ? is a string.
                $stmt->execute();
                $result = $stmt->get_result();
                //if there are result , fetch it
                if ($result->num_rows > 0) {
                    // Note that email field is unique, so should only have
                    // one row in the result set.
                    $row = $result->fetch_assoc();
                    $fname = $row["fname"];
                    $lname = $row["lname"];
                    $pwd_hashed = $row["password"];
                    // Check if the password matches, verifies a password that matches a hash
                    if (!password_verify($_POST["password"], $pwd_hashed)) {
                        // Don't be too specific with the error message - hackers don't
                        // need to know which one they got right or wrong. :)
                        $errorMsg = "Email not found or password doesn't match...";
                        $success = false;
                    }
                } else {
                    $errorMsg = "Email not found or password doesn't match...";
                    $success = false;
                }
                $stmt->close();
            }
            $conn->close();
            return $success;
        }

        if (authenticateUser()) {
            $message = "Login successful!";
            $colorClass = "success";
            $buttonText = "Continue to Home Page";
        } else {
            $message = "Login failed!";
            $colorClass = "danger";
            $buttonText = "Try Again";
        }
        ?>

        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card text-center">
                        <div class="card-body py-5">
                            <h2 class="card-title mb-4 fw-bold"><?= $message ?></h2>
                            <?php if (authenticateUser()): ?>
                                <p class="card-text">Welcome back, <?= $fname ?> <?= $lname ?>!</p>
                            <?php else: ?>
                                <p class="card-text"><?= $errorMsg ?></p>
                            <?php endif; ?>
                            <a href="<?= authenticateUser() ? 'index.php' : 'index.php' ?>" class="btn btn-lg btn-<?= $colorClass ?>"><?= $buttonText ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .card {
                border-radius: 10px;
                box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
            }
            .btn-success {
                background-color: #28a745;
                border-color: #28a745;
            }
            .btn-success:hover {
                background-color: #218838;
                border-color: #218838;
            }
            .btn-danger {
                background-color: #dc3545;
                border-color: #dc3545;
            }
            .btn-danger:hover {
                background-color: #c82333;
                border-color: #c82333;
            }
        </style>
        ?>


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
