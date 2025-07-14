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