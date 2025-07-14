<?php
$host = "localhost";
$user = "arinnapr_ugalvin";
$pass = "mNFOR9vQdQc}";
$db   = "arinnapr_dbgalvin";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>