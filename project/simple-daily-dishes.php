<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3">
                    <div class="col-12 align-items-center">
                        <div class="">
                            <div class="d-flex flex-row justify-content-lg-center gap-3">
                                <a href="/project/simple-daily-dishes.php" class="btn-category btn-category-active position-relative rounded-0 mb-1 w-auto px-4 py-3">
                                    <h6 class="text-dark fw-medium text-center">Simple Daily Dishes</h6>
                                </a>
                                <a href="/project/international-cuisine.php" class="btn-category position-relative rounded-0 mb-1 w-auto px-3 py-3">
                                    <h6 class="text-dark fw-medium text-center">International Cuisine</h6>
                                </a>
                                <a href="/project/diet-lifestyle.php" class="btn-category position-relative rounded-0 mb-1 w-auto px-3 py-3">
                                    <h6 class="text-dark fw-medium text-center">Diet & Lifestyle</h6>
                                </a>
                                <a href="/project/by-ingredient.php" class="btn-category position-relative rounded-0 mb-1 w-auto px-3 py-3">
                                    <h6 class="text-dark fw-medium text-center">By Ingredient</h6>
                                </a>
                                <a href="/project/cooking-method.php" class="btn-category position-relative rounded-0 mb-1 w-auto px-3 py-3">
                                    <h6 class="text-dark fw-medium text-center">Cooking Technique</h6>
                                </a>
                            </div>
                        </div>
                        <h2 class="text-center fs-2 mt-md-5">Simple Daily Dishes</h2>
                        <p class="lead text-muted text-center fs-5">A vast variety of simple recipes from breakfast to dinner.</p>
                        <form class="d-flex justify-content-center mb-md-5">
                            <input class="form-control me-2 rounded-4 shadow-sm" type="search" placeholder="Search breakfast.." aria-label="Search" style="max-width: 470px">
                            <a href="/project/search-results.php" class="btn btn-main-theme px-3 py-2 rounded-4 text-white fw-medium shadow-sm">Search</a>
                        </form>
                    </div>
                    <?php include 'parts/category-swiper.php'; ?>
                    <div class="g-3 mt-4">
                        <div class="d-none d-md-flex">
                            <i class="search-popular-logo bi bi-star-fill fs-5 me-2 position-relative"></i>
                            <h5>Most popular Simple Daily Dishes recipies</h5>
                        </div>
                        <div class="d-flex d-md-none">
                            <i class="search-popular-logo bi bi-star-fill fs-5 me-2 position-relative"></i>
                            <h5>Most popular</h5>
                        </div>
                    </div>
                    <div class="d-flex flex-column gap-3 mt-3">
                        <?php include 'parts/search-boxes.php'; ?>
                        <?php include 'parts/search-boxes.php'; ?>
                        <?php include 'parts/search-boxes.php'; ?>
                    </div>
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