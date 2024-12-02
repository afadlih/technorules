<?php

class dosen extends user {
    public function __construct($database_connection) {
        parent::__construct($database_connection);
    }
    
    public function getDosenById($id) {
        $query = "SELECT u.*, d.* FROM dosen d 
                  JOIN users u ON d.user_id = u.id 
                  WHERE d.user_id = ?";
        $params = array($id);
        $stmt = sqlsrv_query($this->conn, $query, $params);
        
        if ($stmt === false || !sqlsrv_has_rows($stmt)) {
            return false;
        }
        
        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }
    
    public function getDosenRole($user_id) {
        $role = parent::getUserRole($user_id);
        if (in_array($role, ['dosen', 'dosen_dpa', 'dosen_komdis'])) {
            return $role;
        }
        return false;
    }
    
    public function isDPA($user_id) {
        $role = $this->getDosenRole($user_id);
        return $role === 'dosen_dpa';
    }
    
    public function isKomdis($user_id) {
        $role = $this->getDosenRole($user_id); 
        return $role === 'dosen_komdis';
    }

    public function create(){
        $query = "INSERT INTO " . $this->table_name . " (user_id) VALUES (?)";

        $params = array($this->user_id);
        
        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            return false;
        }

        return true;
    }

    public function update(){
        $query = "UPDATE " . $this->table_name . " SET user_id = ? WHERE user_id = ?";

        $params = array($this->user_id, $this->user_id);

        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            return false;
        }

        return true;
    }

    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE user_id = ?"; 

        $params = array($this->user_id);

        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            return false;
        }

        return true;
    }
}

?>
