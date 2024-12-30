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
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">Data Pelaporan</h4>
            
            <?php
            $selectedProdi = isset($_SESSION['dataKelas']) ? $_SESSION['dataKelas'][0]['id_prodi'] ?? '' : '';
            $selectedKelas = isset($_SESSION['dataKelas']) ? $_SESSION['dataKelas'][0]['kelas'] ?? '' : '';
            ?>

            <form action="/technorules/controller/dosenController.php" method="POST" class="mt-6 flex justify-center gap-4">
                <div class="w-64">
                    <label for="id_prodi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                    <select id="id_prodi" name="id_prodi" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                        <option value="" disabled <?php echo empty($selectedProdi) ? 'selected' : ''; ?>>Pilih Program Studi</option>   
                        <option value="1" <?php echo $selectedProdi == '1' ? 'selected' : ''; ?>>D4 Teknik Informatika</option>
                        <option value="2" <?php echo $selectedProdi == '2' ? 'selected' : ''; ?>>D4 Sistem Informasi Bisnis</option>
                        <option value="3" <?php echo $selectedProdi == '3' ? 'selected' : ''; ?>>D2 Pengembangan Piranti Lunak Situs</option>
                    </select>
                </div>

                <div class="w-64">
                    <label for="kelas" class="block text-sm font-medium text-gray-700">Kelas</label>
                    <select id="kelas" name="kelas" class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                    <option value="" disabled <?php echo empty($selectedKelas) ? 'selected' : ''; ?>>Pilih Kelas</option>
                    <option value="1A" <?php echo $selectedKelas == '1A' ? 'selected' : ''; ?>>1A</option>
                    <option value="1B" <?php echo $selectedKelas == '1B' ? 'selected' : ''; ?>>1B</option>
                    <option value="1C" <?php echo $selectedKelas == '1C' ? 'selected' : ''; ?>>1C</option>
                    <option value="1D" <?php echo $selectedKelas == '1D' ? 'selected' : ''; ?>>1D</option>
                    <option value="1E" <?php echo $selectedKelas == '1E' ? 'selected' : ''; ?>>1E</option>
                    <option value="1F" <?php echo $selectedKelas == '1F' ? 'selected' : ''; ?>>1F</option>
                    <option value="1G" <?php echo $selectedKelas == '1G' ? 'selected' : ''; ?>>1G</option>
                    <option value="1H" <?php echo $selectedKelas == '1H' ? 'selected' : ''; ?>>1H</option>
                    <option value="2A" <?php echo $selectedKelas == '2A' ? 'selected' : ''; ?>>2A</option>
                    <option value="2B" <?php echo $selectedKelas == '2B' ? 'selected' : ''; ?>>2B</option>
                    <option value="2C" <?php echo $selectedKelas == '2C' ? 'selected' : ''; ?>>2C</option>
                    <option value="2D" <?php echo $selectedKelas == '2D' ? 'selected' : ''; ?>>2D</option>
                    <option value="3A" <?php echo $selectedKelas == '3A' ? 'selected' : ''; ?>>3A</option>
                    <option value="3B" <?php echo $selectedKelas == '3B' ? 'selected' : ''; ?>>3B</option>
                    <option value="3C" <?php echo $selectedKelas == '3C' ? 'selected' : ''; ?>>3C</option>
                    <option value="3D" <?php echo $selectedKelas == '3D' ? 'selected' : ''; ?>>3D</option>
                    <option value="4A" <?php echo $selectedKelas == '4A' ? 'selected' : ''; ?>>4A</option>
                    <option value="4B" <?php echo $selectedKelas == '4B' ? 'selected' : ''; ?>>4B</option>
                    <option value="4C" <?php echo $selectedKelas == '4C' ? 'selected' : ''; ?>>4C</option>
                    <option value="4D" <?php echo $selectedKelas == '4D' ? 'selected' : ''; ?>>4D</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit" class="px-6 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                        Cari
                    </button>
                </div>
            </form>

            <?php
            $dataKelas = $_SESSION['dataKelas'] ?? [];
            require_once "views/dosen/components/pelaporanKelas.php";
            ?>
        </div>
    </section>
</main>