<?php
require_once "controller/connection.php";
require_once "model/admin.php";

$admin = new Admin($conn);
$violations = $admin->getViolations();
?>
<table class="my-8 w-full text-left text-sm rounded-lg overflow-hidden">
    <thead class="cursor-default bg-[#0242a6] text-white">
        <tr>
            <th class="pl-4 py-2">No</th>
            <th class="px-4 py-2">NIM</th>
            <th class="px-4 py-2">Nama Mahasiswa</th>
            <th class="px-4 py-2">Pelanggaran</th>
            <th class="px-4 py-2">Tingkat</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($violations as $index => $violation) {
            echo "<tr>
                <td class='pl-4 py-2'>" . ($index + 1) . "</td>
                <td class='px-4 py-2'>{$violation['nim']}</td>
                <td class='px-4 py-2'>{$violation['nama_mahasiswa']}</td>
                <td class='px-4 py-2'>{$violation['deskripsi_pelanggaran']}</td>
                <td class='px-4 py-2'>{$violation['tingkat_pelanggaran']}</td>
                <td class='px-4 py-2 h-full'>
                    <div class='flex items-center justify-center gap-6'>
                        <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' onclick='showValidationForm({$violation['id_pelanggaran']})'></i>
                        <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]'></i>
                    </div>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>