<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../../model/dosen.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $method = $_GET['method'] ?? 'default';
    $dosen = new Dosen($conn);
    
    switch ($method) {
        case 'update':
            $deskripsi_pelanggaran = htmlspecialchars($_POST['deskripsi_pelanggaran']);
            $id_pelanggaran = $_POST['id_pelanggaran'] ?? null;
            
            if ($id_pelanggaran && $dosen->updatePelanggaran($id_pelanggaran, $deskripsi_pelanggaran)) {
                header("Location: /technorules/dpa/pelanggaran?status=success&message=Data berhasil diupdate");
            } else {
                header("Location: /technorules/dpa/pelanggaran?status=error&message=Gagal mengupdate data");
            }
            break;

        case 'add':
            $id_mahasiswa = htmlspecialchars($_POST['nim']);
            $deskripsi_pelanggaran = htmlspecialchars($_POST['deskripsi_pelanggaran']);
            $id_rules = htmlspecialchars($_POST['tingkat_pelanggaran']);
            $id_admin = 1; // Default admin ID
            
            if ($dosen->addPelanggaran($id_mahasiswa, $_SESSION['dosen_id'], $deskripsi_pelanggaran, $id_rules, $id_admin)) {
                header("Location: /technorules/dpa/form?status=success&message=Data berhasil ditambahkan");
            } else {
                header("Location: /technorules/dpa/form?status=error&message=Gagal menambahkan data");
            }
            break;

        case 'delete':
            $id_pelanggaran = $_POST['id_pelanggaran'] ?? null;
            
            if ($id_pelanggaran && $dosen->deletePelanggaran($id_pelanggaran)) {
                header("Location: /technorules/dpa/form?status=success&message=Data berhasil dihapus");
            } else {
                header("Location: /technorules/dpa/form?status=error&message=Gagal menghapus data");
            }
            break;

        default:
            header("Location: /technorules/dpa/form");
            break;
    }
    exit();
}

?>