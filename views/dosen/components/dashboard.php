<?php
    require_once "controller/connection.php";
    require_once "model/dosen.php";

    $dosen = new Dosen($conn);
    $dataDashboard = $dosen->getDashboard();
?>

<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden">
    <thead class="cursor-default bg-[#0242a6] text-white">        
        <tr>
            <th class="pl-4 py-2">No</th>
            <th class="px-4 py-2">NIM</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Kelas</th>
            <th class="px-4 py-2">Pelanggaran</th>
            <th class="px-4 py-2">Tingkat</th>
        </tr>
    </thead>
    <tbody>
        <!-- <tr class="cursor-default border-b-2 border-[#eceff2]">
            <td class="px-4 py-2">1</td>
            <td class="px-4 py-2">Berbusana tidak sopan.</td>
            <td class="px-4 py-2">III</td>
        </tr>
        <tr class="cursor-default border-b-2 border-[#eceff2]">
            <td class="px-4 py-2">2</td>
            <td class="px-4 py-2">Berkata tidak sopan.</td>
            <td class="px-4 py-2">V</td>
        </tr> -->
        <?php
        if (!empty($dataDashboard)) {
            $no = 1;
            foreach ($dataDashboard as $data) {
                echo "<tr>
                    <td>{$no}</td>
                    <td>{$data['nim']}</td>
                    <td>{$data['nama_mahasiswa']}</td>
                    <td>{$data['kelas']}</td>
                    <td>{$data['deskripsi_pelanggaran']}</td>
                    <td>{$data['tingkat_pelanggaran']}</td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>Tidak ada pelanggaran terbaru</td></tr>";
        }
        ?>
    </tbody>
</table>