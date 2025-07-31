<?php
require_once 'config.php';

session_start();

$domain = 'https://galvin.my.id/project/';
$baseUrl = $domain;
$homeUrl = $baseUrl.'index.php';
$loginUrl = $baseUrl.'login.php';
$baseUrlAdmin = $baseUrl.'admin/';
$baseUrlThumbnail = $baseUrl.'images/';
$site_title = 'Neu Cooking | Admin Dashboard';

if (!isset($_SESSION['logged_in']) && $_SESSION['logged_in'] !== true) {
    echo "<script type='text/javascript'>
        window.location.href = '$loginUrl';
    </script>";
    exit();
}

if (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'developer')) {
    echo "<script type='text/javascript'>
        window.location.href = '$homeUrl';
    </script>";
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $site_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        :root {
            --bg-dark: #1a1d29;
            --sidebar-bg: #2d3142;
            --card-bg: #2a2d3a;
            --text-light: #e9ecef;
            --border-color: #495057;
            --primary-color: #4f46e5;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
        }
        
        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
        }
        
        .sidebar {
            background: linear-gradient(135deg, var(--sidebar-bg) 0%, #363a52 100%);
            min-height: 100vh;
            box-shadow: 2px 0 10px rgba(0,0,0,0.3);
        }
        
        .sidebar .nav-link {
            color: var(--text-light);
            border-radius: 8px;
            margin: 2px 0;
        }
        
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: var(--primary-color);
        }
        
        .main-content {
            background-color: var(--bg-dark);
            min-height: 100vh;
        }
        
        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
        }
        
        .table-dark {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
        }
        
        .btn-outline-light {
            border-color: var(--border-color);
        }
        
        .form-control, .form-select {
            background-color: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-light);
        }
        
        .form-control:focus, .form-select:focus {
            background-color: var(--card-bg);
            border-color: var(--primary-color);
            color: var(--text-light);
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
        }
        
        .modal-content {
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
        }
        
        .badge-user { background-color: var(--info-color); }
        .badge-chef { background-color: var(--warning-color); }
        .badge-pending { background-color: var(--warning-color); }
        .badge-approved { background-color: var(--success-color); }
        .badge-rejected { background-color: var(--danger-color); }
        
        .activity-item {
            border-left: 3px solid var(--primary-color);
            padding-left: 15px;
            margin-bottom: 15px;
        }
        
        .stats-icon {
            font-size: 2.5rem;
            opacity: 0.7;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <a href="" class="text-decoration-none"><h4 class="text-light">neucooking.</h4></a>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" onclick="showSection('dashboard')">
                                <i class="bi bi-speedometer2 me-2"></i> Dashboard Overview
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('pending')">
                                <i class="bi bi-clock-fill me-2"></i> Pending Recipes
                                <span class="badge bg-warning ms-2">12</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('recipes')">
                                <i class="bi bi-journal-bookmark-fill me-2"></i> Recipe Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('roles')">
                                <i class="bi bi-people-fill me-2"></i> Role Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('reports')">
                                <i class="bi bi-flag-fill me-2"></i> Reports
                                <span class="badge bg-danger ms-2">5</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="showSection('settings')">
                                <i class="bi bi-gear-fill me-2"></i> Website Settings
                            </a>
                        </li>
                        <hr>
                        <li class="nav-item">
                            <div class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
                                <i class="bi bi-person-fill me-2"></i> Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a href="../profile.php" class="dropdown-item"><i class="bi bi-person-circle me-2"></i> Profile</a></li>
                                <li><a href="../logout.php" class="dropdown-item"><i class="bi bi-box-arrow-right me-2"></i> Log Out</a></li>
                            </ul>
                        </div>
                        </li>
                        
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div id="dashboard-section" class="content-section">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard Overview</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-light px-3">Refresh</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Recipes</div>
                                            <div class="h5 mb-0 font-weight-bold">156</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-journal-text stats-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Review</div>
                                            <div class="h5 mb-0 font-weight-bold">12</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-clock-history stats-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Users</div>
                                            <div class="h5 mb-0 font-weight-bold">2,847</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-people stats-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="card stat-card text-white" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-uppercase mb-1">Verified Chefs</div>
                                            <div class="h5 mb-0 font-weight-bold">43</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-award stats-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card stat-card text-white">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i> Recent Activities</h5>
                                </div>
                                <div class="card-body">
                                    <div class="activity-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <i class="bi bi-person-check-fill text-success me-2"></i>
                                                <strong>Budi Siregar</strong> has been verified as Verified Chef
                                            </div>
                                            <small>2 minutes ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                                Recipe <strong>Ayam Goreng</strong> submitted by Galvin has been approved
                                            </div>
                                            <small>2 hours ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <i class="bi bi-hourglass-split text-warning me-2"></i>
                                                Recipe <strong>Nasi Gudeg</strong> submitted by Sarah is waiting for review
                                            </div>
                                            <small>5 hours ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <i class="bi bi-person-plus-fill text-info me-2"></i>
                                                New user <strong>Ahmad Rizki</strong> registered
                                            </div>
                                            <small>1 day ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="col-lg-4">
                            <div class="card stat-card text-white">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-bar-chart-line-fill me-2"></i> Quick Stats</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Today's Submissions</span>
                                        <strong>8</strong>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-success" style="width: 75%"></div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Approval Rate</span>
                                        <strong>85%</strong>
                                    </div>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-info" style="width: 85%"></div>
                                    </div>
                                    
                                    <div class="d-flex justify-content-between mb-3">
                                        <span>Active Chefs</span>
                                        <strong>32</strong>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-warning" style="width: 60%"></div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>

                <!-- Pending Recipes Section -->
                <div id="pending-section" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Pending Recipes</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-light">Export</button>
                                <button type="button" class="btn btn-sm btn-primary">Bulk Actions</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Search recipes..." id="pendingSearch">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>All Categories</option>
                                <option>Main Course</option>
                                <option>Dessert</option>
                                <option>Appetizer</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Sort by Date</option>
                                <option>Sort by Name</option>
                                <option>Sort by Author</option>
                            </select>
                        </div>
                    </div>

                    <div class="card stat-card">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="form-check-input"></th>
                                        <th>Recipe Name</th>
                                        <th>Cook Time</th>
                                        <th>Portions</th>
                                        <th>Author</th>
                                        <th>Submitted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td><strong>Nasi Gudeg Yogyakarta</strong></td>
                                        <td>2 hours</td>
                                        <td>4 servings</td>
                                        <td>Sarah <span class="badge badge-user">User</span></td>
                                        <td>2025-07-28</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="viewRecipe(1)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success me-1" onclick="approveRecipe(1)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="rejectRecipe(1)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td><strong>Rendang Padang</strong></td>
                                        <td>3 hours</td>
                                        <td>6 servings</td>
                                        <td>Ahmad <span class="badge badge-chef">Verified Chef</span></td>
                                        <td>2025-07-27</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="viewRecipe(2)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success me-1" onclick="approveRecipe(2)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="rejectRecipe(2)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td><strong>Sate Ayam Madura</strong></td>
                                        <td>45 minutes</td>
                                        <td>3 servings</td>
                                        <td>Budi <span class="badge badge-chef">Verified Chef</span></td>
                                        <td>2025-07-26</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="viewRecipe(3)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success me-1" onclick="approveRecipe(3)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="rejectRecipe(3)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <nav class="mt-3">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>

                <!-- Recipe Management Section -->
                <div id="recipes-section" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Recipe Management</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-light">Export</button>
                                <button type="button" class="btn btn-sm btn-success">Add Recipe</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Search recipes...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>All Categories</option>
                                <option>Main Course</option>
                                <option>Dessert</option>
                                <option>Appetizer</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>All Authors</option>
                                <option>Verified Chefs Only</option>
                                <option>Regular Users</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select">
                                <option>Sort by Date</option>
                                <option>Sort by Name</option>
                                <option>Sort by Rating</option>
                            </select>
                        </div>
                    </div>

                    <div class="card stat-card">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>Recipe Name</th>
                                        <th>Cook Time</th>
                                        <th>Portions</th>
                                        <th>Author</th>
                                        <th>Approved Date</th>
                                        <th>Rating</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Ayam Goreng Kremes</strong></td>
                                        <td>1 hour</td>
                                        <td>4 servings</td>
                                        <td>Galvin <span class="badge badge-chef">Verified Chef</span></td>
                                        <td>2025-07-25</td>
                                        <td>
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                4.5
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="viewRecipe(1)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning me-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteRecipe(1)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Gado-Gado Jakarta</strong></td>
                                        <td>30 minutes</td>
                                        <td>2 servings</td>
                                        <td>Sari <span class="badge badge-user">User</span></td>
                                        <td>2025-07-24</td>
                                        <td>
                                            <div class="text-warning">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                4.0
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="viewRecipe(2)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning me-1">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" onclick="deleteRecipe(2)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Role Management Section -->
                <div id="roles-section" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Role Management</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-light">Export Users</button>
                                <button type="button" class="btn btn-sm btn-success">Bulk Verify</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Search by name or email...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>All Status</option>
                                <option>Users Only</option>
                                <option>Verified Chefs Only</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>Sort by Join Date</option>
                                <option>Sort by Name</option>
                                <option>Sort by Recipes Count</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-light w-100">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                        </div>
                    </div>

                    <div class="card stat-card">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="form-check-input"></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Recipes</th>
                                        <th>Join Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td><strong>Budi Siregar</strong></td>
                                        <td>budi.siregar@email.com</td>
                                        <td><span class="badge badge-chef">Verified Chef</span></td>
                                        <td>15</td>
                                        <td>2024-01-15</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning me-1" onclick="removeVerification(1)">
                                                <i class="fas fa-user-minus"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td><strong>Sarah Wijaya</strong></td>
                                        <td>sarah.wijaya@email.com</td>
                                        <td><span class="badge badge-user">User</span></td>
                                        <td>3</td>
                                        <td>2024-03-22</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success me-1" onclick="verifyUser(2)">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input"></td>
                                        <td><strong>Ahmad Rizki</strong></td>
                                        <td>ahmad.rizki@email.com</td>
                                        <td><span class="badge badge-user">User</span></td>
                                        <td>1</td>
                                        <td>2025-07-27</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success me-1" onclick="verifyUser(3)">
                                                <i class="fas fa-user-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fas fa-ban"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Reports Section -->
                <div id="reports-section" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Reports Management</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-outline-light">Export Reports</button>
                                <button type="button" class="btn btn-sm btn-danger">Bulk Actions</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card stat-card text-center">
                                <div class="card-body">
                                    <h3 class="text-danger">12</h3>
                                    <p class="mb-0">Recipe Reports</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card text-center">
                                <div class="card-body">
                                    <h3 class="text-warning">8</h3>
                                    <p class="mb-0">User Reports</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card text-center">
                                <div class="card-body">
                                    <h3 class="text-info">5</h3>
                                    <p class="mb-0">Spam Reports</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card stat-card text-center">
                                <div class="card-body">
                                    <h3 class="text-success">3</h3>
                                    <p class="mb-0">Resolved Today</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" placeholder="Search reports...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>All Report Types</option>
                                <option>Recipe Reports</option>
                                <option>User Reports</option>
                                <option>Spam Reports</option>
                                <option>Violence Content</option>
                                <option>Copyright Issues</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option>All Status</option>
                                <option>Pending</option>
                                <option>Under Review</option>
                                <option>Resolved</option>
                                <option>Dismissed</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select">
                                <option>Latest First</option>
                                <option>Oldest First</option>
                                <option>Priority</option>
                            </select>
                        </div>
                    </div>

                    <div class="card stat-card">
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>Report ID</th>
                                        <th>Type</th>
                                        <th>Target</th>
                                        <th>Reporter</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#RPT001</td>
                                        <td><span class="badge bg-danger">Recipe</span></td>
                                        <td>Spicy Noodles Recipe</td>
                                        <td>user123@email.com</td>
                                        <td>Inappropriate content</td>
                                        <td><span class="badge badge-pending">Pending</span></td>
                                        <td>2025-07-28</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="viewReport(1)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success me-1" onclick="resolveReport(1)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" onclick="dismissReport(1)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#RPT002</td>
                                        <td><span class="badge bg-warning">User</span></td>
                                        <td>chef_violator</td>
                                        <td>reporter@email.com</td>
                                        <td>Spam behavior</td>
                                        <td><span class="badge bg-info">Under Review</span></td>
                                        <td>2025-07-27</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="viewReport(2)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success me-1" onclick="resolveReport(2)">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-warning" onclick="dismissReport(2)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#RPT003</td>
                                        <td><span class="badge bg-danger">Recipe</span></td>
                                        <td>Dangerous Cooking Method</td>
                                        <td>safety@email.com</td>
                                        <td>Safety concerns</td>
                                        <td><span class="badge badge-approved">Resolved</span></td>
                                        <td>2025-07-26</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info me-1" onclick="viewReport(3)">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-secondary" disabled>
                                                <i class="fas fa-archive"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Website Settings Section -->
                <div id="settings-section" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Website Settings</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group me-2">
                                <button type="button" class="btn btn-sm btn-success" onclick="saveSettings()">Save All Changes</button>
                                <button type="button" class="btn btn-sm btn-outline-light">Reset to Default</button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- General Settings -->
                        <div class="col-lg-6">
                            <div class="card stat-card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-cog me-2"></i> General Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Website Title</label>
                                        <input type="text" class="form-control" value="Recipe Master - Indonesian Cuisine">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Website Description</label>
                                        <textarea class="form-control" rows="3">Discover and share authentic Indonesian recipes with our community of passionate cooks and verified chefs.</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Contact Email</label>
                                        <input type="email" class="form-control" value="admin@recipemaster.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Footer Text</label>
                                        <input type="text" class="form-control" value="© 2025 Recipe Master. All rights reserved.">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Time Zone</label>
                                        <select class="form-select">
                                            <option>Asia/Jakarta (GMT+7)</option>
                                            <option>Asia/Makassar (GMT+8)</option>
                                            <option>Asia/Jayapura (GMT+9)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Feature Settings -->
                            <div class="card stat-card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-toggle-on me-2"></i> Feature Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="userRegistration" checked>
                                        <label class="form-check-label" for="userRegistration">
                                            Allow User Registration
                                        </label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="recipeSubmission" checked>
                                        <label class="form-check-label" for="recipeSubmission">
                                            Allow Recipe Submissions
                                        </label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="comments" checked>
                                        <label class="form-check-label" for="comments">
                                            Enable Comments
                                        </label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="ratings" checked>
                                        <label class="form-check-label" for="ratings">
                                            Enable Recipe Ratings
                                        </label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="newsletter">
                                        <label class="form-check-label" for="newsletter">
                                            Newsletter Subscription
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security & Maintenance -->
                        <div class="col-lg-6">
                            <div class="card stat-card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i> Security Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Max Recipe Submissions per Day</label>
                                        <input type="number" class="form-control" value="5">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Auto-approve recipes from Verified Chefs</label>
                                        <select class="form-select">
                                            <option>Disabled</option>
                                            <option selected>Enabled</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Content Moderation Level</label>
                                        <select class="form-select">
                                            <option>Low</option>
                                            <option selected>Medium</option>
                                            <option>High</option>
                                            <option>Strict</option>
                                        </select>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="twoFactorAuth">
                                        <label class="form-check-label" for="twoFactorAuth">
                                            Require 2FA for Admin Accounts
                                        </label>
                                    </div>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="loginAttempts" checked>
                                        <label class="form-check-label" for="loginAttempts">
                                            Limit Login Attempts
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Maintenance Mode -->
                            <div class="card stat-card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-tools me-2"></i> Maintenance Mode</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="maintenanceMode">
                                        <label class="form-check-label" for="maintenanceMode">
                                            Enable Maintenance Mode
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Maintenance Message</label>
                                        <textarea class="form-control" rows="3">We're currently performing scheduled maintenance. We'll be back shortly!</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Estimated Completion Time</label>
                                        <input type="datetime-local" class="form-control">
                                    </div>
                                    <div class="alert alert-warning">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Enabling maintenance mode will make the website inaccessible to regular users.
                                    </div>
                                    <button class="btn btn-warning btn-sm" onclick="toggleMaintenance()">
                                        <i class="fas fa-power-off me-1"></i> Toggle Maintenance
                                    </button>
                                </div>
                            </div>

                            <!-- System Information -->
                            <div class="card stat-card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i> System Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-2">
                                        <div class="col-6">System Version:</div>
                                        <div class="col-6"><strong>v2.1.3</strong></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6">Database Size:</div>
                                        <div class="col-6"><strong>245 MB</strong></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6">Media Storage:</div>
                                        <div class="col-6"><strong>1.2 GB</strong></div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-6">Last Backup:</div>
                                        <div class="col-6"><strong>2025-07-28 02:00</strong></div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-6">Server Status:</div>
                                        <div class="col-6">
                                            <span class="badge bg-success">Online</span>
                                        </div>
                                    </div>
                                    <button class="btn btn-outline-info btn-sm me-2">
                                        <i class="fas fa-download me-1"></i> Backup Now
                                    </button>
                                    <button class="btn btn-outline-warning btn-sm">
                                        <i class="fas fa-sync me-1"></i> Clear Cache
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Recipe View Modal -->
    <div class="modal fade" id="recipeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recipe Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://via.placeholder.com/300x200/2a2d3a/ffffff?text=Recipe+Image" class="img-fluid rounded mb-3" alt="Recipe">
                        </div>
                        <div class="col-md-6">
                            <h4 id="recipe-title">Nasi Gudeg Yogyakarta</h4>
                            <p><strong>Author:</strong> <span id="recipe-author">Sarah</span></p>
                            <p><strong>Cook Time:</strong> <span id="recipe-time">2 hours</span></p>
                            <p><strong>Servings:</strong> <span id="recipe-servings">4 servings</span></p>
                            <p><strong>Category:</strong> <span id="recipe-category">Main Course</span></p>
                            <p><strong>Difficulty:</strong> <span id="recipe-difficulty">Medium</span></p>
                        </div>
                    </div>
                    <hr>
                    <h5>Ingredients:</h5>
                    <ul id="recipe-ingredients">
                        <li>500g young jackfruit</li>
                        <li>200ml coconut milk</li>
                        <li>2 bay leaves</li>
                        <li>1 tsp salt</li>
                        <li>2 tbsp palm sugar</li>
                    </ul>
                    <h5>Instructions:</h5>
                    <ol id="recipe-instructions">
                        <li>Clean and cut the young jackfruit into pieces</li>
                        <li>Boil with coconut milk and spices</li>
                        <li>Simmer for 2 hours until tender</li>
                        <li>Serve with rice and side dishes</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" onclick="approveRecipe()">
                        <i class="fas fa-check me-1"></i> Approve
                    </button>
                    <button type="button" class="btn btn-danger" onclick="rejectRecipe()">
                        <i class="fas fa-times me-1"></i> Reject
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Global variables
        let currentSection = 'dashboard';

        // Navigation functions
        function showSection(sectionName) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Show selected section
            document.getElementById(sectionName + '-section').style.display = 'block';
            
            // Update navigation
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.classList.add('active');
            
            currentSection = sectionName;
        }

        // Recipe management functions
        function viewRecipe(id) {
            const modal = new bootstrap.Modal(document.getElementById('recipeModal'));
            modal.show();
        }

        function approveRecipe(id) {
            if (confirm('Are you sure you want to approve this recipe?')) {
                // Simulate API call
                setTimeout(() => {
                    alert('Recipe approved successfully!');
                    // Remove from pending list or update status
                }, 500);
            }
        }

        function rejectRecipe(id) {
            const reason = prompt('Please provide a reason for rejection:');
            if (reason) {
                // Simulate API call
                setTimeout(() => {
                    alert('Recipe rejected successfully!');
                    // Remove from pending list or update status
                }, 500);
            }
        }

        function deleteRecipe(id) {
            if (confirm('Are you sure you want to delete this recipe? This action cannot be undone.')) {
                // Simulate API call
                setTimeout(() => {
                    alert('Recipe deleted successfully!');
                    // Remove from list
                }, 500);
            }
        }

        // User management functions
        function verifyUser(id) {
            if (confirm('Are you sure you want to verify this user as a chef?')) {
                // Simulate API call
                setTimeout(() => {
                    alert('User verified successfully!');
                    // Update user status
                }, 500);
            }
        }

        function removeVerification(id) {
            if (confirm('Are you sure you want to remove chef verification from this user?')) {
                // Simulate API call
                setTimeout(() => {
                    alert('Verification removed successfully!');
                    // Update user status
                }, 500);
            }
        }

        // Report management functions
        function viewReport(id) {
            alert('Viewing report details for report #' + id);
            // Implement report detail view
        }

        function resolveReport(id) {
            if (confirm('Mark this report as resolved?')) {
                // Simulate API call
                setTimeout(() => {
                    alert('Report resolved successfully!');
                    // Update report status
                }, 500);
            }
        }

        function dismissReport(id) {
            if (confirm('Dismiss this report?')) {
                // Simulate API call
                setTimeout(() => {
                    alert('Report dismissed successfully!');
                    // Update report status
                }, 500);
            }
        }

        // Settings functions
        function saveSettings() {
            // Simulate saving settings
            setTimeout(() => {
                alert('Settings saved successfully!');
            }, 500);
        }

        function toggleMaintenance() {
            const isEnabled = document.getElementById('maintenanceMode').checked;
            if (confirm(isEnabled ? 'Enable maintenance mode?' : 'Disable maintenance mode?')) {
                // Simulate API call
                setTimeout(() => {
                    alert('Maintenance mode ' + (isEnabled ? 'enabled' : 'disabled') + ' successfully!');
                }, 500);
            }
        }

        // Search functionality
        document.getElementById('pendingSearch')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // Implement search functionality
            console.log('Searching for:', searchTerm);
        });

        // Initialize tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        // Simulate real-time updates
        setInterval(function() {
            // Update timestamps, counts, etc.
            // This would normally come from WebSocket or periodic API calls
        }, 30000);
    </script>
</body>
</html>