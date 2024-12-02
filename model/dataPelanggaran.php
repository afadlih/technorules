<?php
require_once 'controller/connection.php';

class DataPelanggaran {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllPelanggaran() {
        $query = "SELECT dp.*, m.nama_mahasiswa 
                  FROM datapelanggaran dp
                  LEFT JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPelanggaranById($id) {
        $query = "SELECT dp.*, m.nama_mahasiswa 
                  FROM datapelanggaran dp
                  LEFT JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                  WHERE dp.id_pelanggaran = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createPelanggaran($data) {
        $query = "INSERT INTO datapelanggaran (id_mahasiswa, deskripsi_pelanggaran, tingkat_pelanggaran) 
                  VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['id_mahasiswa'], 
            $data['deskripsi_pelanggaran'], 
            $data['tingkat_pelanggaran']
        ]);
    }

    public function updatePelanggaran($id, $data) {
        $query = "UPDATE datapelanggaran SET 
                  id_mahasiswa = ?, 
                  deskripsi_pelanggaran = ?, 
                  tingkat_pelanggaran = ?
                  WHERE id_pelanggaran = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['id_mahasiswa'], 
            $data['deskripsi_pelanggaran'], 
            $data['tingkat_pelanggaran'], 
            $id
        ]);
    }

    public function deletePelanggaran($id) {
        $query = "DELETE FROM datapelanggaran WHERE id_pelanggaran = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}