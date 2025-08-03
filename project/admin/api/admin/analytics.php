<?php 
require_once '../../config/database.php';
require_once '../../models/Admin.php';

header('Content-Type: application/json');

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$database = new Database();
$db = $database->getConnection();
$admin = new Admin($db);

$days = (int)($_GET['days'] ?? 30);
$result = $admin->getDashboardAnalytics($days);

echo json_encode($result);
?>