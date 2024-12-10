<div class="mx-auto mt-8 px-6 w-[90%] border-2 border-[#afbbca] flex flex-col rounded-xl">
    <h4 class="mt-5 cursor-default text-xl font-bold text-[#414f63]">Informasi Pribadi</h4>
    <div class="mb-8 cursor-default grid grid-cols-2 gap-6 mt-6">
        <div>
            <h4 class="font-bold text-[#414f63]">Nama Lengkap</h4>
            <h5 class="text-[#647993]"><?php echo $profile['nama_mahasiswa']; ?></h5>
        </div>
        <div>
            <h4 class="font-bold text-[#414f63]">Program Studi</h4>
            <h5 class="text-[#647993]"><?php echo $profile['nama_prodi']; ?></h5>
        </div>
        <div>
            <h4 class="font-bold text-[#414f63]">NIM</h4>
            <h5 class="text-[#647993]"><?php echo $profile['nim']; ?></h5>
        </div>
        <div>
            <h4 class="font-bold text-[#414f63]">Kelas</h4>
            <h5 class="text-[#647993]"><?php echo $profile['kelas']; ?></h5>
        </div>
        <div>
            <h4 class="font-bold text-[#414f63]">Status</h4>
            <h5 class="text-[#647993]"><?php echo $profile['status_nama']; ?></h5>
        </div>
    </div>
</div>