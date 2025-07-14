<?php
$url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$site_title = 'Neu Cooking';
$page = basename($_SERVER['PHP_SELF'], ".php");
$base_url = 'https://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['SCRIPT_NAME']) . '/';
?>

<?php
$roleColors = [
    'Developer'     => 'linear-gradient(45deg, #FFD700, #FFA500)',
    'Admin'         => '#DC2626',
    'Verified Chef' => '#10B981',
];
$user = [ 
    'name' => 'Galvin',
    'role' => 'Developer', 
];
?>

<?php
require __DIR__ . '/../admin/config.php';

$query = "SELECT setting_key, setting_value FROM db_website_settings WHERE setting_key IN (
    'footer_text',
    'title'
)";

$result = $conn->query($query);
$settings = [];
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$footerText = $settings['footer_text'];
$title = $settings['title'];
?>

<!doctype html>
<html lang="en">
<head>  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $site_title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <style> <?php include 'css/style.css'; ?> </style>
</head>