<?php

session_start();

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

    // Update the user details in the world_of_pets_members table
    $sql = "UPDATE world_of_pets_members SET fname = '$firstName', lname = '$lastName', email = '$email' WHERE email = '$userEmail'";
    if ($conn->query($sql) === TRUE) {
        echo "User details updated successfully";
        $_SESSION['email'] = $email; // Update the session variable with the new email
        $_SESSION['fname'] = $firstName; 
        $_SESSION['lname'] = $lastName; 
    } else {
        echo "Error updating user details: " . $conn->error;
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
    $confirmPassword = $_POST['confirm_password'];

    // Check if the old password is correct
    $sql = "SELECT password FROM world_of_pets_members WHERE email = '$userEmail'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $hashedPassword = $row['password'];
    if (!password_verify($oldPassword, $hashedPassword)) {
        echo "The old password is incorrect";
    } else {
        // Hash the new password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the world_of_pets_members table
        $sql = "UPDATE world_of_pets_members SET password = '$hashedNewPassword' WHERE email = '$userEmail'";
        if ($conn->query($sql) === TRUE) {
            echo "Password updated successfully";
        } else {
            echo "Error updating password: " . $conn->error;
        }

        // redirect to accountsetting.php
        header("Location: accountsetting.php");
        exit;
    }
}

// Close MySQL connection
$conn->close();
?>
