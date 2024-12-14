<?php
session_start();
require_once './model/mahasiswa.php';
require_once './controller/connection.php';

// Memastikan pengguna sudah login dan memiliki sesi mahasiswa_id
if (!isset($_SESSION['mahasiswa_id'])) {
    header("Location: /technorules/login");
    exit();
}

$mahasiswa_id = $_SESSION['mahasiswa_id'];
$mahasiswa = new Mahasiswa($conn);
$profile = $mahasiswa->getProfile($mahasiswa_id);
$violations = $mahasiswa->getViolations($_SESSION['mahasiswa_id']);
?>