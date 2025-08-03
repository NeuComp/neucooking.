<?php
require_once '../config/database.php';
require_once '../models/Recipe.php';

header('Content-Type: application/json');

$database = new Database();
$db = $database->getConnection();
$recipe = new Recipe($db);

$search_term = $_GET['q'] ?? '';
$category_ids = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
$limit = (int)($_GET['limit'] ?? 20);
$offset = (int)($_GET['offset'] ?? 0);

$results = $recipe->searchRecipes($search_term, $category_ids, $limit, $offset);
echo json_encode(['success' => true, 'data' => $results]);
?>