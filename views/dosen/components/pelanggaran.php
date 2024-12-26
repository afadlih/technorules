<table class="mt-5 mb-8 w-full text-left text-sm rounded-lg overflow-hidden">
    <thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2">No</th>
            <th class="px-4 py-2">NIM</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Deskripsi</th>
            <th class="px-4 py-2">Tingkat</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            require_once "./controller/dataPelanggaran_controller.php";

            if (!empty($dataPelanggaran)) {
                $no = 1;
                foreach ($dataPelanggaran as $data) {
                    echo "<tr class='cursor-default border-b-2 border-[#eceff2]'>
                        <td class='px-4 py-2'>{$no}</td>
                        <td class='px-4 py-2'>{$data['nim']}</td>
                        <td class='px-4 py-2'>{$data['nama_mahasiswa']}</td>
                        <td class='px-4 py-2'>{$data['deskripsi_pelanggaran']}</td>
                        <td class='px-4 py-2'>{$data['tingkat_pelanggaran']}</td>
                        <td class='flex items-center gap-6 px-4 py-2'>
                            <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' onclick='openEditModal(\"{$data['nim']}\", \"{$data['nama_mahasiswa']}\", \"{$data['deskripsi_pelanggaran']}\", \"{$data['tingkat_pelanggaran']}\")'></i>
                            <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]'></i>
                        </td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Tidak ada data pelanggaran</td></tr>";
            }
        ?>
    </tbody>
</table>

<div class="flex justify-end">
    <button onclick="openAddModal()" class="px-6 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
        Tambah Pelanggaran
    </button>
</div>

<!-- Modal Edit -->
<section class="z-50 fixed inset-0 bg-black/50" id="edit-modal" style="display: none">
    <div class="w-full max-w-lg my-10 mx-auto p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Edit Data Pelanggaran
        </h3>
        <form action="../../../technorules/controller/dataPelanggaran_controller.php" method="post" class="w-full flex flex-col gap-y-4">
            <div class="flex flex-col w-full">
                <label for="edit-nim" class="text-left text-sm font-medium text-gray-700">
                    NIM
                </label>
                <input
                    type="text"
                    name="nim"
                    id="edit-nim"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    readonly
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-nama" class="text-left text-sm font-medium text-gray-700">
                    Nama Mahasiswa
                </label>
                <input
                    type="text"
                    name="nama"
                    id="edit-nama"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    readonly
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-deskripsi" class="text-left text-sm font-medium text-gray-700">
                    Deskripsi Pelanggaran
                </label>
                <input
                    type="text"
                    min="0"
                    name="deskripsi_pelanggaran"
                    id="edit-deskripsi"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required    
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-tingkat" class="text-left text-sm font-medium text-gray-700">
                    Tingkat Pelanggaran
                </label>
                <input
                    type="text"
                    min="0"
                    name="tingkat_pelanggaran"
                    id="edit-tingkat"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required    
                />
            </div>
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeEditModal()"
                    class="px-4 py-2 border-2 border-[#647993] text-[#647993] rounded-md transition-all duration-300 ease-in-out hover:bg-gray-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                >
                    Kembali
                </button>
                <button
                    type="submit"
                    class="px-6 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</section>

<!-- Modal Tambah -->
<section class="z-50 fixed inset-0 bg-black/50" id="add-modal" style="display: none">
    <div class="w-full max-w-lg my-10 mx-auto p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Tambah Data Pelanggaran
        </h3>
        <form action="../../../technorules/controller/dataPelanggaran_controller.php" method="post" class="w-full flex flex-col gap-y-4">
            <div class="flex flex-col w-full">
                <label for="add-nim" class="text-left text-sm font-medium text-gray-700">
                    NIM
                </label>
                <input
                    type="text"
                    name="nim"
                    id="add-nim"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="add-nama" class="text-left text-sm font-medium text-gray-700">
                    Nama Mahasiswa
                </label>
                <input
                    type="text"
                    name="nama"
                    id="add-nama"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="add-deskripsi" class="text-left text-sm font-medium text-gray-700">
                    Deskripsi Pelanggaran
                </label>
                <input
                    type="text"
                    name="deskripsi_pelanggaran"
                    id="add-deskripsi"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="add-tingkat" class="text-left text-sm font-medium text-gray-700">
                    Tingkat Pelanggaran
                </label>
                <input
                    type="text"
                    name="tingkat_pelanggaran"
                    id="add-tingkat"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeAddModal()"
                    class="px-4 py-2 border-2 border-[#647993] text-[#647993] rounded-md transition-all duration-300 ease-in-out hover:bg-gray-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                >
                    Kembali
                </button>
                <button
                    type="submit"
                    class="px-6 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                >
                    Simpan
                </button>
            </div>
        </form>
    </div>
</section>

<script>
function openEditModal(nim, nama, deskripsi, tingkat) {
    document.getElementById('edit-nim').value = nim;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-deskripsi').value = deskripsi;
    document.getElementById('edit-tingkat').value = tingkat;
    document.getElementById('edit-modal').style.display = 'block';
}

function closeEditModal() {
    document.getElementById('edit-modal').style.display = 'none';
}

function openAddModal() {
    document.getElementById('add-modal').style.display = 'block';
}

function closeAddModal() {
    document.getElementById('add-modal').style.display = 'none';
}
</script>