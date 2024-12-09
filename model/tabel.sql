USE sistatib;

CREATE TABLE
    admintatib (
        id_admin INT PRIMARY KEY IDENTITY (1, 1),
        nip VARCHAR(20),
        password_admin VARCHAR(50)
    );

CREATE TABLE
    prodi (
        id_prodi INT PRIMARY KEY IDENTITY (1, 1),
        nama_prodi VARCHAR(50),
        id_admin INT FOREIGN KEY REFERENCES admintatib (id_admin)
    );

CREATE TABLE
    status_mhs (
        id_status_mhs VARCHAR(10) PRIMARY KEY,
        status_nama VARCHAR(10)
    );

CREATE TABLE
    mahasiswa (
        id_mahasiswa INT PRIMARY KEY IDENTITY (1, 1),
        nim VARCHAR(15),
        nama_mahasiswa VARCHAR(50),
        kelas VARCHAR(50),
        status_mhs VARCHAR(10) FOREIGN KEY REFERENCES status_mhs (id_status_mhs),
        id_prodi INT FOREIGN KEY REFERENCES prodi (id_prodi),
        id_admin INT FOREIGN KEY REFERENCES admintatib (id_admin)
    );

CREATE TABLE
    dosen (
        id_dosen INT PRIMARY KEY IDENTITY (1, 1),
        nidn VARCHAR(15),
        nama_dosen VARCHAR(50),
        email VARCHAR(50),
        status_dosen VARCHAR(20),
        jabatan_dosen VARCHAR(50),
        role VARCHAR(10) CHECK (role IN ('dosen', 'dpa', 'komdis')),
        id_admin INT FOREIGN KEY REFERENCES admintatib (id_admin)
    );

CREATE TABLE
    usertatib (
        id_user INT PRIMARY KEY IDENTITY (1, 1),
        username VARCHAR(50),
        passwordusr VARCHAR(50),
        id_mahasiswa INT FOREIGN KEY REFERENCES mahasiswa (id_mahasiswa),
        id_dosen INT FOREIGN KEY REFERENCES dosen (id_dosen),
        id_admin INT FOREIGN KEY REFERENCES admintatib (id_admin)
    );

CREATE TABLE
    datapelanggaran (
        id_pelanggaran INT PRIMARY KEY IDENTITY (1, 1),
        id_mahasiswa INT NOT NULL FOREIGN KEY REFERENCES mahasiswa (id_mahasiswa),
        deskripsi_pelanggaran VARCHAR(255),
        tingkat_pelanggaran VARCHAR(10) CHECK (tingkat_pelanggaran IN ('1', '2', '3', '4', '5')),
        id_admin INT FOREIGN KEY REFERENCES admintatib (id_admin)
    );

CREATE TABLE
    tebusan (
        id_tebusan INT PRIMARY KEY IDENTITY (1, 1),
        id_pelanggaran INT NOT NULL FOREIGN KEY REFERENCES datapelanggaran (id_pelanggaran),
        kegiatan_tebusan VARCHAR(50),
        tanggal_tebusan DATE,
        id_admin INT FOREIGN KEY REFERENCES admintatib (id_admin)
    );

CREATE TABLE
    pelaporan (
        id_pelaporan INT PRIMARY KEY IDENTITY (1, 1),
        id_dosen INT NOT NULL FOREIGN KEY REFERENCES dosen (id_dosen),
        id_mahasiswa INT NOT NULL FOREIGN KEY REFERENCES mahasiswa (id_mahasiswa),
        jumlah_pelanggaran INT,
        kegiatan_tebusan VARCHAR(50),
        id_admin INT FOREIGN KEY REFERENCES admintatib (id_admin)
    );

CREATE TABLE
    komdis_pelanggaran (
        id_pelaporan INT PRIMARY KEY IDENTITY (1, 1),
        id_pelanggaran INT NOT NULL FOREIGN KEY REFERENCES datapelanggaran (id_pelanggaran),
        keputusan VARCHAR(50) CHECK (keputusan IN ('Cuti', 'DO', 'Lanjut')),
        tanggal_keputusan DATE,
        id_admin INT FOREIGN KEY REFERENCES admintatib (id_admin)
    );


    USE sistatib;

INSERT INTO admintatib (nip, password_admin) VALUES
('198010102005011001', 'admin123');

