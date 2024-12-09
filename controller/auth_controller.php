<?php
require_once '../model/user.php';
require_once '../controller/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($conn); 
    $login_result = $user->login($username, $password);

    if ($login_result === "success") {
        // Login berhasil, tidak perlu tindakan di sini
    } elseif ($login_result === "invalid_password") {
        header("Location: ../views/login.php?error=invalid_password"); 
    } elseif ($login_result === "invalid_username") {
        header("Location: ../views/login.php?error=invalid_username"); 
    } elseif ($login_result === "empty_fields") {
        header("Location: ../views/login.php?error=empty_fields"); 
    } else {
        header("Location: ../views/login.php?error=login_failed"); 
    }
}
?>