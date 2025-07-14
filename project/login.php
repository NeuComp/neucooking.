<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3">

                    <div class="popup-overlay w-100 h-100 d-flex justify-content-center align-items-center">
                        <div class="popup-container bg-white rounded-4 w-100 position-relative shadow">
                            
                            <div class="popup-header position-relative">
                                <h2 class="popup-title text-center mb-2 fs-3 fw-bold" id="popupTitle">Log In</h2>
                                <p class="popup-subtitle text-center text-muted" id="popupSubtitle">Please log in to your account.</p>
                            </div>

                            <div class="popup-body">

                                <div class="form-container active" id="loginForm">
                                    <form action="login.php" method="POST">
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
                                        <button type="submit" name="login" class="btn btn-main-theme w-100 p-3 rounded-2 text-white fw-medium shadow-sm">
                                            Log In
                                        </button>
                                    </form>
                                    <div class="form-footer text-center mt-4 pt-4">
                                        Don't have an account? 
                                        <a href="#" class="text-decoration-none fw-semibold" onclick="showRegisterForm()">Sign up</a>
                                    </div>
                                </div>

                                <div class="form-container" id="registerForm">
                                    <form action="login_register.php" method="POST">
                                        <div class="form-row d-flex gap-3">
                                            <div class="form-group mb-4">
                                                <label class="form-label d-block mb-2 fw-semibold" for="firstName">First Name</label>
                                                <input type="text" class="form-input w-100 rounded-2" name="firstName" id="firstName" placeholder="First name" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label class="form-label d-block mb-2 fw-semibold" for="lastName">Last Name</label>
                                                <input type="text" class="form-input w-100 rounded-2" name="lastName" id="lastName" placeholder="Last name" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label d-block mb-2 fw-semibold" for="email">Email</label>
                                            <input type="email" class="form-input w-100 rounded-2" name="email" id="email" placeholder="Enter your email" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label d-block mb-2 fw-semibold" for="password">Password</label>
                                            <input type="password" class="form-input w-100 rounded-2" name="password" id="password" placeholder="Create a password" required>
                                        </div>
                                        <button type="submit" name="login" class="btn btn-main-theme w-100 p-3 rounded-2 text-white fw-medium shadow-sm">
                                            Create Account
                                        </button>
                                    </form>
                                    <div class="form-footer text-center mt-4 pt-4">
                                        Already have an account? 
                                        <a href="#" class="text-decoration-none fw-semibold" onclick="showLoginForm()">Log in</a>
                                    </div>
                                </div>

                            </div> <!-- popup-body -->
                        </div> <!-- popup-container -->
                    </div> <!-- popup-overlay -->
                </div>

            </div>

        <div class="m-5"></div>
        <?php include 'parts/footer.php'; ?>

        </div>
    <!-- End of wrapper -->
    </div>

<script> <?php include 'js/script.js'; ?> </script>

</body>
</html> 