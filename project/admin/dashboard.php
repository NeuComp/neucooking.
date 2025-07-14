<?php
require 'config.php';
session_start();

$domain = 'https://galvin.my.id/project/';
$baseUrl = $domain;
$baseUrlAdmin = $baseUrl.'admin/';
$baseUrlThumbnail = $baseUrl.'images/';
$loginUrl = $baseUrl.'login.php';
$site_title = 'Neu Cooking | Admin Dashboard';

if (!isset($_SESSION['admin_username'])) {
    echo "<script type='text/javascript'>
        window.location.href = '$loginUrl';
    </script>";
    exit();
}
?>

<?php 
require 'data.php';
?>
<!doctype html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap');

        body {
            font-family: 'Montserrat', sans-serif;
        }

        .sidebar {
            width: 275px;
            height: 100vh;
            background-color: #f8f9fa;
            top: 0;
            left: 0;
        }

        .main {
            margin-left: 275px;
        }
    </style>
</head>
<body>

    <div class="sidebar bg-primary fixed-top p-4 shadow-lg">
        <div class="d-flex text-white mt-2 mb-3">
            <h5 class="fw-bold">Admin Dashboard</h5>
        </div>
        <div class="d-flex align-items-center text-white mb-3">
            <i class="bi bi-house fs-5 me-2"></i>
            <h6 class="fw-medium mb-0">Dashboard Preview</h6>
        </div>
        <div class="d-flex align-items-center text-white mb-3">
            <i class="bi bi-clock fs-5 me-2"></i>
            <h6 class="fw-medium mb-0">Pending Recipes</h6>
        </div>
        <div class="d-flex align-items-center text-white mb-3">
            <i class="bi bi-book fs-5 me-2"></i>
            <h6 class="fw-medium mb-0">Recipes Management</h6>
        </div>
        <div class="d-flex align-items-center text-white mb-3">
            <i class="bi bi-person-check fs-5 me-2"></i>
            <h6 class="fw-medium mt-1 mb-0">Role Management</h6>
        </div>
        <div class="d-flex align-items-center text-white mb-3">
            <i class="bi bi-journal-bookmark fs-5 me-2"></i>
            <h6 class="fw-medium mb-0">Reports</h6>
        </div>
        <div class="d-flex align-items-center text-white mb-3">
            <i class="bi bi-gear fs-5 me-2"></i>
            <h6 class="fw-medium mb-0">Website Settings</h6>
        </div>
    </div>

    <div class="main bg-light p-4">
        <div class="content p-2">
            <div class="container">

                <div class="dashboard-review mt-2 mb-5">
                    <div class="mb-4">
                        <h3 class="fw-bold">Dashboard Overview</h3>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="card shadow border-0 rounded p-4 d-flex flex-row align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-muted mb-1">Total Recipes</h6>
                                    <h4 class="fw-bold text-primary">0</h4>
                                </div>
                                <i class="bi bi-egg-fried fs-1 text-primary"></i>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow border-0 rounded p-4 d-flex flex-row align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-muted mb-1">Pending Review</h6>
                                    <h4 class="fw-bold text-success">0</h4>
                                </div>
                                <i class="bi bi-clock fs-1 text-success"></i>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow border-0 rounded p-4 d-flex flex-row align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-muted mb-1">Total Users</h6>
                                    <h4 class="fw-bold text-info">0</h4>
                                </div>
                                <i class="bi bi-people fs-1 text-info"></i>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card shadow border-0 rounded p-4 d-flex flex-row align-items-center justify-content-between">
                                <div>
                                    <h6 class="text-muted mb-1">Verified Chefs</h6>
                                    <h4 class="fw-bold text-warning">0</h4>
                                </div>
                                <i class="bi bi-person-check fs-1 text-warning"></i>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card shadow border-0 rounded">
                                <div class="border-bottom px-4 py-3 mt-2">
                                    <h5 class="fw-medium">Recent Activities</h5>
                                </div>
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between">
                                        <ul class="list-unstyled">
                                            <li class="d-flex mb-3">
                                                <i class="bi bi-person-check text-warning fs-3 me-3"></i>
                                                <div>
                                                    <span class="text-muted fw-medium">User <strong>"Budi Siregar"</strong> has been entitled to Verified Chef</span><br>
                                                    <span class="text-secondary small">Uploaded 2 minutes ago</span>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-3">
                                                <i class="bi bi-egg-fried text-primary fs-3 me-3"></i>
                                                <div>
                                                    <span class="text-muted fw-medium">Recipe <strong>"Ayam goreng"</strong> submitted by <strong>Galvin</strong> has been approved</span><br>
                                                    <span class="text-secondary small">Uploaded 2 hours ago</span>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-3">
                                                <i class="bi bi-clock text-success fs-3 me-3"></i>
                                                <div>
                                                    <span class="text-muted fw-medium">Recipe <strong>"Ayam goreng"</strong> submitted by <strong>Galvin</strong> is waiting for review</span><br>
                                                    <span class="text-secondary small">Uploaded 12 hours ago</span>
                                                </div>
                                            </li>
                                            <li class="d-flex mb-3">
                                                <i class="bi bi-people text-info fs-3 me-3"></i>
                                                <div>
                                                    <span class="text-muted fw-medium">New user <strong>"Budi Siregar"</strong> registered</span><br>
                                                    <span class="text-secondary small">Uploaded 2 days ago</span>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pending-recipes mb-5">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <h3 class="fw-bold">Pending Recipes</h3>
                        </div>
                        <div>
                            <form class="d-flex" role="search">
                                <input class="form-control shadow-sm me-2" type="search" placeholder="Search" aria-label="Search" style="width: 250px;">
                                <select class="form-select shadow-sm" aria-label="Default select example">
                                    <option selected>All Status</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Approved</option>
                                    <option value="3">Rejected</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-12">
                            <table class="table shadow">
                                <thead>
                                    <tr>
                                        <th scope="col" class="fw-normal">Recipe</th>
                                        <th scope="col" class="fw-normal align-middle">Author</th>
                                        <th scope="col" class="fw-normal align-middle">Submitted</th>
                                        <th scope="col" class="fw-normal align-middle">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Ayam goreng</div>
                                            <div class="text-muted small">60 minutes - 6 people</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-medium me-2">Galvin Ewaldo Budianto</span>
                                            <span class="badge bg-light text-dark border-0 shadow-sm">User</span>
                                        </td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <i class="bi bi-eye text-primary me-2" role="button"></i>
                                            <i class="bi bi-check-circle text-success me-2" role="button"></i>
                                            <i class="bi bi-x-circle text-danger" role="button"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Ayam goreng kemangi</div>
                                            <div class="text-muted small">60 minutes - 6 people</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-medium me-2">Budi Siregar</span>
                                            <span class="badge bg-light text-dark border-0 shadow-sm">User</span>
                                        </td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <i class="bi bi-eye text-primary me-2" role="button"></i>
                                            <i class="bi bi-check-circle text-success me-2" role="button"></i>
                                            <i class="bi bi-x-circle text-danger" role="button"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Ayam goreng ketumbar</div>
                                            <div class="text-muted small">120 minutes - 12 people</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-medium me-2">Edward Louisiano</span>
                                            <span class="badge bg-primary text-white border-0 shadow-sm">Verified Chef</span>
                                        </td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <i class="bi bi-eye text-primary me-2" role="button"></i>
                                            <i class="bi bi-check-circle text-success me-2" role="button"></i>
                                            <i class="bi bi-x-circle text-danger" role="button"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="recipes-management mb-5">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <h3 class="fw-bold">Recipes Management</h3>
                        </div>
                        <div>
                            <form class="d-flex" role="search">
                                <input class="form-control shadow-sm" type="search" placeholder="Search" aria-label="Search" style="width: 250px;">
                            </form>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-12">
                            <table class="table shadow">
                                <thead>
                                    <tr>
                                        <th scope="col" class="fw-normal">Recipe</th>
                                        <th scope="col" class="fw-normal align-middle">Author</th>
                                        <th scope="col" class="fw-normal align-middle">Submitted</th>
                                        <th scope="col" class="fw-normal align-middle">Approved</th>
                                        <th scope="col" class="fw-normal align-middle">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Ayam goreng</div>
                                            <div class="text-muted small">60 minutes - 6 people</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-medium me-2">Galvin Ewaldo Budianto</span>
                                            <span class="badge bg-light text-dark border-0 shadow-sm">User</span>
                                        </td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <i class="bi bi-eye text-primary me-2" role="button"></i>
                                            <i class="bi bi-x-circle text-danger" role="button"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Ayam goreng kemangi</div>
                                            <div class="text-muted small">60 minutes - 6 people</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-medium me-2">Budi Siregar</span>
                                            <span class="badge bg-light text-dark border-0 shadow-sm">User</span>
                                        </td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <i class="bi bi-eye text-primary me-2" role="button"></i>
                                            <i class="bi bi-x-circle text-danger" role="button"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Ayam goreng ketumbar</div>
                                            <div class="text-muted small">120 minutes - 12 people</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="fw-medium me-2">Edward Louisiano</span>
                                            <span class="badge bg-primary text-white border-0 shadow-sm">Verified Chef</span>
                                        </td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <i class="bi bi-eye text-primary me-2" role="button"></i>
                                            <i class="bi bi-x-circle text-danger" role="button"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="role-management mb-5">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <h3 class="fw-bold">Role Management</h3>
                        </div>
                        <div>
                            <form class="d-flex" role="search">
                                <input class="form-control shadow-sm me-2" type="search" placeholder="Search" aria-label="Search" style="width: 250px;">
                                <select class="form-select shadow-sm" aria-label="Default select example">
                                    <option selected>All Status</option>
                                    <option value="1">User</option>
                                    <option value="2">Verified Chef</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-12">
                            <table class="table shadow">
                                <thead>
                                    <tr>
                                        <th scope="col" class="fw-normal align-middle">User</th>
                                        <th scope="col" class="fw-normal align-middle">Role</th>
                                        <th scope="col" class="fw-normal align-middle">Recipes</th>
                                        <th scope="col" class="fw-normal align-middle">Join Date</th>
                                        <th scope="col" class="fw-normal align-middle">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Galvin Ewaldo Budianto</div>
                                            <div class="text-muted small">galvin@gmail.com</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-light text-dark border-0 shadow-sm">User</span>
                                        </td>
                                        <td class="align-middle">28</td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <button class="btn btn-sm btn-outline-primary">Verify Chef</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Budi Siregar</div>
                                            <div class="text-muted small">budi@gmail.com</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-light text-dark border-0 shadow-sm">User</span>
                                        </td>
                                        <td class="align-middle">28</td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <button class="btn btn-sm btn-outline-primary">Verify Chef</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="fw-medium">Edward Louisiano</div>
                                            <div class="text-muted small">edward@gmail.com</div>
                                        </td>
                                        <td class="align-middle">
                                            <span class="badge bg-primary text-white border-0 shadow-sm">Verified Chef</span>
                                        </td>
                                        <td class="align-middle">28</td>
                                        <td class="align-middle">2023-10-20</td>
                                        <td class="align-middle">
                                            <button class="btn btn-sm btn-outline-danger">Remove Verification</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="website-settings mb-5">
                    <div class="d-flex justify-content-between mb-4">
                        <div>
                            <h3 class="fw-bold">Website Settings</h3>
                        </div>
                        <div>
                            <form class="d-flex" role="search">
                                <input class="form-control shadow-sm" type="search" placeholder="Search" aria-label="Search" style="width: 250px;">
                            </form>
                        </div>
                    </div>
                    <div class="row g-4">
                        <div class="col-12">
                            <table class="table shadow">
                                <thead>
                                    <tr>
                                        <th scope="col" class="fw-normal align-middle">Key</th>
                                        <th scope="col" class="fw-normal align-middle">Value</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <form method="POST">
                                        <tr>
                                            <td>
                                                <div class="fw-medium">Title</div>
                                            </td>
                                            <td class="align-middle">
                                                <textarea name="title" class="form-control" rows="1"><?php echo ($title); ?></textarea>
                                            </td>
                                        <tr>
                                        <tr>
                                            <td>
                                                <div class="fw-medium">Subtitle</div>
                                            </td>
                                            <td class="align-middle">
                                                <textarea name="subtitle" class="form-control" rows="1"><?php echo ($subtitle); ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="fw-medium">Footer Text</div>
                                            </td>
                                            <td class="align-middle">
                                                <textarea name="footer_text" class="form-control" rows="10"><?php echo ($footerText); ?></textarea>
                                                <div class="d-flex justify-content-end mt-3 mb-2">
                                                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                                                </div>
                                            </td>
                                        </tr>
                                    </form>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>
<?php
//require 'footer.php';
?>