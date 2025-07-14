<?php include 'parts/header.php'; ?>

<body> 

    <div class="wrapper d-flex">

        <?php include 'parts/sidebar.php'; ?>

        <div class="main main-content container-fluid flex-column overflow-hidden position-relative">

            <?php include 'parts/login-register-form.php'; ?>

            <div class="mx-auto col-12 col-sm-12 col-md-10 col-lg-9 margin-to-footer">

                <div class="content-start row g-3">
                    <div class="col-12 d-flex justify-content-center">
                        <div class="card contact-form border-0 shadow-sm">
                            <div class="card-header-contact text-white rounded-top-2 py-4">
                                <h2 class="mb-2 text-center">Get in Touch</h2>
                                <p class="d-block d-md-none text-center mb-0 opacity-75 px-3">Send us a message and we'll get back to you as soon as possible.</p>
                                <p class="d-none d-md-block text-center mb-0 opacity-75 px-5">We'd love to hear from you! Send us a message and we'll get back to you as soon as possible.</p>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <form id="contactForm" action="" method="POST">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0 border-bottom border-2 rounded-0 shadow-none" id="firstName" name="first_name" placeholder="First Name" required>
                                                <label for="firstName">First Name *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="text" class="form-control border-0 border-bottom border-2 rounded-0 shadow-none" id="lastName" name="last_name" placeholder="Last Name" required>
                                                <label for="lastName">Last Name *</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <input type="email" class="form-control border-0 border-bottom border-2 rounded-0 shadow-none" id="email" name="email" placeholder="Email Address" required>
                                                <label for="email">Email Address *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <input type="tel" class="form-control border-0 border-bottom border-2 rounded-0 shadow-none" id="phone" name="phone" placeholder="Phone Number">
                                                <label for="phone">Phone Number</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="form-select border-0 border-bottom border-2 rounded-0 shadow-none" 
                                                        id="subject" name="subject" required>
                                                    <option value="">Choose a subject</option>
                                                    <option value="general">General Inquiry</option>
                                                    <option value="recipes">Recipe Questions</option>
                                                    <option value="cooking-tips">Cooking Tips</option>
                                                    <option value="feedback">Feedback</option>
                                                    <option value="collaboration">Collaboration</option>
                                                    <option value="other">Other</option>
                                                </select>
                                                <label for="subject">Subject *</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea class="form-control border-0 border-bottom border-2 rounded-0 shadow-none" id="message" name="message" placeholder="Your Message" style="height: 150px; resize: vertical;" required></textarea>
                                                <label for="message">Your Message *</label>
                                                <div class="invalid-feedback">
                                                    Please enter your message.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn btn-main-theme btn-sm text-white px-4 py-3 rounded-pill shadow-sm">
                                                <i class="fas fa-paper-plane me-2"></i>
                                                Send Message
                                            </button>
                                        </div>
                                    </div>
                                </form>
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