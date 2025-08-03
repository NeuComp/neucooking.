<?php 
require_once '../config/database.php';
require_once '../models/Recipe.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database();
    $db = $database->getConnection();
    $recipe = new Recipe($db);

    // Handle file upload
    $photo_path = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $upload_dir = '../uploads/recipes/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $file_extension;
        $photo_path = $upload_dir . $filename;
        
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path)) {
            echo json_encode(['success' => false, 'message' => 'Failed to upload photo']);
            exit;
        }
        $photo_path = 'uploads/recipes/' . $filename; // Store relative path
    }

    $data = [
        'user_id' => $_POST['user_id'],
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'photo' => $photo_path,
        'portions' => (int)$_POST['portions'],
        'cooking_time_minutes' => (int)$_POST['cooking_time_minutes'],
        'categories' => json_decode($_POST['categories'], true),
        'ingredients' => json_decode($_POST['ingredients'], true),
        'steps' => json_decode($_POST['steps'], true)
    ];

    $result = $recipe->create($data);
    echo json_encode($result);
} else {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}
?>