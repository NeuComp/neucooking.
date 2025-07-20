<nav class="top-nav fixed-top z-3">
    <div class="d-flex">
        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">
            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">
                <?php
                $current_page = basename($_SERVER['PHP_SELF']);
                $search_pages = 
                [
                    'search-results.php', 
                    'login.php',
                    'content.php', 
                    'simple-daily-dishes.php',
                    'international-cuisine.php',
                    'diet-lifestyle.php',
                    'by-ingredient.php',
                    'cooking-method.php',
                    'write-recipies.php',
                    'replate.php',
                    'replate-content.php',
                    'profile.php',
                    'about.php',
                    'contact.php'
                ];
                if (in_array($current_page, $search_pages)): ?>   
                <div class="d-flex justify-content-start justify-content-sm-between justify-content-md-between justify-content-lg-between">
                    <div class="d-flex justify-content-start align-items-center py-3 flex-grow-1">
                        <button type="button" class="btn p-0 border-0 bg-transparent me-3" onclick="goBack()">
                            <i class="back-button bi bi-arrow-left fs-2 text-muted"></i>
                        </button>
                        <div class="flex-grow-1" style="max-width: 300px;">
                            <form>
                                <div class="position-relative">
                                    <i class="search-icon bi bi-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #f27c1e; z-index: 5;"></i>
                                    <input class="form-control ps-5 rounded-5 shadow-sm" type="search" placeholder="Ayam goreng" aria-label="Search" 
                                    style="padding: 10px 20px 10px 20px;">
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Hide navigation buttons on mobile (show on sm and up) -->
                    <div class="d-none d-lg-flex justify-content-end align-items-center py-3">
                        <div class="d-flex gap-2">
                            <a href="login.php">
                                <button type="button" class="btn btn-outline-dark px-4 py-2 rounded-4 fw-normal">
                                    Log In
                                </button>
                            </a>
                            <a href="/project/write-recipies.php" class="btn btn-main-theme px-3 py-2 rounded-4 text-white fw-medium shadow-sm">
                                <i class="bi bi-plus-lg me-2"></i>Write a Recipe
                            </a>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <!-- Hide navigation buttons on mobile (show on sm and up) -->
                    <div class="d-flex justify-content-end align-items-center py-3">
                        <div class="d-flex gap-2">
                            <a href="login.php">
                                <button type="button" class="btn btn-outline-dark px-4 py-2 rounded-4 fw-normal">
                                    Log In
                                </button>
                            </a>
                            <a href="/project/write-recipies.php" class="btn btn-main-theme px-3 py-2 rounded-4 text-white fw-medium shadow-sm">
                                <i class="bi bi-plus-lg me-2"></i>Write a Recipe
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<!-- <div class="popup-overlay w-100 h-100 d-flex justify-content-center align-items-center">
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

                            </div>
                        </div>
                    </div> -->