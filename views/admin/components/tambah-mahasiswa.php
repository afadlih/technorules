<?php
require_once "controller/connection.php";
require_once "model/admin.php";

$admin = new Admin($conn);
$students = $admin->getStudents();
?>
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
        foreach ($students as $index => $student) {
            echo "<tr>
                <td class='pl-4 py-2'>" . ($index + 1) . "</td>
                <td class='px-4 py-2'>{$student['nim']}</td>
                <td class='px-4 py-2'>{$student['nama_mahasiswa']}</td>
                <td class='px-4 py-2'>{$student['kelas']}</td>
                <td class='px-4 py-2'>{$student['nama_prodi']}</td>
                <td class='flex items-center gap-6 px-4 py-2'>
                    <div class='flex items-center justify-center gap-6 h-full'>
                        <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' onclick='editStudent({$student['id_mahasiswa']})'></i>
                        <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]' onclick='deleteStudent({$student['id_mahasiswa']})'></i>
                    </div>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>