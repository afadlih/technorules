<?php
require_once "./controller/mahasiswaController.php";

$judul = "Pesan | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = false;

include "common/components/layouts/mahasiswa.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/mahasiswa.php"; ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">
                Data Pelanggaran Tingkat 1
            </h4>
            <?php if (count($violations) > 0): ?>
            <?php require_once "views/mahasiswa/components/tabel-pelanggaran-tingkat1.php"; ?>
            <?php else: ?>
            <h5 class="mt-4 text-center">Tidak ada pelanggaran tingkat 1 dilakukan.</h5>
            <?php endif; ?>
        </div>
    </section>
</main>