<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Groom & Go</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" 
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
        <!-- Boxicons CSS -->
        <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
        <?php include "nav.inc.php"; ?>

        <?php
        session_start();

        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $errorMessage = '';
        $success = true;

        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $success = false;
            $errorMessage = 'Please enter a valid email address.';
        }

        if (empty($email) || empty($password)) {
            $success = false;
            $errorMessage = 'Please enter both email and password.';
        }

        if ($success) {
            authenticateUser($email, $password);
        }

        function authenticateUser($email, $password) {
            global $errorMessage, $success;
            // Read database configuration from ini file
            $config = parse_ini_file('../../private/db-config.ini');
            // Create database connection
            $mysqli = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
            // Check connection
            if ($mysqli->connect_error) {
                $errorMessage = "Connection failed: " . $mysqli->connect_error;
                $success = false;
            } else {
                // Prepare and bind the SQL statement
                $stmt = $mysqli->prepare("SELECT * FROM world_of_pets_members WHERE email=?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // Get the password hash for the given email address
                    $row = $result->fetch_assoc();
                    $passwordHash = $row["password"];
                    $userType = $row["usertype"]; // Get the user type
                    $fname = $row["fname"]; // Get the fname
                    $lname = $row["lname"]; // Get the lname
                    //
                    // Check if the password matches the hash
                    if (!password_verify($password, $passwordHash)) {
                        $errorMessage = "Email not found or password doesn't match.";
                        $success = false;
                    } else {
                        // Save the user's email and user type in session variables
                        $_SESSION['email'] = $email;
                        $_SESSION['usertype'] = $userType;
                        $_SESSION['fname'] = $fname;
                        $_SESSION['lname'] = $lname;
                    }
                } else {
                    $errorMessage = "Email not found or password doesn't match.";
                    $success = false;
                }
                $stmt->close();
                $mysqli->close();
                if ($success) {
                    // Redirect to index.php or admin.php depending on user type
                    if ($userType == "admin") {
                        header('Location: admin.php');
                    } else {
                        header('Location: index.php');
                    }
                    exit;
                }
            }
        }
        ?>

        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Contact Us</h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
