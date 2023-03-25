<?php

session_start();

function isValidPassword($password) {
    $minLength = 8;
    $hasLowerCase = preg_match('/[a-z]/', $password);
    $hasUpperCase = preg_match('/[A-Z]/', $password);
    $hasDigit = preg_match('/\d/', $password);
    $hasSpecialChar = preg_match('/[^a-zA-Z\d]/', $password);

    return strlen($password) >= $minLength && $hasLowerCase && $hasUpperCase && $hasDigit && $hasSpecialChar;
}

// Create database connection
$config = parse_ini_file('../../private/db-config.ini');
$conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

// Get the user email from session
$userEmail = $_SESSION['email'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update user details
if (isset($_POST['update_details'])) {
    // Get the updated user details entered by the user
    $firstName = $_POST['fname_new'];
    $lastName = $_POST['lname_new'];
    $email = $_POST['email_new'];

    // Check if the fields are not empty
    if (!empty($firstName) && !empty($lastName) && !empty($email)) {
        // Update the user details in the world_of_pets_members table
        $sql = "UPDATE world_of_pets_members SET fname = '$firstName', lname = '$lastName', email = '$email' WHERE email = '$userEmail'";
        if ($conn->query($sql) === TRUE) {
            header("Location: accountsetting.php?success=User details updated successfully.");
            $_SESSION['email'] = $email; // Update the session variable with the new email
            $_SESSION['fname'] = $firstName;
            $_SESSION['lname'] = $lastName;
            exit;
        } else {
            header("Location: accountsetting.php?error=Error updating user details: " . urlencode($conn->error));
            exit;
        }
    } else {
        header("Location: accountsetting.php?error=All fields are required.");
        exit;
    }

    // redirect to accountsetting.php
    header("Location: accountsetting.php");
    exit;
}

// Update password
if (isset($_POST['update_password'])) {
    // Get the old and new passwords entered by the user
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_new_password'];

    // Check if the fields are not empty
    if (!empty($oldPassword) && !empty($newPassword) && !empty($confirmPassword)) {
        
        
        // Check if newPassword and confirmPassword match
        if ($newPassword !== $confirmPassword) {
            header("Location: accountsetting.php?error=New password and confirm password do not match.");
            exit;
        }

        // Check if newPassword has the required strength
        if (!isValidPassword($newPassword)) {
            header("Location: accountsetting.php?error=Password must be at least 8 characters long and include at least one lowercase letter, one uppercase letter, one digit, and one special character.");
            exit;
        }

        // Check if the old password is correct
        $sql = "SELECT password FROM world_of_pets_members WHERE email = '$userEmail'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];
        if (!password_verify($oldPassword, $hashedPassword)) {
            header("Location: accountsetting.php?error=The old password is incorrect.");
            exit;
        } else {
            // Hash the new password
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password in the world_of_pets_members table
            $sql = "UPDATE world_of_pets_members SET password = '$hashedNewPassword' WHERE email = '$userEmail'";
            if ($conn->query($sql) === TRUE) {
                header("Location: accountsetting.php?success=Password updated successfully.");
                exit;
            } else {
                header("Location: accountsetting.php?error=Error updating password: " . urlencode($conn->error));
                exit;
            }
        }
    } else {
        header("Location: accountsetting.php?error=All fields are required.");
        exit;
    }

    // redirect to accountsetting.php
    header("Location: accountsetting.php");
    exit;
}

// Close MySQL connection
$conn->close();
?>
