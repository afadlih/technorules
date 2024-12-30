<?php

class Dosen {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllDosen() {
        $query = "EXEC GetDosen @dosen_id = NULL";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDosenById($id) {
        $query = "EXEC GetDosen @dosen_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDashboard(){
        $query = "SELECT TOP 20 dp.*, m.nim, m.nama_mahasiswa, m.kelas, r.tingkat_pelanggaran
                 FROM datapelanggaran dp
                 INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                 LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = kp.id_pelanggaran
                 LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                 LEFT JOIN pelanggaran_rules r ON dp.id_rules = r.id_rules
                 ORDER BY dp.id_pelanggaran DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPelanggaranTingkat1() {
        $query = "SELECT dp.*, m.nim, m.nama_mahasiswa, dp.deskripsi_pelanggaran, r.tingkat_pelanggaran
                 FROM datapelanggaran dp
                 INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                 INNER JOIN pelanggaran_rules r ON dp.id_rules = r.id_rules
                 WHERE r.tingkat_pelanggaran = 1
                 ORDER BY dp.id_pelanggaran DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPelanggaran($id_mahasiswa, $id_dosen, $deskripsi_pelanggaran, $id_rules, $id_admin) {
        $query = "INSERT INTO datapelanggaran (id_mahasiswa, id_dosen, deskripsi_pelanggaran, id_rules, id_admin, tanggal_pelanggaran) 
                 VALUES (:id_mahasiswa, :id_dosen, :deskripsi_pelanggaran, :id_rules, :id_admin, GETDATE());
                 SELECT dp.*, m.nim, m.nama_mahasiswa, m.kelas, r.tingkat_pelanggaran
                 FROM datapelanggaran dp
                 INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa 
                 LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = kp.id_pelanggaran
                 LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                 LEFT JOIN pelanggaran_rules r ON dp.id_rules = r.id_rules
                 WHERE dp.id_pelanggaran = SCOPE_IDENTITY()";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'id_mahasiswa' => $id_mahasiswa,
            'id_dosen' => $id_dosen,
            'deskripsi_pelanggaran' => $deskripsi_pelanggaran, 
            'id_rules' => $id_rules,
            'id_admin' => $id_admin
        ]);
    }

    public function updatePelanggaran($id_pelanggaran, $deskripsi_pelanggaran) {
        $query = "UPDATE datapelanggaran 
                 SET deskripsi_pelanggaran = :deskripsi_pelanggaran
                 WHERE id_pelanggaran = :id_pelanggaran;
                 SELECT dp.*, m.nim, m.nama_mahasiswa, m.kelas, r.tingkat_pelanggaran
                 FROM datapelanggaran dp
                 INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                 LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = kp.id_pelanggaran
                 LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                 LEFT JOIN pelanggaran_rules r ON dp.id_rules = r.id_rules
                 WHERE dp.id_pelanggaran = :id_pelanggaran";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'deskripsi_pelanggaran' => $deskripsi_pelanggaran,
            'id_pelanggaran' => $id_pelanggaran
        ]);
    }

    public function deletePelanggaran($id_pelanggaran) {
        $query = "DELETE FROM datapelanggaran WHERE id_pelanggaran = :id_pelanggaran;
                 SELECT dp.*, m.nim, m.nama_mahasiswa, m.kelas, r.tingkat_pelanggaran
                 FROM datapelanggaran dp
                 INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                 LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = kp.id_pelanggaran
                 LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                 LEFT JOIN pelanggaran_rules r ON dp.id_rules = r.id_rules
                 WHERE dp.id_pelanggaran = :id_pelanggaran";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id_pelanggaran' => $id_pelanggaran]);
    }

    public function getForm($id_dosen) {
        $query = "SELECT dp.*, m.nim, m.nama_mahasiswa, m.kelas, r.tingkat_pelanggaran
                    FROM datapelanggaran dp
                    INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                    LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = kp.id_pelanggaran
                    LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                    LEFT JOIN pelanggaran_rules r ON dp.id_rules = r.id_rules
                    WHERE dp.id_dosen = :id_dosen
                    ORDER BY dp.id_pelanggaran DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_dosen' => $id_dosen]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClass($id_prodi, $kelas) {
        $query = "SELECT dp.*, m.nim, m.nama_mahasiswa, m.kelas, r.tingkat_pelanggaran, p.id_prodi
                    FROM datapelanggaran dp
                    INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                    LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = kp.id_pelanggaran
                    LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                    LEFT JOIN pelanggaran_rules r ON dp.id_rules = r.id_rules
                    LEFT JOIN prodi p ON m.id_prodi = p.id_prodi
                    WHERE m.kelas = :kelas AND m.id_prodi = :id_prodi
                    ORDER BY dp.id_pelanggaran DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'id_prodi' => $id_prodi,
            'kelas' => $kelas
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updatePelanggaranKelas($id_pelanggaran, $deskripsi_pelanggaran) {
        $query = "UPDATE datapelanggaran 
                 SET deskripsi_pelanggaran = :deskripsi_pelanggaran
                 WHERE id_pelanggaran = :id_pelanggaran";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'deskripsi_pelanggaran' => $deskripsi_pelanggaran,
            'id_pelanggaran' => $id_pelanggaran
        ]);
    }

    public function deletePelanggaranKelas($id_pelanggaran) {
        $query = "DELETE FROM datapelanggaran WHERE id_pelanggaran = :id_pelanggaran";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['id_pelanggaran' => $id_pelanggaran]);
    }
}
?>