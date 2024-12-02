<?php
class prodi {
    private $conn;
    private $table_name = 'prodi';

    public $id_prodi;
    public $nama_prodi;

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nama_prodi) VALUES (?)";
        $params = array($this->nama_prodi);
        
        $this->nama_prodi = htmlspecialchars(strip_tags($this->nama_prodi));
        
        $stmt = sqlsrv_query($this->conn, $query, $params);
        
        return $stmt !== false;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name . "WHERE nama_prodi";
        
        $stmt = sqlsrv_query($this->conn, $query);
        
        if ($stmt === false) {
            return false;
        }
        
        return $stmt;
    }
}