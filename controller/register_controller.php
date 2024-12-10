<?php
require_once '../model/user.php';
require_once '../controller/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        header("Location: technorules/register?error=password_mismatch");
        exit();
    }

    $user = new User($conn);

    $result = $user->registerStudent($full_name, $username, $password);

    if ($result === "success") {
        header("Location: /technorules.login?success=registration_successful");
    } else {
        header("Location: /technorules/register?error=" . $result);
    }
}