INSERT INTO prodi (nama_prodi, id_admin) VALUES
('D4 Teknik Informatika', 1),
('D4 Sistem Informasi Bisnis', 1), 
('D2 Pengembangan Piranti Lunak Situs', 1);

INSERT INTO status_mhs (id_status_mhs, status_nama) VALUES
('A', 'Aktif'), 
('N', 'Non Aktif'),
('C','Cuti');

INSERT INTO mahasiswa (nim, nama_mahasiswa, kelas, status_mhs, id_prodi, id_admin) VALUES
('23417' + CAST(FLOOR(RAND()*(99999-10000+1)+10000) AS VARCHAR), 'Budi Santoso', 'TI-4A', 'A', 1, 1),  -- D4 Teknik Informatika
('23417' + CAST(FLOOR(RAND()*(99999-10000+1)+10000) AS VARCHAR), 'Ani Rahmawati', 'SIB-4B', 'A', 2, 1), -- D4 Sistem Informasi Bisnis
('23417' + CAST(FLOOR(RAND()*(99999-10000+1)+10000) AS VARCHAR), 'Candra Permana', 'PPL-2A', 'N', 3, 1); -- D2 Pengembangan Piranti Lunak Situs

USE sistatib;

INSERT INTO dosen (nidn, nama_dosen, email, status_dosen, jabatan_dosen, role, id_admin) VALUES
('198101020501001', 'Ade Ismail', 'ade.ismail@email.com', 'Tetap', 'Lektor Kepala', 'dosen', 1),
('198502152101002', 'Adevian Fairuz Pratama', 'adevian.fairuz@email.com', 'Tetap', 'Guru Besar', 'dpa', 1),
('199001202015003', 'Agung Nugroho Pramudhita', 'agung.nugroho@email.com', 'Kontrak', 'Asisten Ahli', 'komdis', 1),
('198812102011004', 'Ahmad Yuli Ananta', 'ahmad.ananta@email.com', 'Tetap', 'Lektor', 'dosen', 1),
('198709152009005', 'Amalia Agung Septiana', 'amalia.septiana@email.com', 'Kontrak', 'Lektor', 'komdis', 1),
('199208252013006', 'Ane Fany Novitasari', 'ane.novitasari@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199012102012007', 'Annisa Puspa Kirana', 'annisa.kirana@email.com', 'Tetap', 'Lektor Kepala', 'dosen', 1),
('198611202007008', 'Annisa Taufika Firdausi', 'annisa.firdausi@email.com', 'Kontrak', 'Guru Besar', 'komdis', 1),
('199506252014009', 'Anugrah Nur Rahmanto', 'anugrah.rahmanto@email.com', 'Tetap', 'Asisten Ahli', 'dpa', 1),
('199312302016010', 'Ariadi Retno Ririd', 'ariadi.ririd@email.com', 'Tetap', 'Lektor', 'dosen', 1),
('198809152012011', 'Ariyanti', 'ariyanti@email.com', 'Tetap', 'Lektor Kepala', 'dosen', 1),
('199104092018012', 'Atiqah Nurul Asri', 'atiqah.asri@email.com', 'Kontrak', 'Guru Besar', 'komdis', 1),
('198710102011013', 'Bagas Satya Dian Nugraha', 'bagas.nugraha@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('198806062010014', 'Bani Satria Andoko', 'bani.andoko@email.com', 'Tetap', 'Lektor', 'dpa', 1),
('198504202008015', 'Budi Harijanto', 'budi.harijanto@email.com', 'Tetap', 'Lektor Kepala', 'dosen', 1),
('199209252013016', 'Cahya Rahmad', 'cahya.rahmad@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('198907102015017', 'Candra Bella Vista', 'candra.vista@email.com', 'Kontrak', 'Guru Besar', 'komdis', 1),
('198512302008018', 'Deasy Sandhya Elya Ikawati', 'deasy.ikawati@email.com', 'Tetap', 'Lektor', 'dpa', 1),
('199108202016019', 'Deddy Kusbianto', 'deddy.kusbianto@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199202152015020', 'Dhebys Suryani', 'dhebys.suryani@email.com', 'Tetap', 'Guru Besar', 'komdis', 1),
('198902102014021', 'Dian Hanifudin Subhi', 'dian.subhi@email.com', 'Tetap', 'Lektor Kepala', 'dosen', 1),
('199007052013022', 'Dian Wahyuningtyas', 'dian.wahyuningtyas@email.com', 'Kontrak', 'Asisten Ahli', 'dosen', 1),
('199108152016023', 'Dika Rizky Yunianto', 'dika.yunianto@email.com', 'Tetap', 'Guru Besar', 'dpa', 1),
('199506202018024', 'Dimas Wahyu Wibowo', 'dimas.wibowo@email.com', 'Tetap', 'Lektor', 'dosen', 1),
('198708192012025', 'Dinny Wahyu Widarti', 'dinny.widarti@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('198602072009026', 'Widaningsih Condrowardhani', 'widaningsih@email.com', 'Tetap', 'Lektor Kepala', 'komdis', 1),
('198904082016027', 'Elok Nur Hamdana', 'elok.hamdana@email.com', 'Tetap', 'Guru Besar', 'dpa', 1),
('198911122014028', 'Ely Setyo Astuti', 'ely.astuti@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199108102017029', 'Erfan Rohadi', 'erfan.rohadi@email.com', 'Tetap', 'Lektor', 'komdis', 1),
('199206082018030', 'Evi Fajriantina Lova', 'evi.lova@email.com', 'Tetap', 'Guru Besar', 'dosen', 1),
('199401122015031', 'Farid Angga Pribadi', 'farid.pribadi@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199207092018032', 'Farida Ulfa', 'farida.ulfa@email.com', 'Tetap', 'Lektor Kepala', 'komdis', 1),
('199110192016033', 'Habibie Ed Dien', 'habibie.dien@email.com', 'Tetap', 'Guru Besar', 'dosen', 1),
('199307222017034', 'Hasyim Ratsanjani', 'hasyim.ratsanjani@email.com', 'Kontrak', 'Lektor', 'dpa', 1),
('199208112013035', 'Hendra Pradibta', 'hendra.pradibta@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199001252015036', 'Imam Fahrur Rozi', 'imam.rozi@email.com', 'Tetap', 'Guru Besar', 'komdis', 1),
('199306112017037', 'Indra Dharma Wijaya', 'indra.wijaya@email.com', 'Tetap', 'Lektor Kepala', 'dosen', 1),
('199209202014038', 'Luqman Affandi', 'luqman.affandi@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199112152016039', 'M. Hasyim Ratsanjani', 'm.hasyim@email.com', 'Kontrak', 'Lektor', 'komdis', 1),
('198910222010040', 'Mahmud Yunus', 'mahmud.yunus@email.com', 'Tetap', 'Lektor Kepala', 'dpa', 1),
('198806212011041', 'Mamluatul Haniah', 'mamluatul.haniah@email.com', 'Tetap', 'Guru Besar', 'dosen', 1),
('199312152017042', 'Muhammad Afif Hendrawan', 'afif.hendrawan@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199105292016043', 'Muhammad Unggul Pamenang', 'unggul.pamenang@email.com', 'Tetap', 'Lektor Kepala', 'komdis', 1),
('199006202015044', 'Mungki Astiningrum', 'mungki.astiningrum@email.com', 'Kontrak', 'Guru Besar', 'dosen', 1),
('199012252016045', 'Pramana Yoga Saputra', 'pramana.saputra@email.com', 'Tetap', 'Lektor', 'dpa', 1),
('198912022013046', 'Priska Choirina', 'priska.choirina@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199202082015047', 'Rakhmat Arianto', 'rakhmat.arianto@email.com', 'Tetap', 'Lektor Kepala', 'komdis', 1),
('198710202012048', 'Renaldi Primaswara Prasetya', 'renaldi.prasetya@email.com', 'Tetap', 'Guru Besar', 'dosen', 1),
('199301252017049', 'Retno Damayanti', 'retno.damayanti@email.com', 'Tetap', 'Lektor', 'dpa', 1),
('199207082014050', 'Rokiyah', 'rokiyah@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199110222016051', 'Rosa Andrie Asmara', 'rosa.asmara@email.com', 'Tetap', 'Lektor Kepala', 'komdis', 1),
('198912112013052', 'Samsul Arifin', 'samsul.arifin@email.com', 'Tetap', 'Guru Besar', 'dosen', 1),
('199308212017053', 'Satrio Binusa', 'satrio.binusa@email.com', 'Kontrak', 'Asisten Ahli', 'dosen', 1),
('198911122014054', 'Sofyan Noor Arief', 'sofyan.arief@email.com', 'Tetap', 'Lektor', 'komdis', 1),
('199112082016055', 'Triana Fatmawati', 'triana.fatmawati@email.com', 'Tetap', 'Guru Besar', 'dosen', 1),
('199312202018056', 'Ulla Delfana Rosiani', 'ulla.rosiani@email.com', 'Tetap', 'Lektor Kepala', 'dpa', 1),
('198801122012057', 'Usman Nurhasan', 'usman.nurhasan@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199011152016058', 'Vipkas Al Hadid Firdaus', 'vipkas.firdaus@email.com', 'Tetap', 'Guru Besar', 'komdis', 1),
('199305082018059', 'Vivi Nur Wijayaningrum', 'vivi.wijayaningrum@email.com', 'Tetap', 'Lektor', 'dosen', 1),
('199008212014060', 'Widaningsih Condrowardhani', 'widaningsih.condro@email.com', 'Tetap', 'Asisten Ahli', 'komdis', 1),
('199211102017061', 'Wilda Imama Sabilla', 'wilda.sabilla@email.com', 'Tetap', 'Guru Besar', 'dosen', 1),
('199312012018062', 'Yan Watequlis Syaifudin', 'yan.syaifudin@email.com', 'Tetap', 'Lektor Kepala', 'dpa', 1),
('198806302012063', 'Yoppy Yunhasnawa', 'yoppy.yunhasnawa@email.com', 'Tetap', 'Asisten Ahli', 'dosen', 1),
('199101222015064', 'Yuri Ariyanto', 'yuri.ariyanto@email.com', 'Tetap', 'Guru Besar', 'komdis', 1);
USE sistatib;
DBCC CHECKIDENT ('usertatib', RESEED, 0);
TRUNCATE TABLE usertatib;

ALTER TABLE usertatib NOCHECK CONSTRAINT ALL;
ALTER TABLE usertatib CHECK CONSTRAINT ALL;



INSERT INTO usertatib (username, passwordusr, id_mahasiswa, id_dosen, id_admin) VALUES
('2341764853', 'Budikuat1', 1, NULL, 1), -- Budi Santoso
('2341782935', 'AniRah23', 2, NULL, 1), -- Ani Rahmawati
('2341797419', 'Candra56', 3, NULL, 1); -- Candra Permana

SELECT id_dosen, nidn, nama_dosen FROM dosen;
INSERT INTO usertatib (username, passwordusr, id_mahasiswa, id_dosen, id_admin) VALUES
('198101020501001', 'Adeade567', NULL, 2, 1), -- Ade Ismail
('198502152101002', 'Fairuz90', NULL, 3, 1), -- Adevian Fairuz Pratama
('199001202015003', 'AgungNu45', NULL, 4, 1); -- Agung Nugroho Pramudhita

INSERT INTO datapelanggaran (id_mahasiswa, deskripsi_pelanggaran, tingkat_pelanggaran, id_admin) VALUES
(1, 'Tidak hadir dalam kegiatan wajib kampus tanpa alasan', '2', 1), -- Budi Santoso
(2, 'Menggunakan fasilitas kampus secara tidak semestinya', '3', 1), -- Ani Rahmawati
(3, 'Melanggar aturan penggunaan seragam', '1', 1); -- Candra Permana

INSERT INTO tebusan (id_pelanggaran, kegiatan_tebusan, tanggal_tebusan, id_admin) VALUES
(1, 'Mengikuti seminar etika profesional', '2024-12-02', 1), -- Untuk pelanggaran Budi Santoso
(2, 'Melakukan kerja sosial di lingkungan kampus', '2024-12-01', 1), -- Untuk pelanggaran Ani Rahmawati
(3, 'Membersihkan Lobi Jurusan', '2024-12-10', 1); -- Untuk pelanggaran Candra Permana

INSERT INTO komdis_pelanggaran (id_pelanggaran, keputusan, tanggal_keputusan, id_admin) VALUES
(1, 'Cuti', '2024-04-01', 1), -- Untuk pelanggaran Budi Santoso
(2, 'Lanjut', '2024-05-01', 1), -- Untuk pelanggaran Ani Rahmawati
(3, 'DO', '2024-06-01', 1); -- Untuk pelanggaran Candra Permana

