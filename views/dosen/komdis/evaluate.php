<?php
$judul = "Evaluate | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = false;

include "common/components/layouts/komdis.php";
require_once "./controller/dataPelanggaran_controller.php";
require_once "./model/dosen.php";

$dosen = new Dosen($conn);
$pelanggaranTingkat1 = $dosen->getPelanggaranTingkat1();
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/dpa.php"; ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">Data Pelanggaran Tingkat 1</h4>
            <table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden">
                <thead class="cursor-default bg-[#0242a6] text-white">
                    <tr>
                        <th class="pl-4 py-2">No</th>
                        <th class="px-4 py-2">NIM</th>
                        <th class="px-4 py-2">Nama</th>
                        <th class="px-4 py-2">Deskripsi</th>
                        <th class="px-4 py-2">Tanggal</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pelanggaranTingkat1 as $index => $pelanggaran) { ?>
                        <tr class="cursor-default border-b-2 border-[#eceff2]">
                            <td class="px-4 py-2"><?php echo $index + 1; ?></td>
                            <td class="px-4 py-2"><?php echo $pelanggaran['nim']; ?></td>
                            <td class="px-4 py-2"><?php echo $pelanggaran['nama_mahasiswa']; ?></td>
                            <td class="px-4 py-2"><?php echo $pelanggaran['deskripsi_pelanggaran']; ?></td>
                            <td class="px-4 py-2"><?php echo $pelanggaran['tanggal_pelanggaran']; ?></td>
                            <td class="px-4 py-2">
                                <a href="evaluate.php?id=<?php echo $pelanggaran['id_pelanggaran']; ?>" class="px-4 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    Evaluate
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>