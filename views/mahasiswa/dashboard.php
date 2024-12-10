<?php
session_start();
require_once "controller/connection.php"; // Ensure this file contains the $conn connection
require_once "model/mahasiswa.php";

$judul = "Dashboard | Tata Tertib Polinema";
$deskripsi = "Selamat datang di Tata Tertib Polinema.";
$halaman_khusus = false;

include "common/components/layouts/mahasiswa.php";

if (isset($_SESSION['id_mahasiswa'])) {
    $mahasiswaModel = new Mahasiswa($conn);
    $profile = $mahasiswaModel->getProfile($_SESSION['id_mahasiswa']);
    $violations = $mahasiswaModel->getViolations($_SESSION['id_mahasiswa']);
} else {
    // Handle the case where the session variable is not set
    $profile = null;
    $violations = [];
}
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/mahasiswa.php"; ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">
                Data Pelaporan <?php echo $profile ? $profile['nama_mahasiswa'] : ''; ?>
            </h4>
            <?php if (count($violations) > 0): ?>
            <?php require_once "views/mahasiswa/components/tabel-pelanggaran.php"; ?>
            <?php else: ?>
            <h5 class="mt-4 text-center">Tidak ada pelanggaran.</h5>
            <?php endif; ?>
        </div>
    </section>
</main>