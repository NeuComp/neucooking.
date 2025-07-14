<?php if ($page == "content"): ?>
    <a href="/project/replate-content.php" class="text-decoration-none">
        <div class="card card-with-recook text-bg-dark border-0 overflow-hidden">
            <img src="/project/images/food-1.png" class="card-img" alt="food-image">
        </div>
        <div class="card-body rounded-bottom shadow-sm p-2">
            <div href="/project/profile.php" class="d-flex align-items-center mb-2">
                <img src="/project/images/profile-1.png" alt="profile" class="rounded-circle me-2" width="20" height="20">
                <small class="profile-name text-dark mb-0">by Galvin</small>
            </div>
            <small class="text-muted d-block text-truncate mw-100">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </small>
        </div>
    </a>

<?php elseif ($page == "replate"): ?>
    <div class="col-6 col-md-3">
        <a href="/project/replate-content.php" class="text-decoration-none">
            <div class="card card-with-recook text-bg-dark border-0 overflow-hidden">
                <img src="/project/images/food-1.png" class="card-img" alt="food-image">
            </div>
            <div class="card-body rounded-bottom shadow-sm p-2">
                <div class="d-flex align-items-center mb-2">
                    <img src="/project/images/profile-1.png" alt="profile" class="rounded-circle me-2" width="20" height="20">
                    <small class="profile-name text-dark mb-0">by Galvin</small>
                </div>
                <small class="text-muted d-block text-truncate mw-100">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </small>
            </div>
        </a>
    </div>

<?php endif; ?>