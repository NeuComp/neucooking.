<?php
require 'config.php';
require 'data.php';
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #f27c1e;
            --secondary-color: #f8a86f;
            --tertiary-color: #f89c4c;
            --primary-text-color: #fff;
            --secondary-text-color: #333;
            --primary-brand-color: #653217;
            --primary-background-color: #fafbfe;
            --active-hover-color: rgba(255, 255, 255, .075);
        }

        html, body {
            height: 100%;
            margin: 0;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        h1 {
            font-weight: 600;
            font-size: 1.5rem;
        }

        p {
            font-size: 15px;
        }

        .sidebar {
            background: #f27c1e;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            color: white !important;
            background: rgba(255,255,255,0.1);
            border-radius: 8px;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .stat-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }

        .stat-card.users {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stat-card.pending {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .stat-card.chefs {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .badge-user {
            background: #6c757d;
        }

        .badge-chef {
            background: #ffc107;
            color: #000;
        }

        .content-area {
            background: #f8f9fa;
            min-height: 100vh;
        }

        .activity-item {
            border-left: 3px solid #667eea;
            padding-left: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 sidebar d-flex flex-column p-3">
                <div class="text-center mb-4">
                    <h4 class="text-white"><i class="fas fa-utensils me-2"></i>Admin Dashboard</h4>
                </div>
                <ul class="nav nav-pills flex-column flex-grow-1">
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link active" onclick="showSection('dashboard')">
                            <i class="fas fa-chart-pie me-2"></i>Dashboard Overview
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link" onclick="showSection('pending')">
                            <i class="fas fa-clock me-2"></i>Pending Recipes
                            <span class="badge bg-warning text-dark ms-2">3</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link" onclick="showSection('recipes')">
                            <i class="fas fa-book me-2"></i>Recipe Management
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link" onclick="showSection('roles')">
                            <i class="fas fa-users me-2"></i>Role Management
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link" onclick="showSection('reports')">
                            <i class="fas fa-flag me-2"></i>Reports
                            <span class="badge bg-danger ms-2">2</span>
                        </a>
                    </li>
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link" onclick="showSection('settings')">
                            <i class="fas fa-cogs me-2"></i>Website Settings
                        </a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a href="../logout.php" class="nav-link text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Log Out
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-4 content-area">
                
                <!-- Dashboard Overview -->
                <div id="dashboard" class="content-section">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Dashboard Overview</h1>
                    </div>

                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">Total Recipes</h5>
                                            <h2 class="mb-0">156</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-book fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card pending">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">Pending Review</h5>
                                            <h2 class="mb-0">12</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-clock fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card users">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">Total Users</h5>
                                            <h2 class="mb-0">2,847</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-users fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card stat-card chefs">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="card-title">Verified Chefs</h5>
                                            <h2 class="mb-0">43</h2>
                                        </div>
                                        <div class="align-self-center">
                                            <i class="fas fa-chef-hat fa-2x opacity-75"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activities -->
                    <div class="row">
                        <div class="col-lg-8 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-history me-2"></i>Recent Activities</h5>
                                </div>
                                <div class="card-body">
                                    <div class="activity-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <i class="fas fa-user-check text-success me-2"></i>
                                                User <strong>Budi Siregar</strong> has been verified as Verified Chef
                                            </div>
                                            <small class="text-muted">2 minutes ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <i class="fas fa-check-circle text-primary me-2"></i>
                                                Recipe <strong>Ayam Goreng</strong> submitted by Galvin has been approved
                                            </div>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <i class="fas fa-clock text-warning me-2"></i>
                                                Recipe <strong>Nasi Gudeg</strong> submitted by Sarah is waiting for review
                                            </div>
                                            <small class="text-muted">5 hours ago</small>
                                        </div>
                                    </div>
                                    <div class="activity-item">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <i class="fas fa-user-plus text-info me-2"></i>
                                                New user <strong>Ahmad Rizki</strong> registered
                                            </div>
                                            <small class="text-muted">1 day ago</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Quick Stats</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Today's Submissions</span>
                                            <strong>8</strong>
                                        </div>
                                        <div class="progress mt-1" style="height: 5px;">
                                            <div class="progress-bar bg-success" style="width: 70%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Approval Rate</span>
                                            <strong>85%</strong>
                                        </div>
                                        <div class="progress mt-1" style="height: 5px;">
                                            <div class="progress-bar bg-primary" style="width: 85%"></div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span>Active Chefs</span>
                                            <strong>32</strong>
                                        </div>
                                        <div class="progress mt-1" style="height: 5px;">
                                            <div class="progress-bar bg-warning" style="width: 60%"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Recipes -->
                <div id="pending" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Pending Recipes</h1>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-0">Recipe Review Queue</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search recipes..." id="pendingSearch">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
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
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/40" class="rounded me-2" alt="">
                                                    <strong>Nasi Gudeg Yogya</strong>
                                                </div>
                                            </td>
                                            <td>2 hours 30 mins</td>
                                            <td>6 servings</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    Sarah <span class="badge badge-user ms-2">User</span>
                                                </div>
                                            </td>
                                            <td>2024-01-25</td>
                                            <td>
                                                <button class="btn btn-sm btn-success me-1" onclick="approveRecipe('Nasi Gudeg Yogya')">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#viewRecipeModal">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="rejectRecipe('Nasi Gudeg Yogya')">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/40" class="rounded me-2" alt="">
                                                    <strong>Rendang Padang</strong>
                                                </div>
                                            </td>
                                            <td>4 hours</td>
                                            <td>8 servings</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    Chef Andi <span class="badge badge-chef ms-2">Verified Chef</span>
                                                </div>
                                            </td>
                                            <td>2024-01-24</td>
                                            <td>
                                                <button class="btn btn-sm btn-success me-1" onclick="approveRecipe('Rendang Padang')">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#viewRecipeModal">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="rejectRecipe('Rendang Padang')">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/40" class="rounded me-2" alt="">
                                                    <strong>Soto Betawi</strong>
                                                </div>
                                            </td>
                                            <td>1 hour 45 mins</td>
                                            <td>4 servings</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    Rini <span class="badge badge-user ms-2">User</span>
                                                </div>
                                            </td>
                                            <td>2024-01-23</td>
                                            <td>
                                                <button class="btn btn-sm btn-success me-1" onclick="approveRecipe('Soto Betawi')">
                                                    <i class="fas fa-check"></i> Approve
                                                </button>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#viewRecipeModal">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="rejectRecipe('Soto Betawi')">
                                                    <i class="fas fa-times"></i> Reject
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recipe Management -->
                <div id="recipes" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Recipe Management</h1>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-0">Approved Recipes</h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search recipes..." id="recipeSearch">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Recipe Name</th>
                                            <th>Cook Time</th>
                                            <th>Portions</th>
                                            <th>Author</th>
                                            <th>Approved</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/40" class="rounded me-2" alt="">
                                                    <strong>Ayam Goreng Kremes</strong>
                                                </div>
                                            </td>
                                            <td>45 mins</td>
                                            <td>4 servings</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    Chef Budi <span class="badge badge-chef ms-2">Verified Chef</span>
                                                </div>
                                            </td>
                                            <td>2024-01-22</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#viewRecipeModal">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteRecipe('Ayam Goreng Kremes')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="https://via.placeholder.com/40" class="rounded me-2" alt="">
                                                    <strong>Gado-Gado Jakarta</strong>
                                                </div>
                                            </td>
                                            <td>30 mins</td>
                                            <td>2 servings</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    Sari <span class="badge badge-user ms-2">User</span>
                                                </div>
                                            </td>
                                            <td>2024-01-21</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#viewRecipeModal">
                                                    <i class="fas fa-eye"></i> View
                                                </button>
                                                <button class="btn btn-sm btn-danger" onclick="deleteRecipe('Gado-Gado Jakarta')">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Role Management -->
                <div id="roles" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Role Management</h1>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5 class="mb-0">User Management</h5>
                                </div>
                                <div class="col-md-4">
                                    <select class="form-select" id="roleFilter">
                                        <option value="all">All Status</option>
                                        <option value="user">Users Only</option>
                                        <option value="chef">Verified Chefs Only</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search users..." id="userSearch">
                                        <button class="btn btn-outline-secondary" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Name & Email</th>
                                            <th>Role</th>
                                            <th>Recipes</th>
                                            <th>Join Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong>Budi Siregar</strong>
                                                    <br><small class="text-muted">budi.siregar@email.com</small>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-chef">Verified Chef</span></td>
                                            <td>12 recipes</td>
                                            <td>2023-11-15</td>
                                            <td>
                                                <button class="btn btn-sm btn-warning" onclick="removeVerification('Budi Siregar')">
                                                    <i class="fas fa-user-minus"></i> Remove Verification
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong>Sarah Mutia</strong>
                                                    <br><small class="text-muted">sarah.mutia@email.com</small>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-user">User</span></td>
                                            <td>5 recipes</td>
                                            <td>2023-12-20</td>
                                            <td>
                                                <button class="btn btn-sm btn-success" onclick="verifyUser('Sarah Mutia')">
                                                    <i class="fas fa-user-check"></i> Verify as Chef
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div>
                                                    <strong>Ahmad Rizki</strong>
                                                    <br><small class="text-muted">ahmad.rizki@email.com</small>
                                                </div>
                                            </td>
                                            <td><span class="badge badge-user">User</span></td>
                                            <td>2 recipes</td>
                                            <td>2024-01-10</td>
                                            <td>
                                                <button class="btn btn-sm btn-success" onclick="verifyUser('Ahmad Rizki')">
                                                    <i class="fas fa-user-check"></i> Verify as Chef
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Reports -->
                <div id="reports" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Reports & Content Moderation</h1>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card border-danger">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="mb-0"><i class="fas fa-flag me-2"></i>Recipe Reports</h5>
                                </div>
                                <div class="card-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>Recipe: "Spicy Noodles"</strong>
                                                <br><small class="text-muted">Reported by: User123</small>
                                                <br><span class="badge bg-warning text-dark">Inappropriate Content</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#reviewReportModal">Review</button>
                                                <button class="btn btn-sm btn-danger">Remove</button>
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0 text-muted">Contains offensive language in description</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>Recipe: "Traditional Soup"</strong>
                                                <br><small class="text-muted">Reported by: CookLover</small>
                                                <br><span class="badge bg-danger">Misleading Information</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#reviewReportModal">Review</button>
                                                <button class="btn btn-sm btn-danger">Remove</button>
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0 text-muted">Recipe contains dangerous cooking instructions</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fas fa-user-times me-2"></i>User Reports</h5>
                                </div>
                                <div class="card-body">
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>User: "BadCook99"</strong>
                                                <br><small class="text-muted">Reported by: ChefMaster</small>
                                                <br><span class="badge bg-danger">Harassment</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#reviewUserReportModal">Review</button>
                                                <button class="btn btn-sm btn-warning">Suspend</button>
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0 text-muted">Posting offensive comments on recipes</p>
                                    </div>
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <strong>User: "SpamAccount"</strong>
                                                <br><small class="text-muted">Reported by: Multiple Users</small>
                                                <br><span class="badge bg-warning text-dark">Spam</span>
                                            </div>
                                            <div>
                                                <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal" data-bs-target="#reviewUserReportModal">Review</button>
                                                <button class="btn btn-sm btn-danger">Ban</button>
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0 text-muted">Posting duplicate recipes and promotional content</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Report Statistics</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-md-3">
                                            <h3 class="text-danger">24</h3>
                                            <p class="mb-0">Total Reports This Month</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="text-warning">8</h3>
                                            <p class="mb-0">Pending Reviews</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="text-success">16</h3>
                                            <p class="mb-0">Resolved Reports</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h3 class="text-info">3</h3>
                                            <p class="mb-0">Users Suspended</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Website Settings -->
                <div id="settings" class="content-section" style="display: none;">
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Website Settings</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-globe me-2"></i>General Settings</h5>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="mb-3">
                                            <label for="siteTitle" class="form-label">Website Title</label>
                                            <input type="text" class="form-control" id="siteTitle" value="Recipe Master - Indonesian Cuisine">
                                        </div>
                                        <div class="mb-3">
                                            <label for="siteTagline" class="form-label">Tagline</label>
                                            <input type="text" class="form-control" id="siteTagline" value="Discover Authentic Indonesian Recipes">
                                        </div>
                                        <div class="mb-3">
                                            <label for="footerText" class="form-label">Footer Text</label>
                                            <textarea class="form-control" id="footerText" rows="3">© 2024 Recipe Master. All rights reserved. Preserving Indonesian culinary traditions.</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="contactEmail" class="form-label">Contact Email</label>
                                            <input type="email" class="form-control" id="contactEmail" value="admin@recipemaster.com">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-tools me-2"></i>System Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="maintenanceMode">
                                            <label class="form-check-label" for="maintenanceMode">
                                                Maintenance Mode
                                            </label>
                                        </div>
                                        <small class="text-muted">Enable to show maintenance page to visitors</small>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="userRegistration" checked>
                                            <label class="form-check-label" for="userRegistration">
                                                User Registration
                                            </label>
                                        </div>
                                        <small class="text-muted">Allow new users to register</small>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="recipeSubmission" checked>
                                            <label class="form-check-label" for="recipeSubmission">
                                                Recipe Submission
                                            </label>
                                        </div>
                                        <small class="text-muted">Allow users to submit recipes</small>
                                    </div>
                                    <div class="mb-3">
                                        <label for="maxFileSize" class="form-label">Max Upload Size (MB)</label>
                                        <input type="number" class="form-control" id="maxFileSize" value="5">
                                    </div>
                                    <button type="submit" class="btn btn-success">Update Settings</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-shield-alt me-2"></i>Security Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="sessionTimeout" class="form-label">Session Timeout (minutes)</label>
                                        <input type="number" class="form-control" id="sessionTimeout" value="30">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="twoFactorAuth">
                                            <label class="form-check-label" for="twoFactorAuth">
                                                Require 2FA for Admins
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="loginAttempts" checked>
                                            <label class="form-check-label" for="loginAttempts">
                                                Limit Login Attempts
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning">Save Security Settings</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-bell me-2"></i>Notification Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                                            <label class="form-check-label" for="emailNotifications">
                                                Email Notifications
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="newRecipeAlerts" checked>
                                            <label class="form-check-label" for="newRecipeAlerts">
                                                New Recipe Alerts
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="reportAlerts" checked>
                                            <label class="form-check-label" for="reportAlerts">
                                                Report Alerts
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="adminEmail" class="form-label">Admin Email</label>
                                        <input type="email" class="form-control" id="adminEmail" value="admin@recipemaster.com">
                                    </div>
                                    <button type="submit" class="btn btn-info">Save Notification Settings</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Recipe View Modal -->
    <div class="modal fade" id="viewRecipeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Recipe Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="https://via.placeholder.com/300x200" class="img-fluid rounded" alt="Recipe Image">
                        </div>
                        <div class="col-md-8">
                            <h4>Nasi Gudeg Yogya</h4>
                            <p><strong>Author:</strong> Sarah <span class="badge badge-user">User</span></p>
                            <p><strong>Cook Time:</strong> 2 hours 30 minutes</p>
                            <p><strong>Servings:</strong> 6 people</p>
                            <p><strong>Difficulty:</strong> Intermediate</p>
                        </div>
                    </div>
                    <hr>
                    <h6>Ingredients:</h6>
                    <ul>
                        <li>500g young jackfruit</li>
                        <li>200ml coconut milk</li>
                        <li>2 bay leaves</li>
                        <li>Palm sugar to taste</li>
                        <li>Salt to taste</li>
                    </ul>
                    <h6>Instructions:</h6>
                    <ol>
                        <li>Clean and cut the young jackfruit into pieces</li>
                        <li>Boil with coconut milk and spices</li>
                        <li>Simmer for 2 hours until tender</li>
                        <li>Serve with rice and side dishes</li>
                    </ol>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Review Modal -->
    <div class="modal fade" id="reviewReportModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Review Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6>Reported Content: "Spicy Noodles"</h6>
                    <p><strong>Report Type:</strong> Inappropriate Content</p>
                    <p><strong>Reporter:</strong> User123</p>
                    <p><strong>Report Details:</strong></p>
                    <p class="border p-3 bg-light">Contains offensive language in description and inappropriate images that don't match the recipe content.</p>
                    <div class="mt-3">
                        <label for="adminNotes" class="form-label">Admin Notes:</label>
                        <textarea class="form-control" id="adminNotes" rows="3" placeholder="Add your review notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Dismiss Report</button>
                    <button type="button" class="btn btn-warning">Issue Warning</button>
                    <button type="button" class="btn btn-danger">Remove Content</button>
                </div>
            </div>
        </div>
    </div>

    <!-- User Report Review Modal -->
    <div class="modal fade" id="reviewUserReportModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Review User Report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <h6>Reported User: "BadCook99"</h6>
                    <p><strong>Report Type:</strong> Harassment</p>
                    <p><strong>Reporter:</strong> ChefMaster</p>
                    <div class="border p-3 bg-light mb-3">
                        <strong>Evidence:</strong>
                        <p class="mb-2">"This user has been leaving offensive comments on multiple recipes, using inappropriate language and harassing other users in the comment sections."</p>
                        <small class="text-muted">Reported with screenshots attached</small>
                    </div>
                    <div class="mt-3">
                        <label for="userAdminNotes" class="form-label">Admin Notes:</label>
                        <textarea class="form-control" id="userAdminNotes" rows="3" placeholder="Add your review notes..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Dismiss Report</button>
                    <button type="button" class="btn btn-warning">Issue Warning</button>
                    <button type="button" class="btn btn-orange" style="background-color: #fd7e14; border-color: #fd7e14; color: white;">Suspend User</button>
                    <button type="button" class="btn btn-danger">Ban User</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Navigation functionality
        function showSection(sectionId) {
            // Hide all sections
            document.querySelectorAll('.content-section').forEach(section => {
                section.style.display = 'none';
            });
            
            // Show selected section
            document.getElementById(sectionId).style.display = 'block';
            
            // Update navigation
            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });
            event.target.classList.add('active');
        }

        // Recipe management functions
        function approveRecipe(recipeName) {
            if (confirm(`Are you sure you want to approve "${recipeName}"?`)) {
                alert(`Recipe "${recipeName}" has been approved successfully!`);
                // In real app, this would make an API call
            }
        }

        function rejectRecipe(recipeName) {
            if (confirm(`Are you sure you want to reject "${recipeName}"?`)) {
                alert(`Recipe "${recipeName}" has been rejected.`);
                // In real app, this would make an API call
            }
        }

        function deleteRecipe(recipeName) {
            if (confirm(`Are you sure you want to delete "${recipeName}"? This action cannot be undone.`)) {
                alert(`Recipe "${recipeName}" has been deleted.`);
                // In real app, this would make an API call
            }
        }

        // User management functions
        function verifyUser(userName) {
            if (confirm(`Are you sure you want to verify "${userName}" as a Verified Chef?`)) {
                alert(`User "${userName}" has been verified as a Verified Chef!`);
                // In real app, this would make an API call
            }
        }

        function removeVerification(userName) {
            if (confirm(`Are you sure you want to remove verification from "${userName}"?`)) {
                alert(`Verification removed from "${userName}".`);
                // In real app, this would make an API call
            }
        }

        // Search functionality
        document.getElementById('pendingSearch')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // In real app, this would filter the table rows
            console.log('Searching pending recipes for:', searchTerm);
        });

        document.getElementById('recipeSearch')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // In real app, this would filter the table rows
            console.log('Searching recipes for:', searchTerm);
        });

        document.getElementById('userSearch')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            // In real app, this would filter the table rows
            console.log('Searching users for:', searchTerm);
        });

        // Role filter functionality
        document.getElementById('roleFilter')?.addEventListener('change', function(e) {
            const filterValue = e.target.value;
            // In real app, this would filter the user table
            console.log('Filtering users by:', filterValue);
        });

        // Form submissions
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Settings saved successfully!');
            });
        });

        // Initialize tooltips and other Bootstrap components
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize any Bootstrap tooltips if needed
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>