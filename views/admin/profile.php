<?php
$judul = "Profil | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = false;

include "common/components/layouts/admin.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <h4 class="mx-auto mt-8 w-[90%] text-3xl font-bold cursor-default text-[#414f63]">
            Profil Saya
        </h4>
        <?php require_once "views/dosen/components/profil-dpa.php"; ?>
        <button class="mt-8 w-fit ml-[5%] px-7 py-2.5 font-semibold rounded bg-[#0a97ff] text-[#d2efff]">
            Edit Profil
        </button>
    </section>
</main>