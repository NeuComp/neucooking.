<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3">
                    <div class="col-12 align-items-center">
                        <!-- Profile Header -->
                        <div class="d-none d-md-block bg-white rounded-3 p-4 mb-4 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <img src="/project/images/profile-1.png" class="object-fit-cover rounded-circle" width="80" height="80" alt="">
                                    </div>
                                    <!-- Profile Info -->
                                    <div>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h4 class="mb-0 text-dark fw-bold me-2"><?= $user['name'] ?></h4>
                                            <span class="badge text-dark rounded-pill px-2 py-1 d-inline-flex align-items-center" style="background: <?= $roleColors[$user['role']] ?>;">
                                                <i class="bi bi-star-fill me-1"></i>
                                                <?= $user['role'] ?>
                                            </span>
                                        </div>
                                        <p class="text-muted mb-2">Surabaya, East Java</p>
                                        <div class="d-flex gap-4">
                                            <div>
                                                <span class="fw-bold text-dark me-1">1</span>
                                                <span class="text-muted">Followings</span>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark me-1">724</span>
                                                <span class="text-muted">Followers</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill">Follow</button>
                                </div>
                            </div>
                            <div class="mt-3">
                                <span class="text-muted">
                                    Hello! I'm Galvin and I'm the developer of Neu Cooking.
                                </span>
                            </div>
                        </div>
                        <!-- Mobile Profile Header -->
                        <div class="d-block d-md-none bg-white rounded-3 p-4 mb-4 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-column align-items-center">
                                    <div class="mb-2">
                                        <img src="/project/images/profile-1.png" class="object-fit-cover rounded-circle" width="80" height="80" alt="">
                                    </div>
                                    <!-- Profile Info -->
                                    <div>
                                        <div class="d-flex flex-wrap align-items-center">
                                            <h4 class="mb-0 text-dark fw-bold me-2"><?= $user['name'] ?></h4>
                                            <span class="badge text-dark rounded-pill px-2 py-1 d-inline-flex align-items-center" style="background: <?= $roleColors[$user['role']] ?>;">
                                                <i class="bi bi-star-fill me-1"></i>
                                                <?= $user['role'] ?>
                                            </span>
                                        </div>
                                        <p class="text-muted mb-2">Surabaya, East Java</p>
                                        <div class="d-flex gap-4">
                                            <div>
                                                <span class="fw-bold text-dark me-1">1</span>
                                                <span class="text-muted">Following</span>
                                            </div>
                                            <div>
                                                <span class="fw-bold text-dark me-1">1291</span>
                                                <span class="text-muted">Followers</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2">
                                <span class="text-muted">Hello! I'm Galvin and I'm the developer of Neu Cooking.</span>
                            </div>
                            <div class="row mt-3">
                                <button class="btn btn-warning text-white fw-bold px-4 py-2 rounded-pill">Follow</button>
                            </div>
                        </div>

                        <!-- Recipes Section -->
                        <div class="recipes-section bg-white rounded-3 p-4 mb-4 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-cup-hot me-2 text-warning"></i>
                                    Recipes <span class="text-muted">(5)</span>
                                </h5>
                                <button class="btn btn-outline-secondary btn-sm rounded-3" disabled>
                                    See all
                                </button>
                            </div>

                            <div class="d-none d-md-block swiper card-swiper overflow-hidden">
                                <div class="swiper-wrapper">
                                    <!-- Recipe cards -->
                                    <?php include 'parts/profile-recipe.php'; ?>
                                    <?php include 'parts/profile-recipe.php'; ?>
                                    <?php include 'parts/profile-recipe.php'; ?>
                                    <?php include 'parts/profile-recipe.php'; ?>
                                    <?php include 'parts/profile-recipe.php'; ?>

                                    <!-- End -->
                                </div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>

                            <div class="d-block d-md-none recipes-swiper position-relative">
                                <div class="swiper-wrapper d-flex gap-3 overflow-auto pb-3" style="scroll-behavior: smooth;">
                                    <!-- Recipe cards -->
                                    <?php include 'parts/profile-recipe.php'; ?>
                                    <?php include 'parts/profile-recipe.php'; ?>
                                    <?php include 'parts/profile-recipe.php'; ?>
                                    <?php include 'parts/profile-recipe.php'; ?>
                                    <?php include 'parts/profile-recipe.php'; ?>

                                    <!-- End -->
                                </div>
                            </div>
                        </div>

                        <!-- Replate Section -->
                        <div class="recipes-section bg-white rounded-3 p-4 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <h5 class="mb-0 fw-bold">
                                    <i class="bi bi-cup-hot me-2 text-warning"></i>
                                    Replate <span class="text-muted">(5)</span>
                                </h5>
                                <button class="btn btn-outline-secondary btn-sm rounded-3" disabled>
                                    See all
                                </button>
                            </div>

                            <div class="d-none d-md-block swiper card-swiper overflow-hidden">
                                <div class="swiper-wrapper">
                                    <!-- Recipe cards -->
                                    <?php include 'parts/profile-replate.php'; ?>
                                    <?php include 'parts/profile-replate.php'; ?>
                                    <?php include 'parts/profile-replate.php'; ?>
                                    <?php include 'parts/profile-replate.php'; ?>
                                    <?php include 'parts/profile-replate.php'; ?>

                                    <!-- End -->
                                </div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>
                            </div>

                            <div class="d-block d-md-none recipes-swiper position-relative">
                                <div class="swiper-wrapper d-flex gap-3 overflow-auto pb-3" style="scroll-behavior: smooth;">
                                    <!-- Replate cards -->
                                    <?php include 'parts/profile-replate.php'; ?>
                                    <?php include 'parts/profile-replate.php'; ?>
                                    <?php include 'parts/profile-replate.php'; ?>
                                    <?php include 'parts/profile-replate.php'; ?>
                                    <?php include 'parts/profile-replate.php'; ?>

                                    <!-- End -->
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
    <?php include 'js/script.js'; ?>
    
    // Add smooth scrolling for recipe swiper
    document.addEventListener('DOMContentLoaded', function() {
        const swiperWrapper = document.querySelector('.swiper-wrapper');
        if (swiperWrapper) {
            // Add mouse wheel horizontal scrolling
            swiperWrapper.addEventListener('wheel', function(e) {
                if (e.deltaY !== 0) {
                    e.preventDefault();
                    this.scrollLeft += e.deltaY;
                }
            });
        }
    });
</script>

</body>
</html>