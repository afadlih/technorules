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
            return "empty_fields";
        }

        try {
            $stmt = $this->conn->prepare("SELECT * 
                                            FROM usertatib
                                            LEFT JOIN mahasiswa ON usertatib.id_mahasiswa = mahasiswa.id_mahasiswa
                                            LEFT JOIN dosen ON usertatib.id_dosen = dosen.id_dosen
                                            LEFT JOIN admintatib ON usertatib.id_admin = admintatib.id_admin
                                            WHERE usertatib.username = :username");
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Gunakan password_verify() untuk password baru yang sudah di-hash
                if (password_verify($password, $user['password_hash'])) {
                    $_SESSION['user_id'] = $user['username'];

                    if ($user['id_mahasiswa']) {
                        $_SESSION['mahasiswa_id'] = $user['id_mahasiswa'];
                        header("Location: ../mahasiswa");
                    } elseif ($user['id_dosen']) {
                        $_SESSION['dosen_id'] = $user['id_dosen'];
                        if ($user['role'] === 'komdis') {
                            header("Location: ../komdis");
                        } else {
                            header("Location: ../dpa");
                        }
                    } elseif ($user['id_admin']) {
                        $_SESSION['admin_id'] = $user['id_admin'];
                        header("Location: ../admin");
                    } else {
                        return "no_role"; // User tidak memiliki peran
                    }

                    exit();
                } else {
                    // Jika password_verify() gagal, coba bandingkan dengan passwordusr (plain text)
                    if ($password === $user['passwordusr']) {
                        // Password benar (plain text)
                        $_SESSION['user_id'] = $user['username'];

                        if ($user['id_mahasiswa']) {
                            $_SESSION['mahasiswa_id'] = $user['id_mahasiswa'];
                            header("Location: ../mahasiswa");
                        } elseif ($user['id_dosen']) {
                            $_SESSION['dosen_id'] = $user['id_dosen'];
                            if ($user['role'] === 'komdis') {
                                header("Location: ../komdis");
                            } else {
                                header("Location: ../dpa");
                            }
                        } elseif ($user['id_admin']) {
                            $_SESSION['admin_id'] = $user['id_admin'];
                            header("Location: ../admin");
                        } else {
                            return "no_role"; // User tidak memiliki peran
                        }

                        exit();
                    } else {
                        return "invalid_password";
                    }
                }
            } else {
                return "invalid_username";
            }
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage()); // Log error ke file
            return "login_failed";
        }
    }

    public function registerStudent($full_name, $username, $password)
    {
        try {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $this->conn->prepare("INSERT INTO usertatib (username, passwordusr, id_mahasiswa) VALUES (:username, :passwordusr, (SELECT id_mahasiswa FROM mahasiswa WHERE nim = :username))");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':passwordusr', $password_hash);
            $stmt->execute();
            return "success";
        } catch (PDOException $e) {
            error_log("Registration error: " . $e->getMessage());
            return "registration_failed";
        }
    }
}