<aside id="sidebar" class="sidebar sidebar-collapsed fixed-top vh-100 d-flex flex-column">
    <div class="d-flex">
        <button id="toggle-btn" type="button" class="bg-transparent border-0 fs-4">
            <i class="bi bi-list text-white"></i>
        </button>
        <div class="sidebar-logo">
            <a href="#" class="text-white fw-semibold"><?php echo ($title); ?></a>
        </div>
    </div>

    <!-- Mobile-only navigation buttons (hidden on sm and up) 
    <div class="d-block d-lg-none px-2 py-2 border-bottom border-secondary">
        <div class="d-flex flex-column gap-2">
            <button type="button"
                class="btn btn-outline-light sidebar-nav-button px-3 py-2 rounded-4 fw-normal d-flex align-items-center"
                onclick="openPopup()">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                <span class="sidebar-button-text">Log In</span>
            </button>
            <button type="button"
                class="btn btn-outline-light sidebar-nav-button px-3 py-2 rounded-4 fw-normal d-flex align-items-center gap-2"
                onclick="createRecipe()">
                <i class="bi bi-plus-lg"></i>
                <span class="sidebar-button-text">Write a Recipe</span>
            </button>
        </div>
    </div>
    -->

    <ul class="sidebar-nav">
        <li class="sidebar-item position-relative">
            <a href="index.php" class="sidebar-link d-block text-white">
                <i class="bi bi-search"></i>
                <span>Search</span>
            </a>
        </li>

        <!-- Multi-two version
        <li class="sidebar-item">
            <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#multi" 
                aria-expanded="false" aria-controls="multi">
                <i class="bi bi-archive"></i>
                <span>Recipes</span>
            </a>
            <ul id="multi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link has-dropdown collapsed" data-bs-toggle="collapse" data-bs-target="#multi-two" 
                        aria-expanded="false" aria-controls="multi-two">
                        Simple Daily Dishes
                    </a>
                    <ul id="multi-two" class="list-unstyled collapse">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Breakfast</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Lunch</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        -->

        <li class="sidebar-item position-relative">
            <a href="#" class="sidebar-link has-dropdown collapsed d-block text-white" data-bs-toggle="collapse" data-bs-target="#auth" 
                aria-expanded="false" aria-controls="auth">
                <i class="bi bi-archive"></i>
                <span>Recipes</span>
            </a>
            <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item position-relative">
                    <a href="/project/simple-daily-dishes.php" class="sidebar-link d-block text-white">Simple Daily Dishes</a>
                </li>
                <li class="sidebar-item position-relative">
                    <a href="/project/international-cuisine.php" class="sidebar-link d-block text-white">International Cuisine</a>
                </li>
                <li class="sidebar-item position-relative">
                    <a href="/project/diet-lifestyle.php" class="sidebar-link d-block text-white">Diet & Lifestyle</a>
                </li>
                <li class="sidebar-item position-relative">
                    <a href="/project/by-ingredient.php" class="sidebar-link d-block text-white">By Ingredient</a>
                </li>
                <li class="sidebar-item position-relative">
                    <a href="/project/cooking-method.php" class="sidebar-link d-block text-white">Cooking Technique</a>
                </li>
            </ul>
        </li>

        <li class="sidebar-item position-relative">
            <a href="/project/about.php" class="sidebar-link d-block text-white">
                <i class="bi bi-info-circle"></i>
                <span>About us</span>
            </a>
        </li>

        <li class="sidebar-item position-relative">
            <a href="/project/contact.php" class="sidebar-link d-block text-white">
                <i class="bi bi-person-lines-fill"></i>
                <span>Contact</span>
            </a>
        </li>
    </ul>

    <!-- Log out
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="bi bi-box-arrow-right"></i>
            <span>Log out</span>
        </a>
    </div>
    -->
</aside>