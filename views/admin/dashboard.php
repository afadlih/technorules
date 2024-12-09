<?php
$judul = "Dashboard | Tata Tertib Polinema";
$deskripsi = "Selamat datang di Tata Tertib Polinema.";
$halaman_khusus = false;

include "common/components/layouts/admin.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/admin.php"; ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">Pelanggaran</h4>
            <?php
            require_once "controller/connection.php";
            require_once "model/admin.php";

            $admin = new Admin($conn);
            $dashboardData = $admin->getDashboardData();
            $recentViolations = $admin->getRecentViolations();
            ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
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
            </div>
            <!-- Recent Violations Table -->
            <div class="mt-8">
                <h3 class="font-bold text-lg mb-4">Pelanggaran Terbaru</h3>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>Pelanggaran</th>
                            <th>Tingkat</th>
                            <th>Keputusan</th>
                            <th>Tebusan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    if (!empty($recentViolations)) {
                        foreach ($recentViolations as $violation) {
                            echo "<tr>
                                <td>{$violation['nim']}</td>
                                <td>{$violation['nama_mahasiswa']}</td>
                                <td>{$violation['kelas']}</td>
                                <td>{$violation['deskripsi_pelanggaran']}</td>
                                <td>{$violation['tingkat_pelanggaran']}</td>
                                <td>{$violation['keputusan']}</td>
                                <td>{$violation['kegiatan_tebusan']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>Tidak ada pelanggaran terbaru</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>