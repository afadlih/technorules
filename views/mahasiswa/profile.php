<?php
session_start();
require_once "controller/connection.php"; // Ensure this file contains the $conn connection
require_once "model/mahasiswa.php";

$judul = "Profil | Tata Tertib Polinema";
$deskripsi = "Selamat datang di Tata Tertib Polinema.";
$halaman_khusus = false;

include "common/components/layouts/mahasiswa.php";

$mahasiswaModel = new Mahasiswa($conn);
$profile = $mahasiswaModel->getProfile($_SESSION['id_mahasiswa']);

if (!$profile) {
    // Handle the case where the profile is not found
    $profile = [
        'nama_mahasiswa' => 'Data tidak ditemukan',
        'nama_prodi' => 'Data tidak ditemukan',
        'nim' => 'Data tidak ditemukan',
        'kelas' => 'Data tidak ditemukan',
        'status_nama' => 'Data tidak ditemukan'
    ];
}
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <h4 class="mx-auto mt-8 w-[90%] text-3xl font-bold cursor-default text-[#414f63]">
            Profil Saya
        </h4>
        <?php require_once "views/mahasiswa/components/profil-mahasiswa.php"; ?>
        <button class="mt-8 w-fit ml-[5%] px-7 py-2.5 font-semibold rounded bg-[#0a97ff] text-[#d2efff]">
            Edit Profil
        </button>
    </section>
</main>