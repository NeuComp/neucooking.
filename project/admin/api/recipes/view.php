<?php
require_once '../config/database.php';
require_once '../models/Recipe.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $database = new Database();
    $db = $database->getConnection();
    $recipe = new Recipe($db);

    $recipe_id = $_GET['id'];
    $user_id = $_GET['user_id'] ?? null;
    
    // Record view
    $recipe->recordView($recipe_id, $user_id, $_SERVER['REMOTE_ADDR']);
    
    // Get recipe details
    $recipe_data = $recipe->getRecipeDetails($recipe_id);
    
    if ($recipe_data) {
        echo json_encode(['success' => true, 'data' => $recipe_data]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Recipe not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>