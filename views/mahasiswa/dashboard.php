<?php
require_once "./controller/mahasiswaController.php";

$judul = "Dashboard | Tata Tertib Polinema";
$deskripsi = "Selamat datang di Tata Tertib Polinema.";
$halaman_khusus = false;

include "common/components/layouts/mahasiswa.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/mahasiswa.php"; ?>
        <?php if ($profile['kelas'] == '-'): ?>
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h4 class="text-xl font-bold mb-4 text-center">Perhatian!</h4>
                <p class="mb-4 text-center">Data Anda belum diverifikasi oleh admin.</p>
                <p class="mb-4 text-center">Mohon tunggu atau hubungi admin di:</p>
                <div class="flex flex-col items-center gap-2">
                    <p>1. WhatsApp: <a href="https://wa.me/6281234567890" class="text-blue-500 hover:text-blue-700">081234567890</a></p>
                    <p>2. Gmail: <a href="mailto:admin@technorules.com" class="text-blue-500 hover:text-blue-700">admin@technorules.com</a></p>
                </div>
                <button onclick="this.parentElement.parentElement.style.display='none'" class="mt-6 w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tutup</button>
            </div>
        </div>
        <?php endif; ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">
                Data Pelanggaran
            </h4>
            <?php if (count($violations) > 0): ?>
            <?php require_once "views/mahasiswa/components/tabel-pelanggaran.php"; ?>
            <?php else: ?>
            <h5 class="mt-4 text-center">Tidak ada pelanggaran dilakukan.</h5>
            <?php endif; ?>
        </div>
    </section>
</main>