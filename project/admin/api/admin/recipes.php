<?php 
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Check if user is admin
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    $database = new Database();
    $db = $database->getConnection();
    
    $status = $_GET['status'] ?? 'pending';
    $limit = (int)($_GET['limit'] ?? 50);
    $offset = (int)($_GET['offset'] ?? 0);
    
    $query = "SELECT r.*, u.username, u.full_name, u.profile_photo,
        av.note as admin_note, av.created_at as verified_at,
        admin_user.username as verified_by_username
        FROM db_recipes r
        LEFT JOIN db_users u ON r.user_id = u.user_id
        LEFT JOIN db_admin_verifications av ON r.recipe_id = av.recipe_id
        LEFT JOIN db_users admin_user ON av.admin_id = admin_user.user_id
        WHERE r.status = :status
        ORDER BY r.created_at DESC
        LIMIT :limit OFFSET :offset";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    
    $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'data' => $recipes
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching recipes: ' . $e->getMessage()
    ]);
}

?>