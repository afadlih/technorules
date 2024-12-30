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

require_once "controller/connection.php";
require_once "model/admin.php";

$admin = new Admin($conn);
$violations = $admin->getViolations();
?>
<button
    onclick="showAddViolationsModal()"
    class="mb-4 px-4 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
>
    Tambah Pelanggaran
</button>

<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden mx-auto border-2 border-[#afbbca]">
    <thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2 text-center">No</th>
            <th class="px-4 py-2 text-center">Deskripsi Pelanggaran</th>
            <th class="px-4 py-2 text-center">Tingkat Pelanggaran</th>
            <th class="pl-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($violations as $index => $violation) {
            echo "<tr>
                <td class='pl-4 py-2 text-center border-b border-[#e4e8ed]'>" . ($index + 1) . "</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$violation['deskripsi_pelanggaran']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$violation['tingkat_pelanggaran']}</td>
                <td class='px-4 py-2 h-full border-b border-[#e4e8ed]'>
                    <div class='flex items-center justify-center gap-6'>
                        <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' 
                        onclick='showEditViolationsModal(\"{$violation['id_rules']}\", \"{$violation['deskripsi_pelanggaran']}\", \"{$violation['tingkat_pelanggaran']}\");'></i>
                        <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]'
                        onclick='showDeleteViolationsModal(\"{$violation['id_rules']}\")'></i>
                    </div>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<!-- Modal Tambah Pelanggaran -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="add-violations-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Tambah Pelanggaran Baru
        </h3>
        <form action="/technorules/controller/admin/data-pelanggaran.php?method=add" method="post" class="w-full flex flex-col gap-y-4">
            <div class="flex flex-col w-full">
                <label for="add-pelanggaran" class="text-left text-sm font-medium text-gray-700">
                    Deskripsi Pelanggaran
                </label>
                <input
                    type="text"
                    name="deskripsi_pelanggaran"
                    id="add-pelanggaran"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="add-tingkat" class="text-left text-sm font-medium text-gray-700">
                    Tingkat Pelanggaran
                </label>
                <select
                    name="tingkat_pelanggaran"
                    id="add-tingkat"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Tingkat Pelanggaran</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeAddViolationsModal(); document.getElementById('add-tingkat').value='';"
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

<!-- Modal Edit Pelanggaran -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="edit-violations-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Edit Data Pelanggaran
        </h3>
        <form action="/technorules/controller/admin/data-pelanggaran.php?method=update" method="post" class="w-full flex flex-col gap-y-4">
        <input type="hidden" name="id_rules" id="edit-id-rules">
            <div class="flex flex-col w-full">
                <label for="edit-deskripsi" class="text-left text-sm font-medium text-gray-700">
                    Deskripsi Pelanggaran
                </label>
                <input
                    type="text"
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
                <select
                    name="tingkat_pelanggaran"
                    id="edit-tingkat"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Tingkat Pelanggaran</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeEditViolationsModal();  document.getElementById('add-tingkat').value='';"
                    class="px-4 py-2 border-2 border-[#647993] text-[#647993] rounded-md transition-all duration-300 ease-in-out hover:bg-gray-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                >
                    Kembali
                </button>
                <button
                    type="submit"
                    name="update"
                    class="px-6 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                >
                    Konfirmasi
                </button>   
            </div>
        </form>
    </div>
</section>

<!-- Modal Hapus Pelanggaran -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="delete-violations-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Hapus Pelanggaran
        </h3>
        <p class="text-xl font-normal mb-6 text-gray-600">
            Apakah anda yakin untuk menghapus data pelanggaran?
        </p>
        <form action="/technorules/controller/admin/data-pelanggaran.php?method=delete" method="post" class="w-full flex flex-col gap-y-4">
            <input type="hidden" name="id_rules" id="delete-id-rules">
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeDeleteViolationsModal();"
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
function showAddViolationsModal() {
    document.getElementById('add-violations-modal').style.display = 'block';
}

function closeAddViolationsModal() {
    document.getElementById('add-violations-modal').style.display = 'none';
}

function showEditViolationsModal(id_rules, deskripsi_pelanggaran, tingkat_pelanggaran) {
    document.getElementById('edit-id-rules').value = id_rules;
    document.getElementById('edit-deskripsi').value = deskripsi_pelanggaran;
    document.getElementById('edit-tingkat').value = tingkat_pelanggaran;
    document.getElementById('edit-violations-modal').style.display = 'block';
}

function closeEditViolationsModal() {
    document.getElementById('edit-violations-modal').style.display = 'none';
}

function showDeleteViolationsModal(id_rules) {
    document.getElementById('delete-id-rules').value = id_rules;
    document.getElementById('delete-violations-modal').style.display = 'block';
}

function closeDeleteViolationsModal() {
    document.getElementById('delete-violations-modal').style.display = 'none';
}
</script>