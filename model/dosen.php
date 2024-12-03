<?php
require_once 'controller/connection.php';

class dosen {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAllDosen() {
        $query = "SELECT * FROM dosen";
        $stmt = $this->conn->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDosenById($id) {
        $query = "SELECT * FROM dosen WHERE id_dosen = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createDosen($data) {
        $query = "INSERT INTO dosen (nidn, nama_dosen, email, status_dosen) 
                  VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['nidn'], 
            $data['nama_dosen'], 
            $data['email'], 
            $data['status_dosen']
        ]);
    }

    public function updateDosen($id, $data) {
        $query = "UPDATE dosen SET 
                  nidn = ?, 
                  nama_dosen = ?, 
                  email = ?, 
                  status_dosen = ? 
                  WHERE id_dosen = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            $data['nidn'], 
            $data['nama_dosen'], 
            $data['email'], 
            $data['status_dosen'], 
            $id
        ]);
    }

    public function deleteDosen($id) {
        $query = "DELETE FROM dosen WHERE id_dosen = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }
}
?>