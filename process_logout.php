<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Unset the email session variable
unset($_SESSION['email']);
unset($_SESSION['emailcheck']);

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
}

// Destroy the remember_email cookie
if (isset($_COOKIE['remember_email'])) {
    unset($_COOKIE['remember_email']);
    setcookie('remember_email', '', time() - 3600, '/');
}

// Destroy the session
session_destroy();

// Redirect to the logout page
header('Location: logout.php');
exit;
?>
