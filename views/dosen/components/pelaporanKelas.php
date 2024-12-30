<?php

if (isset($_GET['status']) && isset($_GET['message'])) {
    $status = $_GET['status'];
    $message = $_GET['message'];
    
    if ($status == 'success') {
        echo "<div id='alert' class='fixed top-4 left-1/2 transform -translate-x-1/2 p-4 text-sm text-green-700 bg-green-100 rounded-lg shadow-lg z-50'>{$message}</div>";
    } else if ($status == 'error') {
        echo "<div id='alert' class='fixed top-4 left-1/2 transform -translate-x-1/2 p-4 text-sm text-red-700 bg-red-100 rounded-lg shadow-lg z-50'>{$message}</div>";
    }
    
    echo "<script>
        setTimeout(function() {
            document.getElementById('alert').style.opacity = '0';
            document.getElementById('alert').style.transition = 'opacity 0.5s';
            setTimeout(function() {
                document.getElementById('alert').remove();
            }, 500);
        }, 5000);
    </script>";
}

?>

<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden mx-auto border-2 border-[#afbbca]">
    <thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2 text-center">No</th>
            <th class="px-4 py-2 text-center">NIM</th>
            <th class="px-4 py-2 text-center">Nama</th>
            <th class="px-4 py-2 text-center">Deskripsi Pelanggaran</th>
            <th class="px-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once "./controller/dosenController.php";

        if (!empty($dataKelas)) {
            $no = 1;
            foreach ($dataKelas as $data) {
                echo "<tr>
                    <td class='pl-4 py-2 text-center border-b border-[#e4e8ed]'>{$no}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$data['nim']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$data['nama_mahasiswa']}</td>
                    <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$data['deskripsi_pelanggaran']}</td>
                    <td class='px-4 py-2 h-full border-b border-[#e4e8ed]'>
                        <div class='flex items-center justify-center gap-6'>
                            <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' 
                            onclick='openEditModal(\"{$data['nim']}\", \"{$data['nama_mahasiswa']}\", \"{$data['deskripsi_pelanggaran']}\", \"{$data['id_pelanggaran']}\")'></i>
                            <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]' 
                            onclick='openDeleteModal(\"{$data['id_pelanggaran']}\")'></i>
                        </div>
                    </td>
                </tr>";
                $no++;
            }
        } else {
            echo "<tr><td colspan='5' class='text-center border-b border-[#e4e8ed]'>Tidak ada data pelanggaran</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- Modal Edit -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="edit-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Edit Data Pelanggaran
        </h3>
        <form action="/technorules/controller/dosen/pelaporanKelas.php?method=update" method="post" class="w-full flex flex-col gap-y-4">
            <input type="hidden" name="id_pelanggaran" id="edit-id-pelanggaran">
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

<!-- Modal Delete -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="delete-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Hapus Pelanggaran
        </h3>
        <p class="text-xl font-normal mb-6 text-gray-600">
            Apakah anda yakin untuk menghapus data pelanggaran?
        </p>
        <form action="/technorules/controller/dosen/pelaporanKelas.php?method=delete" method="post" class="w-full flex flex-col gap-y-4">
            <input type="hidden" name="id_pelanggaran" id="delete-id-pelanggaran">
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeDeleteModal();"
                    class="px-4 py-2 border-2 border-[#647993] text-[#647993] rounded-md transition-all duration-300 ease-in-out hover:bg-gray-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                >
                    Kembali
                </button>
                <button
                    type="submit"
                    class="px-6 py-2 bg-[#e70000] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600"
                >
                    Hapus
                </button>
            </div>
        </form>
    </div>
</section>

<script>
function openEditModal(nim, nama, deskripsi, id_pelanggaran) {
    document.getElementById('edit-nim').value = nim;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-deskripsi').value = deskripsi;
    document.getElementById('edit-id-pelanggaran').value = id_pelanggaran;
    document.getElementById('edit-modal').style.display = 'block';
}

function closeEditModal() {
    document.getElementById('edit-modal').style.display = 'none';
}

function openDeleteModal(id_pelanggaran) {
    document.getElementById('delete-id-pelanggaran').value = id_pelanggaran;
    document.getElementById('delete-modal').style.display = 'block';
}

function closeDeleteModal() {
    document.getElementById('delete-modal').style.display = 'none';
}
</script>