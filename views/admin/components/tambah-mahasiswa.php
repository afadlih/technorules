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
$students = $admin->getStudents();
?>
<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden mx-auto border-2 border-[#afbbca]">
<thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2 text-center">No</th>
            <th class="px-4 py-2 text-center">NIM</th>
            <th class="px-4 py-2 text-center">Nama</th>
            <th class="px-4 py-2 text-center">Kelas</th>
            <th class="px-4 py-2 text-center">Prodi</th>
            <th class="px-4 py-2 text-center">Status</th>
            <th class="px-4 py-2 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($students as $index => $student) {
            echo "<tr>
                <td class='pl-4 py-2 text-center border-b border-[#e4e8ed]'>" . ($index + 1) . "</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$student['nim']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$student['nama_mahasiswa']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$student['kelas']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$student['nama_prodi']}</td>
                <td class='px-4 py-2 text-center border-b border-[#e4e8ed]'>{$student['status_nama']}</td>
                <td class='px-4 py-2 h-full border-b border-[#e4e8ed]'>
                    <div class='flex items-center justify-center gap-6 h-full'>
                        <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' 
                        onclick='showEditStudentModal(\"{$student['id_mahasiswa']}\", \"{$student['nim']}\", \"{$student['nama_mahasiswa']}\", \"{$student['kelas']}\", \"{$student['id_prodi']}\", \"{$student['status_mhs']}\")'></i>
                        <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]' 
                        onclick='showDeleteStudentModal(\"{$student['id_mahasiswa']}\")'></i>
                    </div>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<!-- Modal Edit Pelanggaran -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="edit-student-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Edit Data Mahasiswa
        </h3>
        <form action="/technorules/controller/admin/data-mahasiswa.php?method=update" method="post" class="w-full flex flex-col gap-y-4">
        <input type="hidden" name="id_mahasiswa" id="edit-id-mahasiswa">
            <div class="flex flex-col w-full">
                <label for="edit-nim" class="text-left text-sm font-medium text-gray-700">
                    NIM
                </label>
                <input
                    type="text"
                    name="nim"
                    id="edit-nim"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-nama" class="text-left text-sm font-medium text-gray-700">
                    Nama Mahasiswa
                </label>
                <input
                    type="text"
                    name="nama_mahasiswa"
                    id="edit-nama"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-kelas" class="text-left text-sm font-medium text-gray-700">
                    Kelas
                </label>
                <select 
                    name="kelas" 
                    id="edit-kelas"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Kelas</option>
                    <option value="1A">1A</option>
                    <option value="1B">1B</option>
                    <option value="1C">1C</option>
                    <option value="1D">1D</option>
                    <option value="1E">1E</option>
                    <option value="1F">1F</option>
                    <option value="1G">1G</option>
                    <option value="1H">1H</option>
                    <option value="2A">2A</option>
                    <option value="2B">2B</option>
                    <option value="2C">2C</option>
                    <option value="2D">2D</option>
                    <option value="3A">3A</option>
                    <option value="3B">3B</option>
                    <option value="3C">3C</option>
                    <option value="3D">3D</option>
                    <option value="4A">4A</option>
                    <option value="4B">4B</option>
                    <option value="4C">4C</option>
                    <option value="4D">4D</option>
                </select>
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-prodi" class="text-left text-sm font-medium text-gray-700">
                    Program Studi
                </label>
                <select 
                    name="id_prodi" 
                    id="edit-prodi"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Program Studi</option>
                    <option value="1">D4 Teknik Informatika</option>
                    <option value="2">D4 Sistem Informasi Bisnis</option>
                    <option value="3">D2 Pengembangan Piranti Lunak Situs</option>
                </select>
            </div>
            <div class="flex flex-col w-full">
                <label for="edit-status" class="text-left text-sm font-medium text-gray-700">
                    Status
                </label>
                <select 
                    name="status_mhs" 
                    id="edit-status"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    required
                >
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="A">Aktif</option>
                    <option value="C">Cuti</option>
                    <option value="N">Non Aktif</option>
                </select>
            </div>
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeEditStudentModal(); document.getElementById('edit-kelas').value=''; document.getElementById('edit-prodi').value=''; document.getElementById('edit-status').value='';"
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

<!-- Modal Hapus Mahasiswa -->
<section class="z-50 fixed inset-0 bg-black/50 flex items-center justify-center" id="delete-student-modal" style="display: none">
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full max-w-lg p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Hapus Mahasiswa
        </h3>
        <p class="text-xl font-normal mb-6 text-gray-600">
            Apakah anda yakin untuk menghapus data mahasiswa?
        </p>
        <form action="/technorules/controller/admin/data-mahasiswa.php?method=delete" method="post" class="w-full flex flex-col gap-y-4">
        <input type="hidden" name="id_mahasiswa" id="delete-id-mahasiswa">
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    onclick="closeDeleteStudentModal()"
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
function showEditStudentModal(id_mahasiswa, nim, nama_mahasiswa, kelas, id_prodi, status_mhs) {
    document.getElementById('edit-id-mahasiswa').value = id_mahasiswa;
    document.getElementById('edit-nim').value = nim;
    document.getElementById('edit-nama').value = nama_mahasiswa;
    document.getElementById('edit-kelas').value = kelas;
    document.getElementById('edit-prodi').value = id_prodi;
    document.getElementById('edit-status').value = status_mhs;
    document.getElementById('edit-student-modal').style.display = 'block';
}

function closeEditStudentModal() {
    document.getElementById('edit-student-modal').style.display = 'none';
}

function showDeleteStudentModal(id_mahasiswa) {
    document.getElementById('delete-id-mahasiswa').value = id_mahasiswa;
    document.getElementById('delete-student-modal').style.display = 'block';
}

function closeDeleteStudentModal() {
    document.getElementById('delete-student-modal').style.display = 'none';
}
</script>