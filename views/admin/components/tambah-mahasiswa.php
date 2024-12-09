<button class="mt-8 bg-[#0a97ff] text-[#d2efff] font-bold py-2 px-4 rounded-[5px]" onclick="showAddForm()">
    Tambah Data
</button>
<div id="addForm" class="hidden">
    <form method="POST" action="controller/add_student.php">
        <input type="text" name="nim" placeholder="NIM" required>
        <input type="text" name="nama_mahasiswa" placeholder="Nama Mahasiswa" required>
        <input type="text" name="kelas" placeholder="Kelas" required>
        <select name="id_prodi" required>
            <option value="1">D-IV Teknik Informatika</option>
            <option value="2">D-IV Sistem Informasi Bisnis</option>
            <option value="3">D-II Pengembangan Piranti Lunak Situs</option>
        </select>
        <button type="submit">Submit</button>
    </form>
</div>
<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden">
    <thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2">No</th>
            <th class="px-4 py-2">NIM</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Kelas</th>
            <th class="px-4 py-2">Prodi</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once "controller/connection.php";
        require_once "model/admin.php";

        $admin = new Admin($conn);
        $students = $admin->getStudents();

        foreach ($students as $student) {
            echo "<tr>
                    <td>{$student['id_mahasiswa']}</td>
                    <td>{$student['nim']}</td>
                    <td>{$student['nama_mahasiswa']}</td>
                    <td>{$student['kelas']}</td>
                    <td>{$student['nama_prodi']}</td>
                    <td class='flex items-center gap-6 px-4 py-2'>
                        <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' onclick='editStudent({$student['id_mahasiswa']})'></i>
                        <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]' onclick='deleteStudent({$student['id_mahasiswa']})'></i>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>
<script>
function showAddForm() {
    document.getElementById('addForm').classList.remove('hidden');
}

function editStudent(id) {
    // Implement edit functionality
}

function deleteStudent(id) {
    // Implement delete functionality
}
</script>