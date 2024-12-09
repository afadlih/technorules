<?php
require_once "controller/connection.php";
require_once "model/admin.php";

$admin = new Admin($conn);
$dashboardData = $admin->getDashboardData();
$recentViolations = $admin->getRecentViolations();
?>

<section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-blue-100 p-4 rounded-lg">
        <h3 class="font-bold text-lg">Total Mahasiswa</h3>
        <p class="text-2xl"><?php echo $dashboardData['total_mahasiswa']; ?></p>
    </div>
    <div class="bg-red-100 p-4 rounded-lg">
        <h3 class="font-bold text-lg">Total Pelanggaran</h3>
        <p class="text-2xl"><?php echo $dashboardData['total_pelanggaran']; ?></p>
    </div>
    <div class="bg-green-100 p-4 rounded-lg">
        <h3 class="font-bold text-lg">Total Dosen</h3>
        <p class="text-2xl"><?php echo $dashboardData['total_dosen']; ?></p>
    </div>
</section>
<h3 class="font-bold text-lg mb-4">Pelanggaran Terbaru</h3>
<table class="w-full border-collapse bg-white text-left shadow-lg rounded-lg overflow-hidden">
    <thead class="bg-blue-600 text-white uppercase text-sm">
        <tr>
            <th class="px-6 py-3 border-b">NIM</th>
            <th class="px-6 py-3 border-b">Nama</th>
            <th class="px-6 py-3 border-b">Kelas</th>
            <th class="px-6 py-3 border-b">Pelanggaran</th>
            <th class="px-6 py-3 border-b">Tingkat</th>
            <th class="px-6 py-3 border-b">Keputusan</th>
            <th class="px-6 py-3 border-b">Tebusan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (!empty($recentViolations)) {
            foreach ($recentViolations as $violation) {
                echo "<tr>
                        <td class='px-6 py-3 border-b'>{$violation['nim']}</td>
                        <td class='px-6 py-3 border-b'>{$violation['nama_mahasiswa']}</td>
                        <td class='px-6 py-3 border-b'>{$violation['kelas']}</td>
                        <td class='px-6 py-3 border-b'>{$violation['deskripsi_pelanggaran']}</td>
                        <td class='px-6 py-3 border-b'>{$violation['tingkat_pelanggaran']}</td>
                        <td class='px-6 py-3 border-b'>{$violation['keputusan']}</td>
                        <td class='px-6 py-3 border-b'>{$violation['kegiatan_tebusan']}</td>
                    </tr>";
            }
        } else {
            echo "<tr>
                    <td colspan='7' class='text-center px-6 py-3 border-b'>Tidak ada pelanggaran terbaru</td>
                  </tr>";
        }
        ?>
    </tbody>
</table>