<?php
$judul = "Dashboard | Tata Tertib Polinema";
$deskripsi = "Selamat datang di Tata Tertib Polinema.";
$halaman_khusus = false;

include "common/components/layouts/dpa.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/dpa.php"; ?>
        <object
            data="https://jti.polinema.ac.id/wp-content/uploads/2024/11/Pedoman-Akademik-D4-Teknik-Informatika-2023-2024-Final.pdf"
            type="application/pdf"
            class="w-[90%] mx-auto h-[80vh] my-5"
        ></object>
    </section>
</main>