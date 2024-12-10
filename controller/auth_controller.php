<?php
require_once '../model/user.php';
require_once '../controller/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $user = new User($conn); 
    $login_result = $user->login($username, $password);

    if ($login_result === "success") {
        // Login berhasil, tidak perlu tindakan di sini
    } elseif ($login_result === "invalid_password") {
        echo "<script>alert('Password yang anda masukkan salah!'); window.location.href='/technorules/login';</script>";
    } elseif ($login_result === "invalid_username") {
        echo "<script>alert('Username yang anda masukkan salah!'); window.location.href='/technorules/login';</script>";
    } elseif ($login_result === "empty_fields") {
        echo "<script>alert('Masukkan username dan password terlebih dahulu!'); window.location.href='/technorules/login';</script>";
    } else {
        header("Location: /technorules/login"); 
    }
}
?>