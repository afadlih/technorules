<?php
$judul = "Data Mahasiswa | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = false;

include "common/components/layouts/admin.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/admin.php"; ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">Data Mahasiswa</h4>
            <?php
            require_once "views/admin/components/tambah-mahasiswa.php";
            ?>
            <!-- Add code to display students from the database -->
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
                                <td>" . ($index + 1) . "</td>
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
        </div>
    </section>
</main>