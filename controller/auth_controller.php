<?php
require_once '../model/user.php';
require_once './connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    $user = new User($conn); 
    $login_result = $user->login($username, $password);

    if ($login_result === "success") {
        // Login berhasil, tidak perlu tindakan di sini
    } elseif ($login_result === "invalid_password") {
        header("Location: /technorules/login?status=error&message=Password yang anda masukkan salah!");
    } elseif ($login_result === "invalid_username") {
        header("Location: /technorules/login?status=error&message=Username yang anda masukkan salah!");
    } elseif ($login_result === "empty_fields") {
        header("Location: /technorules/login?status=error&message=Masukkan username dan password terlebih dahulu!");
    } else {
        header("Location: /technorules/login"); 
    }
}
?>