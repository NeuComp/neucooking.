<?php
session_start();

// require 'config.php';

$domain = 'https://galvin.my.id/project/';
$baseUrl = $domain;
$baseUrlAdmin = $baseUrl.'admin/';
$baseUrlThumbnail = $baseUrl.'images/';
$loginUrl = $baseUrlAdmin.'login.php';


if (!isset($_SESSION['admin_username'])) {
    echo "<script type='text/javascript'>
        window.location.href = '$loginUrl';
    </script>";
    exit();
}

echo $baseUrlAdmin;