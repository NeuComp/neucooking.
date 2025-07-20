<?php
require 'admin/config.php';
require 'admin/data.php';
session_start();

$site_title = 'Neu Cooking';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['logIn'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM db_users WHERE email = '".$email."' AND password = '".$password."' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        if($row["role"] == "admin") {
            $_SESSION['role'] = 'admin';
            header("Location: admin/dashboard.php");
        } elseif ($row["role"] == "user") {
            $_SESSION['role'] = 'user';
            header("Location: index.php");
        } else {
            $login_error = "Username or password is incorrect.";
        }
    }

    elseif (isset($_POST['signUp'])) {
        $role = 'user';
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['signup_email'];
        $password = $_POST['signup_password'];

        $check_sql = "SELECT * FROM db_users WHERE email = '".$email."'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $signup_error = "Email already exists. Please use a different email.";
        } else {
            $insert_sql = "INSERT INTO db_users (role, first_name, last_name, email, password) VALUES ('".$role."', '".$first_name."', '".$last_name."', '".$email."', '".$password."')";
            $insert_result = mysqli_query($conn, $insert_sql);

            if ($insert_result) {
                $_SESSION['role'] = 'user';
                $_SESSION['email'] = $email;
                header("Location: index.php");
                exit();
            } else {
                $signup_error = "Registration failed. Please try again.";
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style> <?php include 'css/style.css'; ?> </style>
</head>
<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3">

                    <div class="popup-overlay w-100 h-100 d-flex justify-content-center align-items-center">
                        <div class="bg-white rounded-4 w-100 position-relative shadow" style="max-width: 400px;">

                            <div class="popup-header position-relative">
                                <h2 class="popup-title text-center mb-2 fs-3 fw-bold" id="popupTitle">Log In</h2>
                                <p class="popup-subtitle text-center text-muted" id="popupSubtitle">Please log in to your account.</p>
                                <?php if (!empty($login_error)): ?>
                                    <div class="alert alert-danger text-center mb-3">
                                        <?php echo ($login_error); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($signup_error)): ?>
                                    <div class="alert alert-danger text-center mb-3">
                                        <?php echo ($signup_error); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="popup-body">

                                <div class="form-container active" id="loginForm">
                                    <form action="" method="POST">
                                        <div class="form-group mb-4">
                                            <label class="form-label d-block mb-2 fw-semibold" for="email">Email</label>
                                            <input type="email" class="form-input w-100 rounded-2" name="email" id="email" placeholder="Enter your email" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label d-block mb-2 fw-semibold" for="password">Password</label>
                                            <input type="password" class="form-input w-100 rounded-2" name="password" id="password" placeholder="Enter your password" required>
                                            <div class="forgot-password mt-2 text-end">
                                                <a href="#" class="text-decoration-none fw-medium" onclick="showForgotPassword()">Forgot password?</a>
                                            </div>
                                        </div>
                                        <button type="submit" name="logIn" class="btn btn-main-theme w-100 p-3 rounded-2 text-white fw-medium shadow-sm">
                                            Log In
                                        </button>
                                    </form>
                                    <div class="form-footer text-center mt-4 pt-4">
                                        Don't have an account? 
                                        <a href="#" class="text-decoration-none fw-semibold" onclick="showRegisterForm()">Sign up</a>
                                    </div>
                                </div>

                                <div class="form-container" id="registerForm">
                                    <form action="" method="POST">
                                        <div class="form-row d-none d-sm-flex gap-3">
                                            <div class="form-group mb-4">
                                                <label class="form-label d-block mb-2 fw-semibold" for="firstName">First Name</label>
                                                <input type="text" class="form-input w-100 rounded-2" name="first_name" id="firstName" placeholder="First name" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label d-block mb-2 fw-semibold" for="lastName">Last Name</label>
                                                <input type="text" class="form-input w-100 rounded-2" name="last_name" id="lastName" placeholder="Last name" required>
                                            </div>
                                        </div>
                                        <div class="form-group d-sm-none mb-4">
                                            <label class="form-label d-block mb-2 fw-semibold" for="firstName">First Name</label>
                                            <input type="text" class="form-input w-100 rounded-2" name="first_name" id="firstName" placeholder="First name" required>
                                        </div>
                                        <div class="form-group d-sm-none mb-4">
                                            <label class="form-label d-block mb-2 fw-semibold" for="lastName">Last Name</label>
                                            <input type="text" class="form-input w-100 rounded-2" name="last_name" id="lastName" placeholder="Last name" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label d-block mb-2 fw-semibold" for="email">Email</label>
                                            <input type="email" class="form-input w-100 rounded-2" name="email" id="email" placeholder="Enter your email" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label d-block mb-2 fw-semibold" for="password">Password</label>
                                            <input type="password" class="form-input w-100 rounded-2" name="password" id="password" placeholder="Create a password" required>
                                        </div>
                                        <button type="submit" name="signUp" class="btn btn-main-theme w-100 p-3 rounded-2 text-white fw-medium shadow-sm">
                                            Create Account
                                        </button>
                                    </form>
                                    <div class="form-footer text-center mt-4 pt-4">
                                        Already have an account? 
                                        <a href="#" class="text-decoration-none fw-semibold" onclick="showLoginForm()">Log in</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        <div class="m-5"></div>
        <?php include 'parts/footer.php'; ?>

        </div>
    <!-- End of wrapper -->
    </div>

<script>
    // Log in & Register form pop up
    // function openPopup() {
    //     document.getElementById('popupOverlay').classList.add('active');
    //     document.body.style.overflow = 'hidden';
    // }

    // function closePopup() {
    //     document.getElementById('popupOverlay').classList.remove('active');
    //     document.body.style.overflow = 'auto';
    // }

    function showLoginForm() {
        document.getElementById('loginForm').classList.add('active');
        document.getElementById('registerForm').classList.remove('active');
        document.getElementById('popupTitle').textContent = 'Log In';
        document.getElementById('popupSubtitle').textContent = 'Please log in to your account.';
    }

    function showRegisterForm() {
        document.getElementById('registerForm').classList.add('active');
        document.getElementById('loginForm').classList.remove('active');
        document.getElementById('popupTitle').textContent = 'Sign Up';
        document.getElementById('popupSubtitle').textContent = 'Create your account to get started.';
    }

    // function showForgotPassword() {
        
    // }
    
    // Close popup when clicking outside
    // document.getElementById('popupOverlay').addEventListener('click', function(e) {
    //     if (e.target === this) {
    //         closePopup();
    //     }
    // });

    // Close popup with Escape key
    // document.addEventListener('keydown', function(e) {
    //     if (e.key === 'Escape') {
    //         closePopup();
    //         closePopupReplate();
    //     }
    // });
</script>

<script> <?php include 'js/script.js'; ?> </script>

</body>
</html> 