<?php

// Informasi koneksi database
$servername = "34.170.236.243,1433";
$username = "sqlserver";
$password = "87654321";
$dbname = "sistatib";

// Buat koneksi menggunakan PDO
try {
    $conn = new PDO("sqlsrv:Server=$servername;Database=$dbname", $username, $password);
    // Set error mode ke exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Koneksi berhasil";
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Tutup koneksi
$conn = null;
