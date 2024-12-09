<?php
$judul = "Data Dosen | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = false;

include "common/components/layouts/admin.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <?php require_once "common/components/profile-card/admin.php"; ?>
        <div class="mt-8 mb-14 w-[90%] mx-auto overflow-x-scroll h-full px-10 rounded-xl border-2 border-[#afbbca]">
            <h4 class="mt-5 cursor-default text-center text-2xl font-bold text-[#414f63]">Data Dosen</h4>
            <?php
            require_once "views/admin/components/tambah-dosen.php";
            ?>
            <!-- Add code to display lecturers from the database -->
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
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lecturers as $index => $lecturer) {
                        echo "<tr>
                                <td>" . ($index + 1) . "</td>
                                <td>{$lecturer['nidn']}</td>
                                <td>{$lecturer['nama_dosen']}</td>
                                <td>{$lecturer['status_dosen']}</td>
                                <td>{$lecturer['email']}</td>
                                <td>{$lecturer['role']}</td>
                                <td>
                                    <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]'></i>
                                    <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]'></i>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</main>