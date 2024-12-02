<?php
class UserModel {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT 
            'mahasiswa' as user_type, 
            id_mahasiswa as user_id, 
            nim, 
            nama_mahasiswa 
            FROM mahasiswa 
            WHERE nim = ? AND password_mahasiswa = ?");
        $stmt->execute([$username, $password]);
        $mahasiswa = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($mahasiswa) {
            return [
                'status' => true,
                'user_type' => 'mahasiswa',
                'user_id' => $mahasiswa['user_id'],
                'nama' => $mahasiswa['nama_mahasiswa']
            ];
        }

        $stmt = $this->conn->prepare("SELECT 
            'dosen' as user_type, 
            id_dosen as user_id, 
            nidn, 
            nama_dosen 
            FROM dosen 
            WHERE nidn = ? AND password_dosen = ?");
        $stmt->execute([$username, $password]);
        $dosen = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dosen) {
            return [
                'status' => true,
                'user_type' => 'dosen',
                'user_id' => $dosen['user_id'],
                'nama' => $dosen['nama_dosen']
            ];
        }

        $stmt = $this->conn->prepare("SELECT 
            'admin' as user_type, 
            id_admin as user_id, 
            nip 
            FROM admintatib 
            WHERE nip = ? AND password_admin = ?");
        $stmt->execute([$username, $password]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin) {
            return [
                'status' => true,
                'user_type' => 'admin',
                'user_id' => $admin['user_id']
            ];
        }

        return [
            'status' => false, 
            'message' => 'Login gagal'
        ];
    }
}
