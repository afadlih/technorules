<?php
$judul = "Dashboard | Tata Tertib Polinema";
$deskripsi = "Selamat datang di Tata Tertib Polinema.";
$halaman_khusus = false;

include "common/components/layouts/mahasiswa.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/mahasiswa.php"; ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">Data Pelaporan</h4>
            <?php
            require_once "views/mahasiswa/components/tabel-pelanggaran.php";
            ?>
        </div>
    </section>
</main>