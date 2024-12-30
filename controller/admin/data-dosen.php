<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../../model/admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nidn = htmlspecialchars($_POST['nip']);
    $nama_dosen = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $status_dosen = htmlspecialchars($_POST['status_dosen']);
    $jabatan_dosen = htmlspecialchars($_POST['jabatan']);
    $role = htmlspecialchars($_POST['role']);
    
    $method = $_GET['method'] ?? 'default';
    $lecturer = new Admin($conn);
    
    switch ($method) {
        case 'add':
            $passwordusr = htmlspecialchars(trim($_POST['passwordusr']));
            if ($lecturer->createDosen($nidn, $nama_dosen, $email, $status_dosen, $jabatan_dosen, $role, $passwordusr)) {
                header("Location: /technorules/admin/data-dosen?status=success&message=Data berhasil ditambahkan");
            } else {
                header("Location: /technorules/admin/data-dosen?status=error&message=Gagal menambahkan data");
            }
            break;

        case 'update':
            $id_dosen = $_POST['id_dosen'] ?? null;
            if ($id_dosen && $lecturer->updateDosen($id_dosen, $nidn, $nama_dosen, $email, $status_dosen, $jabatan_dosen, $role)) {
                header("Location: /technorules/admin/data-dosen?status=success&message=Data berhasil diupdate");
            } else {
                header("Location: /technorules/admin/data-dosen?status=error&message=Gagal mengupdate data");
            }
            break;

        case 'delete':
            $id_dosen = $_POST['id_dosen'] ?? null;
            if ($id_dosen && $lecturer->deleteDosen($id_dosen)) {
                header("Location: /technorules/admin/data-dosen?status=success&message=Data berhasil dihapus");
            } else {
                header("Location: /technorules/admin/data-dosen?status=error&message=Gagal menghapus data");
            }
            break;

        default:
            header("Location: /technorules/admin/data-dosen");
            break;
    }
    exit();
}

?>