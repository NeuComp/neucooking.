<?php 
require_once '../../config/database.php';
require_once '../../models/Admin.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $admin = new Admin($db);

    $input = json_decode(file_get_contents('php://input'), true);
    $recipe_ids = $input['recipe_ids'] ?? [];
    $admin_id = $_SESSION['user_id'];

    if (empty($recipe_ids)) {
        echo json_encode(['success' => false, 'message' => 'No recipes selected']);
        exit;
    }

    $result = $admin->bulkVerifyRecipes($recipe_ids, $admin_id);
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>