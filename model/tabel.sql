CREATE TABLE prodi (
	id_prodi INT PRIMARY KEY IDENTITY(1,1),
	nama_prodi VARCHAR(50)
);

GO

CREATE TABLE mahasiswa (
	id_mahasiswa INT PRIMARY KEY IDENTITY(1,1),
	nim VARCHAR(15),
	nama_mahasiswa VARCHAR(50),
	kelas VARCHAR(50),
	status_mhs VARCHAR(20),
	id_prodi INT FOREIGN KEY REFERENCES prodi(id_prodi)
);

CREATE TABLE dosen (
	id_dosen INT PRIMARY KEY IDENTITY(1,1),
	nidn VARCHAR(15),
	nama_dosen VARCHAR(50),
	email VARCHAR(50),
	status_dosen VARCHAR(20)
);

CREATE TABLE komdis (
	id_komdis INT PRIMARY KEY IDENTITY(1,1),
	nama_komdis VARCHAR(50),
	nip VARCHAR(15),
	email VARCHAR(50),
	status_komdis VARCHAR(20)
);

CREATE TABLE usertatib (
	id_user INT PRIMARY KEY IDENTITY(1,1),
	username VARCHAR(50),
	passwordusr VARCHAR(50),
	id_mahasiswa INT FOREIGN KEY REFERENCES mahasiswa(id_mahasiswa),
	id_dosen INT FOREIGN KEY REFERENCES dosen(id_dosen),
	id_komdis INT FOREIGN KEY REFERENCES komdis(id_komdis)
);

CREATE TABLE datapelanggaran (
    id_pelanggaran INT PRIMARY KEY IDENTITY(1,1),
    id_mahasiswa INT NOT NULL FOREIGN KEY REFERENCES mahasiswa(id_mahasiswa),
    deskripsi_pelanggaran VARCHAR(255),
    tingkat_pelanggaran VARCHAR(10) CHECK (tingkat_pelanggaran IN ('1', '2', '3', '4', '5'))
);

CREATE TABLE tebusan (
    id_tebusan INT PRIMARY KEY IDENTITY(1,1),
    id_pelanggaran INT NOT NULL FOREIGN KEY REFERENCES datapelanggaran(id_pelanggaran),
    kegiatan_tebusan VARCHAR(50),
    tanggal_tebusan DATE
);

CREATE TABLE pelaporan (
    id_pelaporan INT PRIMARY KEY IDENTITY(1,1),
    id_dosen INT NOT NULL FOREIGN KEY REFERENCES dosen(id_dosen),
    id_mahasiswa INT NOT NULL FOREIGN KEY REFERENCES mahasiswa(id_mahasiswa),
    jumlah_pelanggaran INT,
    kegiatan_tebusan VARCHAR(50)
);

CREATE TABLE komdis_pelanggaran (
    id_pelaporan INT PRIMARY KEY IDENTITY(1,1),
    id_komdis INT NOT NULL FOREIGN KEY REFERENCES komdis(id_komdis),
    id_pelanggaran INT NOT NULL FOREIGN KEY REFERENCES datapelanggaran(id_pelanggaran),
    keputusan VARCHAR(50) CHECK (keputusan IN ('Cuti', 'DO', 'Lanjut')),
    tanggal_keputusan DATE
);

CREATE TABLE admintatib (
    id_admin INT PRIMARY KEY IDENTITY(1,1),
    nip VARCHAR(20),
    password_admin VARCHAR(50)
);


