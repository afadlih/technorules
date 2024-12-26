<?php

require_once "./controller/connection.php";
require_once "./model/dosen.php";
require_once "./model/admin.php";

$dosen = new Admin($conn);
$dataPelanggaran = $dosen->getViolations();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deskripsi_pelanggaran = htmlspecialchars($_POST['deskripsi_pelanggaran']);
    $tingkat_pelanggaran = htmlspecialchars($_POST['tingkat_pelanggaran']);
    
    $data = [
        'deskripsi_pelanggaran' => $deskripsi_pelanggaran,
        'tingkat_pelanggaran' => $tingkat_pelanggaran,
        'id_admin' => 1, // Default admin ID
        'id_mahasiswa' => $nim
    ];

    if($dosen->manageViolations($id_pelanggaran, $data)) {
        header("Location: views/dosen/pelaporan.php?status=success");
        exit();
    } else {
        header("Location: views/dosen/pelaporan.php?status=error");
        exit();
    }
}

?>