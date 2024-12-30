<?php
require_once __DIR__ . '/../connection.php';
require_once __DIR__ . '/../../model/admin.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim = htmlspecialchars($_POST['nim']);
    $nama_mahasiswa = htmlspecialchars($_POST['nama_mahasiswa']); 
    $kelas = htmlspecialchars($_POST['kelas']);
    $id_prodi = htmlspecialchars($_POST['id_prodi']);
    $status_mhs = htmlspecialchars($_POST['status_mhs']);
    
    $method = $_GET['method'] ?? 'default';
    $student = new Admin($conn);
    
    switch ($method) {
        case 'update':
            $id_mahasiswa = $_POST['id_mahasiswa'] ?? null;
            if ($id_mahasiswa && $student->updateMhs($id_mahasiswa, $nim, $nama_mahasiswa, $kelas, $id_prodi, $status_mhs)) {
                header("Location: /technorules/admin/data-mahasiswa?status=success&message=Data berhasil diupdate");
            } else {
                header("Location: /technorules/admin/data-mahasiswa?status=error&message=Gagal mengupdate data");
            }
            break;

        case 'delete':
            $id_mahasiswa = $_POST['id_mahasiswa'] ?? null;
            if ($id_mahasiswa && $student->deleteMhs($id_mahasiswa)) {
                header("Location: /technorules/admin/data-mahasiswa?status=success&message=Data berhasil dihapus");
            } else {
                header("Location: /technorules/admin/data-mahasiswa?status=error&message=Gagal menghapus data");
            }
            break;

        default:
            header("Location: /technorules/admin/data-mahasiswa");
            break;
    }
    exit();
}

?>