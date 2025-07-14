<?php

session_start();
require_once 'koneksi.php';

if (isset($_POST['register'])) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $checkEmail = $conn->query("SELECT user_email FROM db_users WHERE user_email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO db_users (first_name, last_name, user_email, user_password) VALUES ('$firstName', '$lastName', '$email', '$password')");
    }

    header("Location: /parts/login-register-form.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM db_users WHERE user_email = '$email'");
    if ($result->num_rows > 0) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['name'] = $user['firstName'];
            $_SESSION['email'] = $user['email'];
            if ($user['role'] === 'developer') {
                header("Location: /admin/index.html");
            } elseif ($user['role'] === 'admin') {
                header("Location: /admin/index.html");
            } else {
                header("Location: index.php");
            }
            exit();
        }
    }

    $_SESSION['login_error'] = 'Incorrect email or password';
    $_SESSION['active_form'] = 'login';
    header("Location: /parts/login-register-form.php");
    exit();
}

?>