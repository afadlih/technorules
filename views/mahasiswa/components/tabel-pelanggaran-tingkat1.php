<?php
require_once './controller/mahasiswaController.php';

?>

<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden mx-auto border-2 border-[#afbbca]">
    <thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2 text-center">No</th>
            <th class="px-4 py-2 text-center">Deskripsi Pelanggaran</th>
            <th class="px-4 py-2 text-center">Tingkat Pelanggaran</th>
            <th class="px-4 py-2 text-center">Tanggal Keputusan</th>
            <th class="px-4 py-2 text-center">Keputusan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        if (count($topViolations) > 0) {
            foreach ($topViolations as $topViolation) {
                echo "<tr>
                    <td class='pl-4 py-2 text-center border-b border-[#e4e8ed]'>" . $no++ . "</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$topViolation['deskripsi_pelanggaran']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$topViolation['tingkat_pelanggaran']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$topViolation['tanggal_keputusan']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$topViolation['keputusan']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5' class='px-4 py-2 text-center border-b border-[#e4e8ed]'>Tidak ada pelanggaran dilakukan.</td></tr>";
        }
        ?>
    </tbody>
</table>