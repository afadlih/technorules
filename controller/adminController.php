<?php
session_start();
require_once './model/admin.php';
require_once './controller/connection.php';

// Memastikan pengguna sudah login dan memiliki sesi admin_id
if (!isset($_SESSION['admin_id'])) {
    header("Location: /technorules/login");
    exit();
}

$admin_id = $_SESSION['admin_id'];
$admin = new Admin($conn);
$data = $admin->getProfile($admin_id);
?>