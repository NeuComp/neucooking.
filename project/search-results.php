<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3">
                    <div>
                        <div class="overflow-auto">
                            <div class="d-flex flex-row">
                                <div class="btn-search-latest position-relative rounded-0 mb-1 w-auto px-4 py-3">
                                    <h6 class="text-dark fw-medium text-center">Latest</h6>
                                </div>
                            </div>
                        </div>

                        <h4 class="mb-3 mb-md-3"><span class="fw-semibold">Ayam goreng</span> recipies <span class="text-muted">(13)</span></h4>
                        <div class="d-none d-md-flex">
                            <i class="search-popular-logo bi bi-star-fill fs-5 me-2 position-relative"></i>
                            <h5 class="mb-0">Check out the most popular 'Ayam goreng' recipies</h5>
                        </div>
                        <div class="d-flex d-md-none">
                            <i class="search-popular-logo bi bi-star-fill fs-5 me-2 position-relative"></i>
                            <h5 class="mb-0">Most popular recipies</h5>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-8">
                        <?php include 'parts/search-swiper.php'; ?>

                        <!-- Search boxes results -->
                        <div class="d-flex flex-column gap-3 mt-3">
                            <?php include 'parts/search-boxes.php'; ?>
                            <?php include 'parts/search-boxes.php'; ?>
                            <?php include 'parts/search-boxes.php'; ?>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-lg-3 ms-4 ms-lg-4">
                        <h5 class="mb-4 fw-semibold">Related Searches</h5>
                        <div class="d-flex flex-wrap">
                            <a href="/project/search-results.php">
                                <h6 class="search-related text-dark rounded-5 px-3 py-1">ayam goreng ungkep</h6>
                            </a>
                            <a href="/project/search-results.php">
                                <h6 class="search-related text-dark rounded-5 px-3 py-1">ayam goreng lengkuas</h6>
                            </a>
                            <a href="/project/search-results.php">
                                <h6 class="search-related text-dark rounded-5 px-3 py-1">ayam goreng bawang putih</h6>
                            </a>
                            <a href="/project/search-results.php">
                                <h6 class="search-related text-dark rounded-5 px-3 py-1">ayam goreng lengkuas</h6>
                            </a>
                            <a href="/project/search-results.php">
                                <h6 class="search-related text-dark rounded-5 px-3 py-1">ayam goreng ketumbar</h6>
                            </a>
                        </div>
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