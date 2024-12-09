<?php

require_once 'controller/connection.php';

use controller\auth_controller;

class user {
    private $conn;

    public function __construct($database_connection) {
        $this->conn = $database_connection;
    }

    public function login($username, $password) {
        session_start();

        $error = '';

            if (empty($username) || empty($password)) {
                $error = "Please enter both username and password.";
            } else {
                try {
                    $stmt = $this->conn->prepare("SELECT * 
                        FROM usertatib
                        INNER JOIN mahasiswa
                        ON usertatib.id_mahasiswa = mahasiswa.id_mahasiswa
                        WHERE usertatib.username = ? AND usertatib.passwordusr = ?");
                    $stmt->execute([$username, $password]);
                    
                    if ($stmt->rowCount() == 1) {
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);
                        
                        $_SESSION['user_id'] = $user['username'];
                        
                        if ($user['id_mahasiswa'] !== null) {
                            $_SESSION['mahasiswa_id'] = $user['id_mahasiswa'];
                            header("Location: mahasiswa/dashboard");
                        } elseif ($user['id_dosen'] !== null) {
                            $_SESSION['dosen_id'] = $user['id_dosen'];
                            header("Location: dpa/dashboard");
                        } elseif ($user['id_admin'] !== null) {
                            $_SESSION['admin_id'] = $user['id_admin'];
                            header("Location: admin/dashboard");
                        }
                        
                        exit();
                    } else {
                        $error = "Invalid username or password.";
                    }
                } catch(PDOException $e) {
                    $error = "Login error: " . $e->getMessage();
                }
            }
    }
}
