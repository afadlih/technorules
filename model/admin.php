<?php

class Admin
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    
    // Method to fetch all violations with student details
    public function getViolations()
    {
        $query = "SELECT * 
                 FROM pelanggaran_rules
                 ORDER BY id_rules ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch all lecturers with roles
    public function getLecturers()
    {
        $query = "SELECT id_dosen, nidn, nama_dosen, email, jabatan_dosen, status_dosen, role
                 FROM dosen 
                 ORDER BY nama_dosen ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch all students with program details
    public function getStudents()
    {
        $query = "SELECT m.*, p.nama_prodi, sm.status_nama 
                 FROM mahasiswa m
                 INNER JOIN prodi p ON m.id_prodi = p.id_prodi
                 INNER JOIN status_mhs sm ON m.status_mhs = sm.id_status_mhs
                 ORDER BY m.nama_mahasiswa DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch dashboard data
    public function getDashboardData()
    {
        $stats = [];

        // Total mahasiswa
        $query = "SELECT COUNT(*) as total FROM mahasiswa";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['total_mahasiswa'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Total pelanggaran
        $query = "SELECT COUNT(*) as total FROM pelanggaran_rules";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['total_pelanggaran'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Total dosen
        $query = "SELECT COUNT(*) as total FROM dosen";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $stats['total_dosen'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        return $stats;
    }

    // Method to fetch recent violations for dashboard
    public function getRecentViolations()
    {
        $query = "SELECT TOP 5 dp.*, m.nim, m.nama_mahasiswa, m.kelas,
                 kp.keputusan, t.kegiatan_tebusan, r.tingkat_pelanggaran
                 FROM datapelanggaran dp
                 INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                 LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = kp.id_pelanggaran
                 LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                 LEFT JOIN pelanggaran_rules r ON dp.id_rules = r.id_rules
                 ORDER BY dp.id_pelanggaran DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function manageViolations($id_pelanggaran, $data)
    {
        $query = "UPDATE datapelanggaran SET 
                 deskripsi_pelanggaran = :deskripsi_pelanggaran, 
                 tingkat_pelanggaran = :tingkat_pelanggaran, 
                 id_admin = :id_admin,
                 tanggal_pelanggaran = :tanggal_pelanggaran,
                 id_mahasiswa = (SELECT id_mahasiswa FROM mahasiswa WHERE nim = :nim)
                 WHERE id_pelanggaran = :id_pelanggaran";
        $stmt = $this->conn->prepare($query);
        $data['id_pelanggaran'] = $id_pelanggaran;
        $data['nim'] = $data['id_mahasiswa'];
        return $stmt->execute($data);
    }

    // Method untuk validasi pelanggaran
    public function validateViolation($id_pelanggaran, $status)
    {
        $query = "UPDATE datapelanggaran SET status = :status WHERE id_pelanggaran = :id_pelanggaran";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['status' => $status, 'id_pelanggaran' => $id_pelanggaran]);
    }

    // Method untuk mengelola tebusan
    public function managePenalty($data)
    {
        $query = "INSERT INTO tebusan (id_pelanggaran, kegiatan_tebusan, tanggal_tebusan, id_admin) 
                 VALUES (:id_pelanggaran, :kegiatan_tebusan, :tanggal_tebusan, :id_admin)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Method untuk mengelola pelaporan
    public function manageReport($data)
    {
        $query = "INSERT INTO pelaporan (id_dosen, id_mahasiswa, jumlah_pelanggaran, kegiatan_tebusan, id_admin)
                 VALUES (:id_dosen, :id_mahasiswa, :jumlah_pelanggaran, :kegiatan_tebusan, :id_admin)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    // Method untuk mengelola keputusan komdis
    public function manageKomdisDecision($data)
    {
        $query = "INSERT INTO komdis_pelanggaran (id_pelanggaran, keputusan, tanggal_keputusan, id_admin)
                 VALUES (:id_pelanggaran, :keputusan, :tanggal_keputusan, :id_admin)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function getProfile($id_admin)
    {
        $query = "SELECT * FROM admintatib WHERE id_admin = :id_admin";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_admin' => $id_admin]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($data)
    {
        $query = "UPDATE admintatib SET nama = :nama, email = :email WHERE id_admin = :id_admin";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function notifyAdminForValidation($username)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO notifications (message, status) VALUES (:message, 'unread')");
            $message = "New registration request from user: " . $username;
            $stmt->bindParam(':message', $message);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Notification error: " . $e->getMessage());
        }
    }

    public function getNotifications()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM notifications WHERE status = 'unread' ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Fetch notifications error: " . $e->getMessage());
            return [];
        }
    }

    public function markNotificationAsRead($notification_id)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE notifications SET status = 'read' WHERE id = :id");
            $stmt->bindParam(':id', $notification_id);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Mark notification as read error: " . $e->getMessage());
        }
    }
    
    //------------------------------------------------------------------------------------------------------------------------\\

    //Mahasiswa
    public function createMhs($nim, $nama_mahasiswa, $status_mhs, $kelas, $id_prodi, $passwordusr) {
        $id_admin = '1';

        $query = "INSERT INTO mahasiswa (nim, nama_mahasiswa, status_mhs, kelas, id_prodi, id_admin) 
                  VALUES (:nim, :nama_mahasiswa, :status_mhs, :kelas, :id_prodi, :id_admin)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'nim' => $nim,
            'nama_mahasiswa' => $nama_mahasiswa, 
            'status_mhs' => $status_mhs,
            'kelas' => $kelas,
            'id_prodi' => $id_prodi,
            'id_admin' => $id_admin
        ]);

        $id_mahasiswa = $this->conn->lastInsertId();

        $query2 = "INSERT INTO usertatib (username, passwordusr, id_mahasiswa, id_admin) 
                   VALUES (:username, :passwordusr, :id_mahasiswa, :id_admin)";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute([
            'username' => $nim,
            'passwordusr' => $passwordusr,
            'id_mahasiswa' => $id_mahasiswa,
            'id_admin' => $id_admin
        ]);
        
        return $id_mahasiswa;
    }

    public function updateMhs($id_mahasiswa, $nim, $nama_mahasiswa, $kelas, $id_prodi, $status_mhs) {
        $query = "UPDATE mahasiswa 
                 SET nim = :nim,
                     nama_mahasiswa = :nama_mahasiswa,
                     kelas = :kelas,
                     id_prodi = :id_prodi,
                     status_mhs = :status_mhs
                 WHERE id_mahasiswa = :id_mahasiswa";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'id_mahasiswa' => $id_mahasiswa,
            'nim' => $nim,
            'kelas' => $kelas,
            'id_prodi' => $id_prodi,
            'nama_mahasiswa' => $nama_mahasiswa,
            'status_mhs' => $status_mhs
        ]);

        $query2 = "UPDATE usertatib SET username = :nim WHERE id_mahasiswa = :id_mahasiswa";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute([
            'nim' => $nim,
            'id_mahasiswa' => $id_mahasiswa
        ]);

        return $id_mahasiswa;
    }

    public function deleteMhs($id_mahasiswa) {
        $query1 = "DELETE FROM usertatib WHERE id_mahasiswa = :id_mahasiswa";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->execute(['id_mahasiswa' => $id_mahasiswa]);

        $query2 = "DELETE FROM mahasiswa WHERE id_mahasiswa = :id_mahasiswa";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute(['id_mahasiswa' => $id_mahasiswa]);

        return true;
    }

    //------------------------------------------------------------------------------------------------------------------------\\

    //Dosen
    public function createDosen($nidn, $nama_dosen, $email, $status_dosen, $jabatan_dosen, $role, $passwordusr) {
        $id_admin = '1';

        $query = "INSERT INTO dosen (nidn, nama_dosen, email, status_dosen, jabatan_dosen, role, id_admin) 
                  VALUES (:nidn, :nama_dosen, :email, :status_dosen, :jabatan_dosen, :role, :id_admin)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'nidn' => $nidn,
            'nama_dosen' => $nama_dosen, 
            'email' => $email, 
            'status_dosen' => $status_dosen,
            'jabatan_dosen' => $jabatan_dosen,
            'role' => $role,
            'id_admin' => $id_admin
        ]);

        $id_dosen = $this->conn->lastInsertId();
        
        $query2 = "INSERT INTO usertatib (username, passwordusr, id_dosen, id_admin) 
                    VALUES (:username, :passwordusr, :id_dosen, :id_admin)";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute([
            'username' => $nidn,
            'passwordusr' => $passwordusr,
            'id_dosen' => $id_dosen,
            'id_admin' => $id_admin
        ]);
        
        return $id_dosen;
    }

    public function updateDosen($id_dosen, $nidn, $nama_dosen, $email, $status_dosen, $jabatan_dosen, $role) {
        $query = "UPDATE dosen 
                 SET nidn = :nidn,
                     nama_dosen = :nama_dosen, 
                     email = :email,
                     status_dosen = :status_dosen,
                     jabatan_dosen = :jabatan_dosen,
                     role = :role
                 WHERE id_dosen = :id_dosen";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'id_dosen' => $id_dosen,
            'nidn' => $nidn,
            'nama_dosen' => $nama_dosen,
            'email' => $email, 
            'status_dosen' => $status_dosen,
            'jabatan_dosen' => $jabatan_dosen,
            'role' => $role
        ]);

        $query2 = "UPDATE usertatib SET username = :nidn WHERE id_dosen = :id_dosen";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute([
            'nidn' => $nidn,
            'id_dosen' => $id_dosen
        ]);
        
        return $id_dosen;
    }

    public function deleteDosen($id_dosen) {
        $query1 = "DELETE FROM usertatib WHERE id_dosen = :id_dosen";
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->execute(['id_dosen' => $id_dosen]);

        $query2 = "DELETE FROM dosen WHERE id_dosen = :id_dosen";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute(['id_dosen' => $id_dosen]);
        
        return $id_dosen;
    }

     //------------------------------------------------------------------------------------------------------------------------\\

    //Pelanggaran
    public function createViolation($deskripsi_pelanggaran, $tingkat_pelanggaran) {
        $query = "INSERT INTO pelanggaran_rules (deskripsi_pelanggaran, tingkat_pelanggaran)
                    VALUES (:deskripsi_pelanggaran, :tingkat_pelanggaran)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'deskripsi_pelanggaran' => $deskripsi_pelanggaran,
            'tingkat_pelanggaran' => $tingkat_pelanggaran
        ]);

        $id_rules = $this->conn->lastInsertId();
        return $id_rules;
    }

    public function updateViolation($id_rules, $deskripsi_pelanggaran, $tingkat_pelanggaran) {
        $query = "UPDATE pelanggaran_rules 
                 SET deskripsi_pelanggaran = :deskripsi_pelanggaran,
                     tingkat_pelanggaran = :tingkat_pelanggaran
                 WHERE id_rules = :id_rules";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'id_rules' => $id_rules,
            'deskripsi_pelanggaran' => $deskripsi_pelanggaran,
            'tingkat_pelanggaran' => $tingkat_pelanggaran
        ]);
        
        return $id_rules;
    }

    public function deleteViolation($id_rules) {
        $query = "DELETE FROM pelanggaran_rules WHERE id_rules = :id_rules";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['id_rules' => $id_rules]);
        
        return $id_rules;
    }
}