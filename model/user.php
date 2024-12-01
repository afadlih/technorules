<?php

class user
{
    private $conn;

    public function __construct($database_connection)
    {
        $this->conn = $database_connection;
    }

    public function login($username, $password)
    {
        $query = "SELECT * FROM users WHERE username = ?";
        $params = array($username);
        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            return false;
        }

        if (sqlsrv_has_rows($stmt)) {
            $user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
        return false;
    }

    public function getUserRole($user_id)
    {
        $query = "SELECT r.role_name FROM roles r 
                  JOIN user_roles ur ON r.id = ur.role_id 
                  WHERE ur.user_id = ?";
        $params = array($user_id);
        $stmt = sqlsrv_query($this->conn, $query, $params);

        if ($stmt === false) {
            return false;
        }

        if (sqlsrv_has_rows($stmt)) {
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            return $row['role_name'];
        }
        return false;
    }
}