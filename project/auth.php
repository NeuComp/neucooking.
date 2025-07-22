<?php
session_start();

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// // Check user role
// function hasRole($role) {
//     return isset($_SESSION['role']) && $_SESSION['role'] === $role;
// }

// // Check multiple roles
// function hasAnyRole($roles) {
//     return isset($_SESSION['role']) && in_array($_SESSION['role'], $roles);
// }

// // Check if user is admin
// function isAdmin() {
//     return hasRole('admin');
// }

// // Check if user is regular user
// function isUser() {
//     return hasRole('user');
// }

// // Get current user's information
// function getCurrentUser() {
//     if (!isLoggedIn()) {
//         return null;
//     }

//     return [
//         'id' => $_SESSION['user_id'] ?? null,
//         'role' => $_SESSION['role'] ?? null,
//         'email' => $_SESSION['email'] ?? null,
//         'first_name' => $_SESSION['first_name'] ?? null,
//         'last_name' => $_SESSION['last_name'] ?? null,
//         'username' => $_SESSION['username'] ?? null
//     ];
// }

// // Get user's display name
// function getUserDisplayName() {
//     if (!isLoggedIn()) {
//         return null;
//     }

//     return $_SESSION['username'] ?? $_SESSION['first_name'] ?? $_SESSION['email'];
// }

// // Redirect if not logged in
// function requireLogin($redirect_to = 'login.php') {
//     if (!isLoggedIn()) {
//         header("Location: " . $redirect_to);
//         exit();
//     }
// }

// // Redirect if not admin
// function requireAdmin($redirect_to = 'index.php') {
//     if (!isAdmin()) {
//         header("Location: " . $redirect_to);
//         exit();
//     }
// }

// // Redirect if user doesn't have required role
// function requireRole($required_role, $redirect_to = 'index.php') {
//     if (!hasRole($required_role)) {
//         header("Location: " . $redirect_to);
//         exit();
//     }
// }
?>