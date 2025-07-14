<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 mb-5">

                <div class="content-start row g-3">

                    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="border-0 ratio ratio-1x1 rounded overflow-hidden">
                            <img src="/project/images/food-1.png" class="object-fit-cover w-100 h-100 rounded" alt="food-image">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-8">
                        <h2 class="mb-3">Ayam goreng</h2>
                        <div class="d-flex align-items-start mb-1">
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

                    <div class="col-12 mb-4 mt-md-3 mt-lg-4 mb-md-2 mb-lg-2">
                        <a href="#top-replate">
                            <div class="box-below-desc d-flex align-items-center text-white rounded shadow-sm">
                                <i class="bi bi-camera2 m-4 fs-5"></i>
                                <p class="mt-3 me-4">Wanna see how people cook this? Check <span><strong>Replate</strong></span> out!</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                        <h4 class="mb-3">Ingredients</h4>
                        <p class="text-muted mb-3"><i class="bi bi-people me-2"></i>6 people</p>
                        <ul class="list-unstyled">
                            <li class="mb-2">200 grams of chicken breast with skins</li>
                            <li class="mb-2">2 spoons of sugar</li>
                            <li class="mb-2">2 litres of water</li>
                            <li class="mb-2">20 ml of vegetable oil</li>
                            <li class="mb-2">A random amount of vegetables, potatoes, carrots and broccolis.</li>
                            <li class="mb-2">200 grams of chicken breast</li>
                            <li class="mb-2">20 grams of uranium</li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-8">
                        <h4 class="mb-3">How to Make</h4>
                        <p class="text-muted mb-3"><i class="bi bi-clock me-2"></i>30 minutes</p>

                        <!-- Steps -->
                        <?php include 'parts/content-steps.php'; ?>

                        <!-- Steps end-->

                    </div>
                    <div class="gap-2 text-center">
                        <div class="border-top mb-4 mb-md-4"></div>
                        <p><span class="text-muted">Recipe ID: 00001</span></p>
                    </div>
                    <div class="gap-2 mb-2">
                        <div class="border-top mb-3 mb-md-4"></div>
                        <h4>Reactions</h4>
                        <p class="text-muted">Galvin and others give reactions</p>
                        <button class="btn btn-like d-flex flex-wrap rounded-5 text-danger px-3 py-2">
                            <i class="bi bi-heart-fill me-2"></i> 35
                        </button>
                    </div>
                    <div class="gap-2 mb-4" id="top-replate">
                        <div class="border-top mb-3 mb-md-4"></div>
                        <button class="save-button"><i class="bi bi-bookmark"></i> Save Recipe</button>
                        <button class="three-dots-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical text-dark"></i>
                        </button>
                        <ul class="dropdown-menu border-0 shadow-sm">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-camera2 me-3"></i>Send a Replate</a></li>
                            <li class="mb-2"><a class="dropdown-item" href="#"><i class="bi bi-share-fill me-3"></i>Share</a></li>
                            <li><a class="dropdown-item border-top text-danger" href="#"><i class="bi bi-flag me-3"></i>Report</a></li>
                        </ul>
                        <div class="border-bottom mt-3 mt-md-4"></div>
                    </div>
                </div>

                <div class="row g-2">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4>Replate <span class="text-muted">(1)</span></h4>
                        </div>
                        <div class="col-auto">
                            <a href="/project/replate.php">
                                <i class="bi bi-arrow-right fs-4 text-muted"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Top 6 replates -->
                    <div class="col-12 col-md-3 col-lg-3">
                        <?php include 'parts/content-replate.php'; ?>
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        
                    </div>
                    <div class="col-12 col-md-3 col-lg-3">
                        
                    </div>
                    <!-- Replates end-->

                </div>
                <div class="text-center mt-md-4 mb-4 mb-lg-5">
                    <button type="button" class="btn btn-secondary" onclick="openPopupReplate()">Send a Replate</button>
                    <div class="m-3 text-decoration-underline">
                        <a href="about-replate.php" class="text-dark text-muted">More about Replate</a>
                    </div>
                </div>

                <!-- Popup Overlay -->
                <div class="replate-popup-overlay d-flex justify-content-center align-items-center fixed-top w-100 h-100" id="replatePopup" onclick="closePopupOnOverlay(event)">
                    <div class="replate-popup-container bg-white rounded-4 position-relative">
                        <div class="replate-popup-header position-relative">
                            <h2 class="replate-popup-title m-0 mb-1 fs-4 fw-bold">Send a Replate</h2>
                            <p>ID Recipe: 00001</p>
                            <button class="replate-close-btn d-flex justify-content-center align-items-center position-absolute border-0 fs-4 rounded-circle" onclick="closePopupReplate()">×</button>
                        </div>
                        
                        <div class="replate-popup-body p-4">
                            <div class="replate-image-upload-section mb-4">
                                <label class="replate-image-upload-label d-block fw-semibold mb-2">Upload Your Replate Photo</label>
                                <div class="replate-image-upload-container position-relative rounded-2 text-center" onclick="triggerFileInput()">
                                    <div class="replate-upload-placeholder">
                                        <i class="bi bi-camera2 fs-1"></i>
                                        <div>Click to add a photo</div>
                                        <small class="d-block text-muted mt-2">Format: JPG, PNG (Max 300KB)</small>
                                    </div>
                                    <img class="replate-image-preview" id="replateImagePreview" alt="Preview">
                                    <button class="btn btn-danger replate-delete-image-btn btn-sm position-absolute top-0 end-0 m-2 rounded-circle text-center" onclick="deleteImage(event)">
                                        <i class="bi bi-x fs-5"></i>
                                    </button>
                                </div>
                                <input type="file" class="replate-hidden-file-input" id="replateImageInput" accept="image/*" onchange="handleImageUpload(event)">
                            </div>

                            <div class="replate-description-section">
                                <label class="replate-description-label d-block fw-semibold mb-2">Description</label>
                                <textarea class="replate-description-textarea w-100 p-3 rounded-3" id="replateDescriptionText" placeholder="Share your experience with this recipe.." maxlength="500" oninput="updateCharCount()"></textarea>
                                <div class="replate-char-count text-end fs-6 mt-1" id="replateCharCount">0 / 500</div>
                            </div>
                        </div>

                        <div class="replate-popup-footer d-flex justify-content-end gap-2">
                            <button class="btn btn-secondary replate-btn-cancel fw-medium rounded-2" onclick="closePopupReplate()">Cancel</button>
                            <button class="btn btn-main-theme fw-medium rounded-2 text-white" id="replateSubmitBtn" onclick="submitReplate()">Send Replate</button>
                        </div>
                    </div>
                </div>

                <div class="gap-2 mb-4" id="top-replate">
                    <div class="border-top mb-3 mb-sm-4 mb-md-4 mb-lg-4"></div>
                    <h4 class="mb-4">Comments <span class="text-muted">(4)</span></h4>

                    <!-- Comments -->
                    <div class="d-flex align-items-start mb-3">
                        <a href="/profile/project.php" class="text-decoration-none">
                            <img src="/project/images/profile-1.png" alt="Username" class="object-fit-cover rounded-circle me-3" width="45" height="45">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-1">
                                <strong class="text-dark me-2">Galvin</strong>
                        </a>
                                <small class="text-muted">2 days ago</small>
                            </div>
                            <p class="mb-2 text-dark">This recipe is amazing! The caramel turned out perfect and the wafer was so crispy. Will definitely make this again.</p>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm border-0 p-1 me-2" type="button">
                                    <i class="bi bi-heart"></i>
                                    <span class="ms-1 small">12</span>
                                </button>
                                <button class="btn btn-sm border-0 p-1" type="button">
                                    <small class="text-muted">Reply</small>
                                </button>
                            </div>
                            <!-- Comments reply-->
                            <div class="d-flex align-items-start mt-3 mb-3">
                                <a href="/project/profile.php" class="text-decoration-none">
                                    <img src="/project/images/profile-1.png" alt="Username" class="object-fit-cover rounded-circle me-3" width="45" height="45">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <strong class="text-dark me-2">Galvin</strong>
                                </a>
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                    <p class="mb-2 text-dark"><strong>@Galvin</strong> Thank you!<p>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm border-0 p-1 me-2" type="button">
                                            <i class="bi bi-heart"></i>
                                            <span class="ms-1 small">12</span>
                                        </button>
                                        <button class="btn btn-sm border-0 p-1" type="button">
                                            <small class="text-muted">Reply</small>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start mt-3 mb-3">
                                <a href="/project/profile.php" class="text-decoration-none">
                                    <img src="/project/images/profile-1.png" alt="Username" class="object-fit-cover rounded-circle me-3" width="45" height="45">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <strong class="text-dark me-2">Galvin</strong>
                                </a>
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                    <p class="mb-2 text-dark"><strong>@Galvin</strong> No Problem!<p>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm border-0 p-1 me-2" type="button">
                                            <i class="bi bi-heart"></i>
                                            <span class="ms-1 small">12</span>
                                        </button>
                                        <button class="btn btn-sm border-0 p-1" type="button">
                                            <small class="text-muted">Reply</small>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- End reply-->
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-3">
                        <a href="/project/profile.php" class="text-decoration-none">
                            <img src="/project/images/profile-1.png" alt="Username" class="object-fit-cover rounded-circle me-3" width="45" height="45">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-1">
                                <strong class="text-dark me-2">Galvin</strong>
                        </a>
                                <small class="text-muted">2 days ago</small>
                            </div>
                            <p class="mb-2 text-dark">This recipe is amazing! The caramel turned out perfect and the wafer was so crispy. Will definitely make this again.</p>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm border-0 p-1 me-2" type="button">
                                    <i class="bi bi-heart"></i>
                                    <span class="ms-1 small">12</span>
                                </button>
                                <button class="btn btn-sm border-0 p-1" type="button">
                                    <small class="text-muted">Reply</small>
                                </button>
                            </div>
                            <!-- Comments reply-->

                            <!-- End reply-->
                        </div>
                    </div>
                    <!-- Comment section end-->

                    <form class="position-relative w-100">
                        <input type="text" class="form-control comment-form rounded-pill px-3 py-2 pe-5" placeholder="Leave a comment.."/>
                        <button type="submit" class="position-absolute top-50 end-0 translate-middle-y me-3 border-0 bg-transparent d-flex align-items-center justify-content-center">
                            <i class="send-message-button bi bi-send text-dark fs-5"></i>
                        </button>
                    </form>

                    <div class="border-bottom mt-3 mt-sm-4 mt-md-4 mt-lg-4"></div>

                    <div class="row g-2 mb-4">
                        <div class="mb-3 mb-sm-4 mb-md-4 mb-lg-4"></div>
                        <h4 class="mb-4">Similar Recepies</h4>

                        <!-- Posts with similar category -->
                        <?php include 'parts/content-similar.php'; ?>

                        <!-- End -->

                    </div>

                </div>

            </div>

        <?php include 'parts/footer.php'; ?>

        </div>
    <!-- End of wrapper -->
    </div>

<script> <?php include 'js/script.js'; ?> </script>

</body>
</html> 