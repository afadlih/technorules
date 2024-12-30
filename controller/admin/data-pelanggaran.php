<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../../model/admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $deskripsi_pelanggaran = htmlspecialchars($_POST['deskripsi_pelanggaran']);
    $tingkat_pelanggaran = htmlspecialchars($_POST['tingkat_pelanggaran']);
    
    $method = $_GET['method'] ?? 'default';
    $violation = new Admin($conn);
    
    switch ($method) {
        case 'add':
            if ($violation->createViolation($deskripsi_pelanggaran, $tingkat_pelanggaran)) {
                header("Location: /technorules/admin/data-pelanggaran?status=success&message=Data berhasil ditambahkan");
            } else {
                header("Location: /technorules/admin/data-pelanggaran?status=error&message=Gagal menambahkan data");
            }
            break;

        case 'update':
            $id_rules = $_POST['id_rules'] ?? null;
            if ($id_rules && $violation->updateViolation($id_rules, $deskripsi_pelanggaran, $tingkat_pelanggaran)) {
                header("Location: /technorules/admin/data-pelanggaran?status=success&message=Data berhasil diupdate");
            } else {
                header("Location: /technorules/admin/data-pelanggaran?status=error&message=Gagal mengupdate data");
            }
            break;

        case 'delete':
            $id_rules = $_POST['id_rules'] ?? null;
            if ($id_rules && $violation->deleteViolation($id_rules)) {
                header("Location: /technorules/admin/data-pelanggaran?status=success&message=Data berhasil dihapus");
            } else {
                header("Location: /technorules/admin/data-pelanggaran?status=error&message=Gagal menghapus data");
            }
            break;

        default:
            header("Location: /technorules/admin/data-pelanggaran");
            break;
    }
    exit();
}

?>