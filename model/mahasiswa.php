<?php

class Mahasiswa
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Method to fetch violations for the logged-in student
    public function getViolations($id_mahasiswa)
    {
        $query = "SELECT * FROM datapelanggaran WHERE id_mahasiswa = :id_mahasiswa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_mahasiswa' => $id_mahasiswa]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch messages for the logged-in student
    public function getMessages($id_mahasiswa)
    {
        $query = "SELECT * FROM datapelanggaran WHERE id_mahasiswa = :id_mahasiswa AND tingkat_pelanggaran = '1'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_mahasiswa' => $id_mahasiswa]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch profile information for the logged-in student
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