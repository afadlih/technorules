<?php
$judul = "Kelas | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = false;

include "common/components/layouts/dpa.php";
?>

<main class="ml-16 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <?php
    require_once "views/dosen/components/tebusan-pelanggaran.php";
    ?>
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php
        require_once "common/components/profile-card/dpa.php";
        ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">
                Data Pelaporan
                <?php echo isset($_SESSION["class"]) ? $_SESSION["class"] : "TI-2H"; ?>
            </h4>
            <?php
            require_once "views/dosen/components/pelaporan.php";
            ?>
        </div>
    </section>
</main>