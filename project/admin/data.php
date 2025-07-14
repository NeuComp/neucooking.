<?php 
$query = "SELECT setting_key, setting_value FROM db_website_settings WHERE setting_key IN (
    'footer_text',
    'title',
    'subtitle'
)";

$result = $conn->query($query);
$settings = [];
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$footerText = $settings['footer_text'];
$title = $settings['title'];
$subtitle = $settings['subtitle'];
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$title = $conn->real_escape_string($_POST['title']);
$subtitle = $conn->real_escape_string($_POST['subtitle']);
$footerText = $conn->real_escape_string($_POST['footer_text']);

$conn->query("UPDATE db_website_settings SET setting_value = '$title' WHERE setting_key = 'title'");
$conn->query("UPDATE db_website_settings SET setting_value = '$subtitle' WHERE setting_key = 'subtitle'");
$conn->query("UPDATE db_website_settings SET setting_value = '$footerText' WHERE setting_key = 'footer_text'");
}
?>