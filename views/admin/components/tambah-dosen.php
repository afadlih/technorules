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

require_once "./controller/connection.php";
require_once "./model/admin.php";

$admin = new Admin($conn);
$lecturers = $admin->getLecturers();
?>
<button
    onclick="showAddLecturerModal()"
    class="mb-4 px-4 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
>
    Tambah Dosen
</button>

<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden mx-auto border-2 border-[#afbbca]">
    <thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2 text-center">No</th>
            <th class="px-4 py-2 text-center">NIP</th>
            <th class="px-4 py-2 text-center">Nama</th>
            <th class="px-4 py-2 text-center">Jabatan Dosen</th>
            <th class="px-4 py-2 text-center">Email</th>
            <th class="px-4 py-2 text-center">Peran</th>
            <th class="px-4 py-2 text-center">Status</th>
            <th class="px-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($lecturers as $index => $lecturer) {
            echo "<tr>
                <td class='pl-4 py-2 text-center border-b border-[#e4e8ed]'>" . ($index + 1) . "</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$lecturer['nidn']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$lecturer['nama_dosen']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$lecturer['jabatan_dosen']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$lecturer['email']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$lecturer['role']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$lecturer['status_dosen']}</td>
                <td class='px-4 py-2 h-full border-b border-[#e4e8ed]'>
                    <div class='flex items-center justify-center gap-6'>
                        <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' 
                        onclick='showEditLecturerModal(\"{$lecturer['id_dosen']}\", \"{$lecturer['nidn']}\", \"{$lecturer['nama_dosen']}\", \"{$lecturer['jabatan_dosen']}\", \"{$lecturer['email']}\", \"{$lecturer['role']}\", \"{$lecturer['status_dosen']}\")'></i>
                        <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]'
                        onclick='showDeleteLecturerModal(\"{$lecturer['id_dosen']}\")'></i>
                    </div>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<!-- Modal Tambah Dosen -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="add-lecturer-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Tambah Dosen Baru
        </h3>
        <form action="/technorules/controller/admin/data-dosen.php?method=add" method="post" class="w-full flex flex-col gap-y-4">
            <div class="flex flex-col w-full">
                <label for="add-nip" class="text-left text-sm font-medium text-gray-700">
                    NIP
                </label>
                <input
                    type="text"
                    name="nip"
                    id="add-nip"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="add-nama" class="text-left text-sm font-medium text-gray-700">
                    Nama Dosen
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
                <label for="add-password" class="text-left text-sm font-medium text-gray-700">
                    Password
                </label>
                <input
                    type="text"
                    name="passwordusr"
                    id="add-password"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="add-jabatan" class="text-left text-sm font-medium text-gray-700">
                    Jabatan Dosen
                </label>
                <input
                    type="text"
                    name="jabatan"
                    id="add-jabatan"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="add-email" class="text-left text-sm font-medium text-gray-700">
                    Email
                </label>
                <input
                    type="text"
                    name="email"
                    id="add-email"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="add-role" class="text-left text-sm font-medium text-gray-700">
                    Peran
                </label>
                <select 
                    name="role" 
                    id="add-role"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Peran</option>
                    <option value="dosen">Dosen</option>
                    <option value="dpa">DPA</option>
                    <option value="komdis">Komisi Disiplin</option>
                </select>
            </div>
            <div class="flex flex-col w-full">
                <label for="add-status" class="text-left text-sm font-medium text-gray-700">
                    Status
                </label>
                <select 
                    name="status_dosen" 
                    id="add-status"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="Tetap">Tetap</option>
                    <option value="Kontrak">Kontrak</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeAddLecturerModal(); document.getElementById('add-role').value=''; document.getElementById('add-status').value='';"
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

<!-- Modal Edit Dosen -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="edit-lecturer-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Edit Data Dosen
        </h3>
        <form action="/technorules/controller/admin/data-dosen.php?method=update" method="post" class="w-full flex flex-col gap-y-4">
            <input type="hidden" name="id_dosen" id="edit-id-dosen">
            <div class="flex flex-col w-full">
                <label for="edit-nip" class="text-left text-sm font-medium text-gray-700">
                    NIP
                </label>
                <input
                    type="text"
                    name="nip"
                    id="edit-nip"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-nama" class="text-left text-sm font-medium text-gray-700">
                    Nama Dosen
                </label>
                <input
                    type="text"
                    name="nama"
                    id="edit-nama"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-jabatan" class="text-left text-sm font-medium text-gray-700">
                    Jabatan Dosen
                </label>
                <input
                    type="text"
                    name="jabatan"
                    id="edit-jabatan"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-email" class="text-left text-sm font-medium text-gray-700">
                    Email
                </label>
                <input
                    type="email"
                    name="email"
                    id="edit-email"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-role" class="text-left text-sm font-medium text-gray-700">
                    Peran
                </label>
                <select 
                    name="role" 
                    id="edit-role"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Peran</option>
                    <option value="dosen">Dosen</option>
                    <option value="dpa">DPA</option>
                    <option value="komdis">Komisi Disiplin</option>
                </select>
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-status" class="text-left text-sm font-medium text-gray-700">
                    Status
                </label>
                <select 
                    name="status_dosen" 
                    id="edit-status"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="Tetap">Tetap</option>
                    <option value="Kontrak">Kontrak</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeEditLecturerModal(); document.getElementById('edit-role').value=''; document.getElementById('edit-status').value='';"
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

<!-- Modal Hapus Dosen -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="delete-lecturer-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Hapus Dosen
        </h3>
        <p class="text-xl font-normal mb-6 text-gray-600">
            Apakah anda yakin untuk menghapus data dosen?
        </p>
        <form action="/technorules/controller/admin/data-dosen.php?method=delete" method="post" class="w-full flex flex-col gap-y-4">
            <input type="hidden" name="id_dosen" id="delete-id-dosen">
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeDeleteLecturerModal();"
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
function showAddLecturerModal() {
    document.getElementById('add-lecturer-modal').style.display = 'block';
}

function closeAddLecturerModal() {
    document.getElementById('add-lecturer-modal').style.display = 'none';
}

function showEditLecturerModal(id_dosen, nip, nama, jabatan, email, role, status_dosen) {
    document.getElementById('edit-id-dosen').value = id_dosen;
    document.getElementById('edit-nip').value = nip;
    document.getElementById('edit-nama').value = nama;
    document.getElementById('edit-jabatan').value = jabatan;
    document.getElementById('edit-email').value = email;
    document.getElementById('edit-role').value = role;
    document.getElementById('edit-status').value = status_dosen;
    document.getElementById('edit-lecturer-modal').style.display = 'block';
}

function closeEditLecturerModal() {
    document.getElementById('edit-lecturer-modal').style.display = 'none';
}

function showDeleteLecturerModal(id_dosen) {
    document.getElementById('delete-id-dosen').value = id_dosen;
    document.getElementById('delete-lecturer-modal').style.display = 'block';
}

function closeDeleteLecturerModal() {
    document.getElementById('delete-lecturer-modal').style.display = 'none';
}
</script>