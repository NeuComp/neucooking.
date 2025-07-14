<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="text-center" style="margin-top: 105px;">
                <h1 class="fw-bold fs-1 display-4 mb-2"><?php echo ($title); ?></h1>
                <p class="lead text-muted mb-4">Find the perfect recipe for any meal, moment, or mood.</p>
                <form class="d-flex justify-content-center mb-md-5">
                    <input class="form-control me-2 rounded-4 shadow-sm" type="search" placeholder="Search recipes.." aria-label="Search" style="max-width: 300px">
                    <a href="/project/search-results.php" class="btn btn-main-theme px-3 py-2 rounded-4 text-white fw-medium shadow-sm">Search</a>
                </form>
                <div class="topCarousel mt-3 mx-auto col-12 col-sm-12 col-md-10 col-lg-9">
                    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2500">
                        <div class="carousel-inner rounded">
                            <div class="carousel-item active">
                                <img src="/project/images/food-1.png" class="d-block w-100 rounded object-fit-cover" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                    <!-- Description-->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="/project/images/food-2.png" class="d-block w-100 rounded object-fit-cover" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                    <!-- Description-->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="/project/images/food-3.png" class="d-block w-100 rounded object-fit-cover" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                    <!-- Description-->
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="/project/images/food-4.png" class="d-block w-100 rounded object-fit-cover" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                    <!-- Description-->
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-4 mx-auto col-12 col-sm-12 col-md-10 col-lg-9 mb-5">
                <h5 class="mb-4">Check out the most popular recepies!</h5>
                <div class="row g-3">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <?php include 'parts/popular-card.php'; ?>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <?php include 'parts/popular-card.php'; ?>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <?php include 'parts/popular-card.php'; ?>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                        <?php include 'parts/popular-card.php'; ?>
                    </div>
                </div>
                <h2 class="mt-5 mt-lg-5 mb-2 text-center">Explore more of our recipies</h2>
                <p class="lead text-muted text-center mb-4 mb-md-5 mb-lg-5">We provide you with a wide variety of choices!</p>
                <div class="row g-3 mb-5">
                    <?php include 'parts/home-swiper.php'; ?>
                </div>
            </div>

        <?php include 'parts/footer.php'; ?>

        </div>
    <!-- End of wrapper -->
    </div>

<script> <?php include 'js/script.js'; ?> </script>

</body>
</html> 