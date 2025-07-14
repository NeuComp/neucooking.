<?php
require __DIR__ . '/../admin/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check credentials
    $stmt = $conn->prepare("SELECT id, password FROM db_users WHERE email = 'admin@gmail.com'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashedPassword);
        $stmt->fetch();
        if (password_verify($password, $hashedPassword)) {
            $_SESSION['2'] = $id;
            header("Location: admin/dashboard.php");
            exit();
        } else {
            header("Location: index.php?error=wrongpassword");
        }
    } else {
        header("Location: index.php?error=nouser");
    }

    $stmt->close();
}
?>