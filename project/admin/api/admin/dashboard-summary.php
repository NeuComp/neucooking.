<?php 
require_once '../../config/database.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

try {
    $database = new Database();
    $db = $database->getConnection();

    // Get recipe statistics
    $recipe_stats_query = "SELECT 
                             COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending,
                             COUNT(CASE WHEN status = 'verified' THEN 1 END) as verified,
                             COUNT(CASE WHEN status = 'rejected' THEN 1 END) as rejected,
                             COUNT(*) as total_recipes
                           FROM db_recipes";
    
    $stmt = $db->prepare($recipe_stats_query);
    $stmt->execute();
    $recipe_stats = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get user statistics
    $user_stats_query = "SELECT 
                           COUNT(*) as total_users,
                           COUNT(CASE WHEN role = 'admin' THEN 1 END) as admin_users,
                           COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN 1 END) as new_users_30_days
                         FROM db_users";
    
    $stmt = $db->prepare($user_stats_query);
    $stmt->execute();
    $user_stats = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get recent activity
    $recent_activity_query = "SELECT 
                                r.recipe_id,
                                r.title,
                                r.created_at,
                                r.status,
                                u.username,
                                u.full_name
                              FROM db_recipes r
                              LEFT JOIN db_users u ON r.user_id = u.user_id
                              ORDER BY r.created_at DESC
                              LIMIT 10";
    
    $stmt = $db->prepare($recent_activity_query);
    $stmt->execute();
    $recent_recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Get popular recipes (top 5 by views)
    $popular_query = "SELECT 
                        r.recipe_id,
                        r.title,
                        r.view_count,
                        u.username,
                        COUNT(DISTINCT rr.reaction_id) as reaction_count
                      FROM db_recipes r
                      LEFT JOIN db_users u ON r.user_id = u.user_id
                      LEFT JOIN db_recipe_reactions rr ON r.recipe_id = rr.recipe_id
                      WHERE r.status = 'verified'
                      GROUP BY r.recipe_id
                      ORDER BY r.view_count DESC, reaction_count DESC
                      LIMIT 5";
    
    $stmt = $db->prepare($popular_query);
    $stmt->execute();
    $popular_recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => [
            'recipe_stats' => $recipe_stats,
            'user_stats' => $user_stats,
            'recent_recipes' => $recent_recipes,
            'popular_recipes' => $popular_recipes
        ]
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching dashboard data: ' . $e->getMessage()
    ]);
}
?>