<?php
require_once './controller/adminController.php';

$judul = "Profil | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = false;

include "common/components/layouts/admin.php";
?>

<main class="ml-20 min-h-[140vh] pt-14 h-full bg-[#eceff2] px-10 lg:ml-[5rem] lg:pl-60">
    <section class="bg-white h-[120vh] w-full overflow-y-auto flex flex-col">
        <h4 class="mx-auto mt-8 w-[90%] text-3xl font-bold cursor-default text-[#414f63]">
            Profil Saya
        </h4>
        <div class="mx-auto mt-8 px-6 w-[90%] border-2 border-[#afbbca] flex flex-col rounded-xl">
            <h4 class="mt-5 cursor-default text-xl font-bold text-[#414f63]">Informasi Pribadi</h4>
            <div class="mb-8 cursor-default grid grid-cols-2 gap-6 mt-6">
                <div>
                    <h4 class="font-bold text-[#414f63]">Nama Lengkap</h4>
                    <h5 class="text-[#647993]"><?php echo $data['name']; ?></h5>
                </div>
                <div>
                    <h4 class="font-bold text-[#414f63]">Jabatan</h4>
                    <h5 class="text-[#647993]"><?php echo $data['jabatan']; ?></h5>
                </div>
                <div>
                    <h4 class="font-bold text-[#414f63]">NIP</h4>
                    <h5 class="text-[#647993]"><?php echo $data['nip']; ?></h5>
                </div>
                <div>
                    <h4 class="font-bold text-[#414f63]">Email</h4>
                    <h5 class="text-[#647993]"><?php echo $data['email']; ?></h5>
                </div>
            </div>
        </div>
        <button class="mt-8 w-fit ml-[5%] px-7 py-2.5 font-semibold rounded bg-[#0a97ff] text-[#d2efff]">
            Edit Profil
        </button>
    </section>
</main>