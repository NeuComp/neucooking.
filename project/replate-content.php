<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3 justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <div class="ratio ratio-1x1">
                            <img src="/project/images/food-1.png" class="replate-top-im object-fit-cover w-100 h-100 rounded" alt="food-image">
                        </div>
                        <div class="d-flex align-items-start mt-3 mb-2">
                            <a href="/project/profile.php" class="text-decoration-none">
                                <img src="/project/images/profile-1.png" alt="Username" class="object-fit-cover rounded-circle me-3" width="45" height="45">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center">
                                    <strong class="text-dark me-2">Galvin</strong>
                            </a>
                                </div>
                                <small class="text-muted">Edited 2 days ago</small>
                            </div>
                        </div>
                        <div class="expandable-text" data-max-length="250">
                            <p>
                                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum 
                                deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non 
                                provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum 
                                fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta 
                                nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, 
                                omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis 
                                debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non 
                                recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus 
                                maiores alias consequatur aut perferendis doloribus asperiores repellat.
                            </p>
                        </div>
                        <button class="btn btn-like d-flex flex-wrap rounded-5 text-danger px-3 py-2">
                            <i class="bi bi-heart-fill me-2"></i> 35
                        </button>
                        <div class="mt-3 d-flex align-items-center gap-2">
                            <button class="save-button">
                                <i class="bi bi-bookmark"></i> Save Recipe
                            </button>
                            <div class="dropdown">
                                <button class="three-dots-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical text-dark"></i>
                                </button>
                                <ul class="dropdown-menu border-0 shadow-sm">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-camera2 me-3"></i>Send a Replate
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-share-fill me-3"></i>Share
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item border-top text-danger" href="#">
                                            <i class="bi bi-flag me-3"></i>Report
                                        </a>
                                    </li>
                                </ul>
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

<script> <?php include 'js/script.js'; ?> </script>

</body>
</html> 