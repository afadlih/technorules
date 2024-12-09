<?php
require_once "controller/connection.php";
require_once "model/admin.php";

$admin = new Admin($conn);
$lecturers = $admin->getLecturers();
?>
<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden">
    <thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2">No</th>
            <th class="px-4 py-2">NIP</th>
            <th class="px-4 py-2">Nama</th>
            <th class="px-4 py-2">Status Dosen</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($lecturers as $index => $lecturer) {
            echo "<tr>
                <td class='pl-4 py-2'>" . ($index + 1) . "</td>
                <td class='px-4 py-2'>{$lecturer['nidn']}</td>
                <td class='px-4 py-2'>{$lecturer['nama_dosen']}</td>
                <td class='px-4 py-2'>{$lecturer['status_dosen']}</td>
                <td class='px-4 py-2'>{$lecturer['email']}</td>
                <td class='px-4 py-2'>{$lecturer['role']}</td>
                <td class='px-4 py-2 h-full'>
                    <div class='flex items-center justify-center gap-6'>
                        <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' onclick='showValidationForm({$lecturer['id_dosen']})'></i>
                        <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]'></i>
                    </div>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>