<?php
class DataPelanggaran {
    private $conn;
    private $table_name = 'datapelanggaran';

    public $id_pelanggaran;
    public $id_mahasiswa;
    public $deskripsi_pelanggaran;
    public $tingkat_pelanggaran;

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (id_mahasiswa, deskripsi_pelanggaran, tingkat_pelanggaran) 
                  VALUES (?, ?, ?)";
        
        $this->id_mahasiswa = htmlspecialchars(strip_tags($this->id_mahasiswa));
        $this->deskripsi_pelanggaran = htmlspecialchars(strip_tags($this->deskripsi_pelanggaran));
        $this->tingkat_pelanggaran = htmlspecialchars(strip_tags($this->tingkat_pelanggaran));
        
        $params = array(
            $this->id_mahasiswa,
            $this->deskripsi_pelanggaran,
            $this->tingkat_pelanggaran
        );
        
        $stmt = sqlsrv_query($this->conn, $query, $params);
        
        return $stmt !== false;
    }

    public function read() {
        $query = "SELECT dp.*, m.nama_mahasiswa 
                  FROM " . $this->table_name . " dp
                  LEFT JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa";
        
        $stmt = sqlsrv_query($this->conn, $query);
        
        if ($stmt === false) {
            return false;
        }
        
        return $stmt;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . "
                 SET id_mahasiswa = ?, 
                     deskripsi_pelanggaran = ?, 
                     tingkat_pelanggaran = ?
                 WHERE id_pelanggaran = ?";

        $this->id_mahasiswa = htmlspecialchars(strip_tags($this->id_mahasiswa));
        $this->deskripsi_pelanggaran = htmlspecialchars(strip_tags($this->deskripsi_pelanggaran));
        $this->tingkat_pelanggaran = htmlspecialchars(strip_tags($this->tingkat_pelanggaran));

        $params = array(
            $this->id_mahasiswa,
            $this->deskripsi_pelanggaran,
            $this->tingkat_pelanggaran,
            $this->id_pelanggaran
        );

        $stmt = sqlsrv_query($this->conn, $query, $params);

        return $stmt !== false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_pelanggaran = ?";
        
        $params = array($this->id_pelanggaran);
        
        $stmt = sqlsrv_query($this->conn, $query, $params);
        
        return $stmt !== false;
    }
}