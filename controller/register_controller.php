<?php
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/../model/admin.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_mahasiswa = htmlspecialchars($_POST['nama_mahasiswa']);
    $username = htmlspecialchars(trim($_POST['nim']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

    if ($password !== $confirm_password) {
        header("Location: technorules/register?error=password_mismatch");
        exit();
    }

    $user = new Admin($conn);
    $result = $user->createMhs($username, $nama_mahasiswa, $status_mhs = 'A', $password);

    if ($result) {
        header("Location: /technorules/login?success=registration_successful");
    } else {
        header("Location: /technorules/register?error=" . $result);
    }
}
