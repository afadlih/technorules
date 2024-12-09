<?php

class Admin
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Method to add a new violation
    public function addViolation($data)
    {
        $query = "INSERT INTO datapelanggaran (id_mahasiswa, deskripsi_pelanggaran, tingkat_pelanggaran, id_admin) VALUES (:id_mahasiswa, :deskripsi_pelanggaran, :tingkat_pelanggaran, :id_admin)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
    }

    // Method to add a new lecturer
    public function addLecturer($data)
    {
        $query = "INSERT INTO dosen (nidn, nama_dosen, email, status_dosen, jabatan_dosen, role, id_admin) VALUES (:nidn, :nama_dosen, :email, :status_dosen, :jabatan_dosen, :role, :id_admin)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
    }

    // Method to add a new student
    public function addStudent($data)
    {
        $query = "INSERT INTO mahasiswa (nim, nama_mahasiswa, kelas, status_mhs, id_prodi, id_admin) VALUES (:nim, :nama_mahasiswa, :kelas, :status_mhs, :id_prodi, :id_admin)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($data);
    }

    // Method to fetch all violations with student details
    public function getViolations()
    {
        $query = "SELECT dp.*, m.nim, m.nama_mahasiswa, m.kelas 
                 FROM datapelanggaran dp
                 INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                 ORDER BY dp.id_pelanggaran DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to fetch all lecturers with roles
    public function getLecturers()
    {
        $query = "SELECT id_dosen, nidn, nama_dosen, email, status_dosen, jabatan_dosen, role 
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
                 ORDER BY m.nama_mahasiswa ASC";
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
        $query = "SELECT COUNT(*) as total FROM datapelanggaran";
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
                 kp.keputusan, t.kegiatan_tebusan
                 FROM datapelanggaran dp
                 INNER JOIN mahasiswa m ON dp.id_mahasiswa = m.id_mahasiswa
                 LEFT JOIN komdis_pelanggaran kp ON dp.id_pelanggaran = kp.id_pelanggaran
                 LEFT JOIN tebusan t ON dp.id_pelanggaran = t.id_pelanggaran
                 ORDER BY dp.id_pelanggaran DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}