<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3">
                    <!-- Hero Section -->
                    <div class="col-12 mb-5">
                        <div class="hero-section text-center py-5 rounded-3 position-relative overflow-hidden">
                            <div class="hero-content position-relative z-index-2">
                                <h1 class="display-4 fw-bold text-white mb-3 animate__animated animate__fadeInUp">neucooking.</h1>
                                <p class="lead text-white mb-4 animate__animated animate__fadeInUp animate__delay-1s">Bringing families together through the art of cooking</p>
                                <div class="hero-stats d-flex justify-content-center gap-4 mt-4">
                                    <div class="stat-item text-white animate__animated animate__fadeInUp animate__delay-2s">
                                        <h3 class="fw-bold mb-0">10K+</h3>
                                        <small>Recipes</small>
                                    </div>
                                    <div class="stat-item text-white animate__animated animate__fadeInUp animate__delay-2s">
                                        <h3 class="fw-bold mb-0">50K+</h3>
                                        <small>Happy Cooks</small>
                                    </div>
                                    <div class="stat-item text-white animate__animated animate__fadeInUp animate__delay-2s">
                                        <h3 class="fw-bold mb-0">10+</h3>
                                        <small>Countries</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Our Story Section -->
                    <div class="col-12 col-md-6">
                        <div class="animate-on-scroll">
                            <h2 class="h1 fw-bold mb-3 mb-md-4">Our Story</h2>
                            <p class="lead text-muted mb-2 mb-md-4">
                                What started as a passion project in a small kitchen has grown into 
                                a global community of food lovers. Neu Cooking was born from the belief 
                                that great food brings people together and creates lasting memories.
                            </p>
                            <p class="d-none d-sm-block d-md-none d-lg-block text-muted mb-4">
                                Founded in 2025 by a team of professional chefs and home cooking enthusiasts, 
                                we've made it our mission to make delicious, authentic recipes accessible 
                                to everyone. From quick weeknight dinners to elaborate holiday feasts, 
                                we're here to guide you through every step of your culinary journey.
                            </p>
                        </div>
                        <div class="animate-on-scroll d-none d-lg-flex justify-content-start gap-3">
                            <div class="bg-light p-3 rounded-3 text-center">
                                <i class="bi bi-award mb-2 fs-4"></i>
                                <p class="small fw-bold mb-0">Award Winning</p>
                            </div>
                            <div class="bg-light p-3 rounded-3 text-center">
                                <i class="bi bi-people-fill mb-2 fs-4"></i>
                                <p class="small fw-bold mb-0">Community Driven</p>
                            </div>
                            <div class="bg-light p-3 rounded-3 text-center">
                                <i class="bi bi-globe-americas mb-2 fs-4"></i>
                                <p class="small fw-bold mb-0">Global Reach</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-flex d-md-none">
                        <div class="animate-on-scroll d-flex d-md-none justify-content-start gap-3">
                            <div class="bg-light p-3 rounded-3 text-center">
                                <i class="bi bi-award mb-2 fs-4"></i>
                                <p class="small fw-bold mb-0">Award Winning</p>
                            </div>
                            <div class="bg-light p-3 rounded-3 text-center">
                                <i class="bi bi-person-fill mb-2 fs-4"></i>
                                <p class="small fw-bold mb-0">Community Driven</p>
                            </div>
                            <div class="d-none d-sm-block bg-light p-3 rounded-3 text-center">
                                <i class="bi bi-globe-americas mb-2 fs-4"></i>
                                <p class="small fw-bold mb-0">Global Reach</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-block d-sm-none">
                        <div class="animate-on-scroll justify-content-md-start gap-3 mb-2">
                            <div class="bg-light p-3 rounded-3 text-center">
                                <i class="bi bi-globe-americas mb-2 fs-4"></i>
                                <p class="small fw-bold mb-0">Global Reach</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 d-none d-md-block mb-5">
                        <div class="ratio ratio-4x3 animate-on-scroll">
                            <img src="/project/images/people-1.png" alt="" class="object-fit-cover rounded-3 shadow-sm">
                        </div>
                    </div>
                    <!-- Mission & Vision Section -->
                    <div class="col-12 mb-4 mb-md-5">
                        <div class="row g-4">
                            <div class="col-lg-6">
                                <div class="mission-card text-white p-5 rounded-3 animate-on-scroll">
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="bi bi-bullseye me-3 fs-2"></i>
                                        <h3 class="fw-bold mb-0">Our Mission</h3>
                                    </div>
                                    <p class="mb-4">
                                        To democratize cooking by providing easy-to-follow, 
                                        tested recipes that inspire confidence in the kitchen. 
                                        We believe everyone deserves to enjoy homemade meals, 
                                        regardless of their cooking experience.
                                    </p>
                                    <ul class="list-unstyled">
                                        <li class="mb-2"><i class="bi bi-check-circle me-2"></i>Make cooking accessible to all</li>
                                        <li class="mb-2"><i class="bi bi-check-circle me-2"></i>Preserve culinary traditions</li>
                                        <li class="mb-2"><i class="bi bi-check-circle me-2"></i>Foster food communities</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="vision-card bg-light p-5 rounded-3 animate-on-scroll">
                                    <div class="d-flex align-items-center mb-4">
                                        <i class="bi bi-eye me-3 fs-2"></i>
                                        <h3 class="fw-bold mb-0">Our Vision</h3>
                                    </div>
                                    <p class="mb-4 mb-md-5 text-muted">
                                        To become the world's most trusted cooking companion, 
                                        helping millions of people discover the joy of cooking 
                                        and create memorable dining experiences with their loved ones.
                                    </p>
                                    <ul class="list-unstyled text-muted">
                                        <li class="mb-2"><i class="bi bi-star me-2"></i>Global cooking community</li>
                                        <li class="mb-2"><i class="bi bi-star me-2"></i>Innovative cooking tools</li>
                                        <li class="mb-2"><i class="bi bi-star me-2"></i>Sustainable food practices</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- What We Offer Section -->
                    <div class="col-12 mb-5" id="user-guide">
                        <div class="text-center mb-5">
                            <h2 class="h1 fw-bold mb-4 animate-on-scroll">What We Offer</h2>
                            <p class="lead text-muted animate-on-scroll">Everything you need to become a confident cook</p>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-4">
                                <div class="feature-card bg-white p-4 rounded-3 shadow-sm h-100 animate-on-scroll hover-lift">
                                    <div class="bg-primary bg-opacity-10 px-2 py-1 rounded-circle d-inline-block mb-3">
                                        <i class="bi bi-book text-primary fs-5"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Tested Recipes</h4>
                                    <p class="text-muted mb-3">Every recipe is thoroughly tested by our team of professional chefs to ensure perfect results every time.</p>
                                    <a href="#" class="btn btn-outline-primary btn-sm btn-about">Explore Recipes</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="feature-card bg-white p-4 rounded-3 shadow-sm h-100 animate-on-scroll hover-lift">
                                    <div class="bg-success bg-opacity-10 px-2 py-1 rounded-circle d-inline-block mb-3">
                                        <i class="bi bi-list-ol text-success fs-5"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Clear Steps</h4>
                                    <p class="text-muted mb-3">Step-by-step instruction guides that show you exactly how to prepare each dish, from prep to plate.</p>
                                    <a href="#" class="btn btn-outline-success btn-sm btn-about">Watch Videos</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="feature-card bg-white p-4 rounded-3 shadow-sm h-100 animate-on-scroll hover-lift">
                                    <div class="bg-warning bg-opacity-10 px-2 py-1 rounded-circle d-inline-block mb-3">
                                        <i class="bi bi-people-fill text-warning fs-5"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Community Support</h4>
                                    <p class="text-muted mb-3">Join our vibrant Replate community of home cooks sharing tips, variations, experience and encouragement.</p>
                                    <a href="#" class="btn btn-outline-warning btn-sm btn-about">Join Community</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="feature-card bg-white p-4 rounded-3 shadow-sm h-100 animate-on-scroll hover-lift">
                                    <div class="bg-info bg-opacity-10 px-2 py-1 rounded-circle d-inline-block mb-3">
                                        <i class="bi bi-phone-fill text-info fs-5"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Mobile Responsive</h4>
                                    <p class="text-muted mb-3">Take your recipes anywhere with our mobile responsive web app. With our engaging UI, you can start anywhere.</p>
                                    <a href="#" class="btn btn-outline-info btn-sm btn-about">Download App</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="feature-card bg-white p-4 rounded-3 shadow-sm h-100 animate-on-scroll hover-lift">
                                    <div class="bg-secondary bg-opacity-10 px-2 py-1 rounded-circle d-inline-block mb-3">
                                        <i class="bi bi-egg-fried text-secondary fs-5"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Various Diets</h4>
                                    <p class="text-muted mb-3">We provide not only simple daily-consumed dishes, but also certain diets which help you through our vegan recipies.</p>
                                    <a href="#" class="btn btn-outline-secondary btn-sm btn-about">Get Started</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="feature-card bg-white p-4 rounded-3 shadow-sm h-100 animate-on-scroll hover-lift">
                                    <div class="bg-danger bg-opacity-10 px-2 py-1 rounded-circle d-inline-block mb-3">
                                        <i class="bi bi-info-circle text-danger fs-5"></i>
                                    </div>
                                    <h4 class="fw-bold mb-3">Nutritional Info (Soon)</h4>
                                    <p class="text-muted mb-3">Detailed nutritional information and dietary tags to help you make informed choices about your delicious meals.</p>
                                    <a href="#" class="btn btn-outline-danger btn-sm btn-about">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Team Section -->
                    <div class="col-12 mb-5 mb-md-5">
                        <div class="text-center mb-5">
                            <h2 class="h1 fw-bold mb-4 animate-on-scroll">Meet Our Team</h2>
                            <p class="lead text-muted animate-on-scroll">The passionate people behind Neu Cooking</p>
                        </div>
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="team-card text-center animate-on-scroll">
                                    <div class="team-image mb-3">
                                        <img src="/project/images/profile-1.png" alt="" class="img-fluid rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                                    </div>
                                    <h5 class="fw-bold mb-2">Galvin</h5>
                                    <p class="text-muted mb-3"></p>
                                    <div class="social-links">
                                        <a href="#" class="text-muted fs-4 me-3"><i class="bi bi-twitter"></i></a>
                                        <a href="#" class="text-muted fs-4 me-3"><i class="bi bi-instagram"></i></a>
                                        <a href="#" class="text-muted fs-4"><i class="bi bi-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Testimonials Section -->
                    <div class="col-12 mb-md-5">
                        <div class="rounded-3">
                            <div class="text-center mb-5">
                                <h2 class="h1 fw-bold mb-4 animate-on-scroll">What Our Community Says</h2>
                                <p class="lead text-muted animate-on-scroll">Real feedback from real home cooks</p>
                            </div>
                            <div class="row g-4">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="testimonial-card bg-white p-4 rounded-3 shadow-sm animate-on-scroll">
                                        <div class="d-flex mb-3">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                        <p class="mb-3 text-muted">"Neu Cooking has transformed my kitchen confidence. The step-by-step guides are perfect for beginners like me!"</p>
                                        <div class="d-flex align-items-center">
                                            <img src="/project/images/profile-1.png" alt="" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="fw-bold mb-0">Galvin E.</h6>
                                                <small class="text-muted">Home Cook</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <div class="testimonial-card bg-white p-4 rounded-3 shadow-sm animate-on-scroll">
                                        <div class="d-flex mb-3">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                        <p class="mb-3 text-muted">"The community here is amazing! I've learned so much from other home cooks and shared my own family recipes."</p>
                                        <div class="d-flex align-items-center">
                                            <img src="/project/images/profile-1.png" alt="" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="fw-bold mb-0">Galvin E.</h6>
                                                <small class="text-muted">Food Enthusiast</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-4">
                                    <div class="testimonial-card bg-white p-4 rounded-3 shadow-sm animate-on-scroll">
                                        <div class="d-flex mb-3">
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                        <p class="mb-3 text-muted">"Finally, a recipe site that actually works! Every dish I've tried has been delicious and easy to follow. Great job Neu team!"</p>
                                        <div class="d-flex align-items-center">
                                            <img src="/project/images/profile-1.png" alt="" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                            <div>
                                                <h6 class="fw-bold mb-0">Galvin E.</h6>
                                                <small class="text-muted">Busy Mom</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Section -->
                    <div class="col-12" id="frequently-asked-questions">
                        <div class="card border-0 shadow-sm mb-md-5">
                            <div class="card-header-faq bg-secondary text-white rounded-top-2 py-4">
                                <h2 class="mb-2 text-center animate-on-scroll">Frequently Asked Questions</h2>
                                <p class="d-none d-sm-block text-center mb-0 animate-on-scroll">Find answers to common questions about Neu Cooking</p>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <div class="accordion accordion-flush" id="faqAccordion">
                                    <!-- FAQ Item 1 -->
                                    <div class="accordion-item border-0 border-bottom animate-on-scroll">
                                        <h3 class="accordion-header" id="faq1">
                                            <button class="accordion-button collapsed bg-transparent border-0 shadow-none py-4" 
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" 
                                                    aria-expanded="false" aria-controls="collapse1">
                                                <strong>What is Neu Cooking all about?</strong>
                                            </button>
                                        </h3>
                                        <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body py-3">
                                                Neu Cooking is your ultimate culinary companion, offering a comprehensive collection of recipes, cooking tips, and techniques. We're passionate about helping home cooks of all skill levels create delicious meals and discover new flavors from around the world.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FAQ Item 2 -->
                                    <div class="accordion-item border-0 border-bottom animate-on-scroll">
                                        <h3 class="accordion-header" id="faq2">
                                            <button class="accordion-button collapsed bg-transparent border-0 shadow-none py-4" 
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" 
                                                    aria-expanded="false" aria-controls="collapse2">
                                                <strong>How can I submit my own recipes?</strong>
                                            </button>
                                        </h3>
                                        <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body py-3">
                                                We love featuring recipes from our community! You can submit your recipes through our contact form above by selecting "Recipe Submission" as the subject. Please include detailed ingredients, instructions, and any special tips that make your recipe unique.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FAQ Item 3 -->
                                    <div class="accordion-item border-0 border-bottom animate-on-scroll">
                                        <h3 class="accordion-header" id="faq3">
                                            <button class="accordion-button collapsed bg-transparent border-0 shadow-none py-4" 
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" 
                                                    aria-expanded="false" aria-controls="collapse3">
                                                <strong>Are all recipes tested before publishing?</strong>
                                            </button>
                                        </h3>
                                        <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body py-3">
                                                Yes! Every recipe on Neu Cooking is thoroughly tested by our team to ensure accuracy and great results. We believe in providing reliable recipes that work consistently, so you can cook with confidence.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FAQ Item 4 -->
                                    <div class="accordion-item border-0 border-bottom animate-on-scroll">
                                        <h3 class="accordion-header" id="faq4">
                                            <button class="accordion-button collapsed bg-transparent border-0 shadow-none py-4" 
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" 
                                                    aria-expanded="false" aria-controls="collapse4">
                                                <strong>Can I request specific recipes or cooking tutorials?</strong>
                                            </button>
                                        </h3>
                                        <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body py-3">
                                                Absolutely! We're always looking for new content ideas. Send us your recipe requests or tutorial suggestions through our contact form, and we'll do our best to create content that matches your interests.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FAQ Item 5 -->
                                    <div class="accordion-item border-0 border-bottom animate-on-scroll">
                                        <h3 class="accordion-header" id="faq5">
                                            <button class="accordion-button collapsed bg-transparent border-0 shadow-none py-4" 
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" 
                                                    aria-expanded="false" aria-controls="collapse5">
                                                <strong>Do you accommodate dietary restrictions and allergies?</strong>
                                            </button>
                                        </h3>
                                        <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body py-3">
                                                Yes, we feature recipes for various dietary needs including vegetarian, vegan, gluten-free, keto, and more. Each recipe is clearly labeled with dietary information, and we often provide substitution suggestions for common allergens.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FAQ Item 6 -->
                                    <div class="accordion-item border-0 border-bottom animate-on-scroll">
                                        <h3 class="accordion-header" id="faq6">
                                            <button class="accordion-button collapsed bg-transparent border-0 shadow-none py-4" 
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" 
                                                    aria-expanded="false" aria-controls="collapse6">
                                                <strong>How often is new content added?</strong>
                                            </button>
                                        </h3>
                                        <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body py-3">
                                                We publish new recipes and cooking content several times per week. Follow us on social media or subscribe to our newsletter to stay updated on the latest additions to our recipe collection.
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FAQ Item 7 -->
                                    <div class="accordion-item border-0 animate-on-scroll">
                                        <h3 class="accordion-header" id="faq7">
                                            <button class="accordion-button collapsed bg-transparent border-0 shadow-none py-4" 
                                                    type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" 
                                                    aria-expanded="false" aria-controls="collapse7">
                                                <strong>How can I get cooking tips and techniques?</strong>
                                            </button>
                                        </h3>
                                        <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="faq7" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body py-3">
                                                In addition to our recipes, we regularly publish cooking tips, technique guides, and how-to articles. You can also reach out to us directly through the contact form with specific questions about cooking methods or ingredients.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Contact CTA Section -->
                    <div class="col-12">
                        <div class="cta-section text-white px-4 py-5 p-md-5 rounded-3 text-center">
                            <h2 class="h1 fw-bold mb-4 animate-on-scroll">Ready to Start Cooking?</h2>
                            <p class="lead mb-4 animate-on-scroll">Join our community of passionate home cooks and discover your next favorite recipe</p>
                            <div class="d-flex justify-content-center flex-wrap animate-on-scroll">
                                <a href="index.php" class="btn btn-light btn-sm rounded-3 px-3 py-2">
                                    <i class="bi bi-search me-2"></i>Let's browse recipes!
                                </a>
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
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
</script>

<script> <?php include 'js/script.js'; ?> </script>

</body>
</html>