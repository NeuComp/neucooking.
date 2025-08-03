<?php
require_once '../config/database.php';
require_once '../models/Recipe.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $recipe = new Recipe($db);

    $input = json_decode(file_get_contents('php://input'), true);
    
    $result = $recipe->verifyRecipe(
        $input['recipe_id'],
        $input['admin_id'],
        $input['action'], // 'verified' or 'rejected'
        $input['note'] ?? null
    );
    
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>