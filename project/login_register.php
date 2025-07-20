<?php 
require_once __DIR__ . '/../admin/config.php';
session_start();

$domain = 'https://galvin.my.id/project/';
$baseUrl = $domain;

if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkEmail = $conn->query("SELECT email FROM db_users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered.';
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO db_users (first_name, last_name, email, password) VALUES ('$first_name','$last_name','$email','$password')");
    }

    header('Location: login.php');
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM db_users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];

            if ($user['role'] == 'admin') {
                header('Location: dashboard.php');
            } else {
                header('Location: index.php');
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect email or password.';
    $_SESSION['active_form'] = 'login';
    header('Location : index.php');
    exit();
}
?>