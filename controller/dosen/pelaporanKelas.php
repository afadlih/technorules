<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../../model/dosen.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deskripsi_pelanggaran = htmlspecialchars($_POST['deskripsi_pelanggaran']);
    $id_pelanggaran = $_POST['id_pelanggaran'] ?? null;
    
    $method = $_GET['method'] ?? 'default';
    $dosen = new Dosen($conn);
    
    switch ($method) {
        case 'update':
            if ($id_pelanggaran && $dosen->updatePelanggaranKelas($id_pelanggaran, $deskripsi_pelanggaran)) {
                unset($_SESSION['dataKelas']);
                header("Location: /technorules/dpa/class?status=success&message=Data berhasil diupdate");
            } else {
                header("Location: /technorules/dpa/class?status=error&message=Gagal mengupdate data");
            }
            break;

        case 'delete':
            if ($id_pelanggaran && $dosen->deletePelanggaranKelas($id_pelanggaran)) {
                unset($_SESSION['dataKelas']);
                header("Location: /technorules/dpa/class?status=success&message=Data berhasil dihapus");
            } else {
                header("Location: /technorules/dpa/class?status=error&message=Gagal menghapus data");
            }
            break;

        default:
            header("Location: /technorules/dpa/class");
            break;
    }
    exit();
}

?>