<?php

class Mahasiswa
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getViolations($id_mahasiswa)
    {
        $query = "SELECT dp.*, pr.*, t.* 
                  FROM datapelanggaran dp
                  INNER JOIN pelanggaran_rules pr ON dp.id_rules = pr.id_rules
                  INNER JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                  WHERE dp.id_mahasiswa = :id_mahasiswa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_mahasiswa' => $id_mahasiswa]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopViolations($id_mahasiswa)
    {
        $query = "SELECT dp.*, pr.*, t.*, kp.*
                  FROM datapelanggaran dp
                  LEFT JOIN pelanggaran_rules pr ON dp.id_rules = pr.id_rules
                  LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                  LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = t.id_pelanggaran
                  WHERE dp.id_mahasiswa = :id_mahasiswa 
                  AND pr.tingkat_pelanggaran = '1'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_mahasiswa' => $id_mahasiswa]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProfile($id_mahasiswa)
    {
        $query = "SELECT m.*, p.nama_prodi, sm.status_nama 
                  FROM mahasiswa m
                  INNER JOIN prodi p ON m.id_prodi = p.id_prodi
                  INNER JOIN status_mhs sm ON m.status_mhs = sm.id_status_mhs
                  WHERE m.id_mahasiswa = :id_mahasiswa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_mahasiswa' => $id_mahasiswa]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllMahasiswa()
    {
        $query = "SELECT * FROM mahasiswa";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMahasiswaById($id)
    {
        $query = "SELECT * FROM mahasiswa WHERE id_mahasiswa = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>