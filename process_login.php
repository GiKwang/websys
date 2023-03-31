<?php

session_start();

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) ?? '';
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? '';
$rememberMe = isset($_POST['remember_me']) && $_POST['remember_me'] === 'on';
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
    authenticateUser($email, $password, $rememberMe);
}

function authenticateUser($email, $password, $rememberMe) {
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
            $member_id = $row["id"]; // Get the user's ID
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

                if ($rememberMe) {
                    // Generate a secure token
                    $token = bin2hex(random_bytes(32));
                    $hashedToken = hash('sha256', $token);

                    // Save the token in the database
                    $expiration = time() + (86400 * 30); // 30 days
                    $updateStmt = $mysqli->prepare("UPDATE world_of_pets_members SET token = ?, token_expiration = ? WHERE id = ?");
                    $updateStmt->bind_param("sii", $hashedToken, $expiration, $member_id);
                    $updateStmt->execute();
                    $updateStmt->close();

                    // Set the cookie
                    setcookie("remember_me", $token, $expiration, "/");
                }

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
