<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3 justify-content-center">
                    <div class=" col-12 text-center">
                        <img src="/project/images/food-1.png" class="object-fit-cover w-100 rounded" height="125" style="max-width: 600px;" alt="food-image">
                        <h5 class="mt-3">Replate for</h5>
                        <h3 class="fw-semibold text-muted mt-3">Ayam goreng</h3>
                    </div>
                    <?php include 'parts/content-replate.php'; ?>
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