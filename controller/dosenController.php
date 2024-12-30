<?php
session_start();
require_once __DIR__ . '/connection.php';
require_once __DIR__ . '/../model/dosen.php';

// Memastikan pengguna sudah login dan memiliki sesi dosen_id
if (!isset($_SESSION['dosen_id'])) {
    header("Location: /technorules/login");
    exit();
}

$dosen_id = $_SESSION['dosen_id'];
$dosen = new Dosen($conn);
$data = $dosen->getDosenById($dosen_id);
$dataPelanggaran = $dosen->getForm($_SESSION['dosen_id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kelas = htmlspecialchars($_POST['kelas']);
    $id_prodi = htmlspecialchars($_POST['id_prodi']);
    
    // Hapus data sesi yang lama
    unset($_SESSION['dataKelas']);
    
    $dataKelas = $dosen->getClass($id_prodi, $kelas);
    $_SESSION['dataKelas'] = $dataKelas;
    header("Location: /technorules/dpa/class");
    exit();
}

?>