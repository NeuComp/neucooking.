<?php

$host = "64.235.41.175";
$user = "arinnapr_dbgalvin";
$password = "mNFOR9vQdQc}";
$database = "arinnapr_dbgalvin";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

?>