<?php
session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$errorMessage = '';
$success = true;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

    // Return the error message and success status as a JSON object
    header('Content-Type: application/json');
    echo json_encode(['success' => $success, 'errorMessage' => $errorMessage]);
    exit;
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

                // Redirect to index.php or admin.php depending on user type
                if ($userType == "admin") {
                    header('Location: index.php');
                } else {
                    header('Location: index.php');
                }
                exit;
            }
        } else {
            $errorMessage = "Email not found or password doesn't match.";
            $success = false;
        }
        $stmt->close();
        $mysqli->close();
    }
}
?>




<!-- ====== Login Form ====== -->
<div class="user-form">
    <div class="close-form d-flex"><i class="bx bx-x"></i></div>
    <div class="form-wrapper container">

        <div class="user login">
            <div class="form-box">
                <div class="top">
                    <p>
                        Not a member?
                        <span data-id="#ff0066">Register now</span>
                    </p>
                </div>
                <form action="" method="post">
                    <div class="form-control no-border">
                        <h2>Hello Again!</h2>
                        <p>Welcome back you've been missed.</p>
                        <input class="form-control" id="email" required name="email" type="email" placeholder="Enter Email" />
                        <div>
                            <input class="form-control" id="password" required name="password" type="password" placeholder="Password" />
                            <div class="icon form-icon">
                                <img src="./images/eye.svg" alt="" />
                            </div>
                        </div>
                        <input type="Submit" value="Login" />
                        <?php if (!empty($errorMessage)) : ?>
                            <div class="alert alert-danger mt-3" role="alert" style="display: none;">
                                <?php echo $errorMessage; ?>
                            </div>

                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Register -->
        <div class="user signup">
            <div class="form-box">
                <div class="top">
                    <p>
                        Already a member?
                        <span data-id="#1a1aff">Login now</span>
                    </p>
                </div>
                <form action="" method="post" >
                    <div class="form-control">
                        <h2>Welcome!</h2>
                        <p>It's good to have you.</p>

                        <div>
                            <input class="form-control" id="fname" required name="fname" type="text" placeholder="First Name" />
                        </div>

                        <div>
                            <input class="form-control" id="lname" required name="lname" type="text" placeholder="Last Name" />
                        </div>

                        <input class="form-control" id="email" required name="email" type="email"  placeholder="Enter Email" />

                        <div>
                            <input class="form-control" id="password" required name="password" type="password" placeholder="Password" />
                        </div>

                        <div>
                            <input class="form-control" id="confirm_password" required name="confirm_password" type="password" placeholder="Confirm Password" />
                            <div class="icon form-icon">
                                <img src="./images/eye.svg" alt="" />
                            </div>
                        </div>

                        <input type="Submit" value="Register" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.querySelector('.user.login #email');
    const passwordInput = document.querySelector('.user.login #password');
    const errorMessageElement = document.querySelector('.user.login .alert-danger');
    const loginForm = document.querySelector('.user.login form');
    const submitButton = loginForm.querySelector('input[type="submit"]');

    emailInput.addEventListener('input', validateEmail);
    passwordInput.addEventListener('input', validateInputs);
    submitButton.addEventListener('click', submitForm);

    function validateEmail() {
        if (emailInput.value && !validateEmailFormat(emailInput.value)) {
            errorMessageElement.textContent = 'Please enter a valid email address.';
            errorMessageElement.style.display = 'block';
        } else {
            errorMessageElement.style.display = 'none';
        }
    }

    function validateInputs() {
        if (!emailInput.value || !passwordInput.value) {
            errorMessageElement.textContent = 'Please enter both email and password.';
            errorMessageElement.style.display = 'block';
        } else {
            errorMessageElement.style.display = 'none';
        }
    }

    function validateEmailFormat(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    // Submit the form via AJAX
    function submitForm(event) {
        event.preventDefault();

        const formData = new FormData(loginForm);
        const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    window.location.href = 'index.php';
                } else {
                    errorMessageElement.textContent = response.errorMessage;
                    errorMessageElement.style.display = 'block';
                }
            }
        };

        xhr.open('POST', window.location.pathname, true);
        xhr.send(formData);
    }
});

</script>
