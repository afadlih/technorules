<?php

require_once '../controller/connection.php';

class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function login($username, $password)
    {
        session_start();

        if (empty($username) || empty($password)) {
            echo "Please enter both username and password.";
            return false;
        }

        try {
            $stmt = $this->conn->prepare("SELECT * 
                                            FROM usertatib
                                            LEFT JOIN mahasiswa ON usertatib.id_mahasiswa = mahasiswa.id_mahasiswa
                                            LEFT JOIN dosen ON usertatib.id_dosen = dosen.id_dosen
                                            LEFT JOIN admintatib ON usertatib.id_admin = admintatib.id_admin
                                            WHERE usertatib.username = ?");
            $stmt->execute([$username]);

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $user['passwordusr'])) {
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
                    } else {
                        echo "Error: User has no assigned role.";
                        return false;
                    }

                    exit();
                } else {
                    echo "Invalid username or password.";
                    return false;
                }
            } else {
                echo "Invalid username or password.";
                return false;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}