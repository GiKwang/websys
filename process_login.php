<?php

session_start();

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? '';
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
                $_SESSION['error_message'] = "Email not found or password doesn't match.";
                header('Location: faillogin.php'); // Redirect to faillogin.php
                exit;
            } else {
                // Save the user's email and user type in session variables
                $_SESSION['email'] = $email;
                $_SESSION['usertype'] = $userType;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;

                // Redirect to index.php or admin.php depending on user type
                if ($userType == "admin") {
                    header('Location: index.php');
                } else {
                    header('Location: index.php');
                }
                exit;
            }
        } else {
            $_SESSION['error_message'] = "Email not found or password doesn't match.";
            header('Location: faillogin.php'); // Redirect to faillogin.php
            exit;
        }
        $stmt->close();
        $mysqli->close();
    }
}
?>