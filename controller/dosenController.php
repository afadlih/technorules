<?php
session_start();
require_once './controller/connection.php';
require_once './model/dosen.php';

// Memastikan pengguna sudah login dan memiliki sesi dosen_id
if (!isset($_SESSION['dosen_id'])) {
    header("Location: /technorules/login");
    exit();
}

$dosen_id = $_SESSION['dosen_id'];
$dosen = new Dosen($conn);
$data = $dosen->getDosenById($dosen_id);
?>