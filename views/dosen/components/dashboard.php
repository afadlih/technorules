<?php
    require_once "controller/connection.php";
    require_once "model/dosen.php";

    $dosen = new Dosen($conn);
    $dataDashboard = $dosen->getDashboard();
?>

<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden border-2 border-[#afbbca]">
    <thead class="cursor-default bg-[#0242a6] text-white">        
        <tr>
            <th class="pl-4 py-2 text-center">No</th>
            <th class="px-4 py-2 text-center">NIM</th>
            <th class="px-4 py-2 text-center">Nama</th>
            <th class="px-4 py-2 text-center">Kelas</th>
            <th class="px-4 py-2 text-center">Pelanggaran</th>
            <th class="px-4 py-2 text-center">Tingkat</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($dataDashboard)) {
            $no = 1;
            foreach ($dataDashboard as $data) {
                echo "<tr>
                    <td class='pl-4 py-2 text-center border-b border-[#e4e8ed]'>{$no}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$data['nim']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$data['nama_mahasiswa']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$data['kelas']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$data['deskripsi_pelanggaran']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$data['tingkat_pelanggaran']}</td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='6' class='text-center border-b border-[#e4e8ed]'>Tidak ada pelanggaran terbaru</td></tr>";
        }
        ?>
    </tbody>
</table>