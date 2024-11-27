<section class="z-50 fixed inset-0 bg-black/50" id="tebusan-pelanggaran" style="display: none">
    <div class="w-full max-w-lg my-10 mx-auto p-8 flex flex-col items-center rounded-lg shadow-lg bg-white text-center">
        <h3 class="text-2xl font-semibold mb-6 text-gray-800">
            Tebusan Pelanggaran
        </h3>
        <form action="" method="post" class="w-full flex flex-col gap-y-4">
            <div class="flex flex-col w-full">
                <label for="nim" class="text-left text-sm font-medium text-gray-700">
                    NIM
                </label>
                <input
                    type="text"
                    name="nim"
                    id="nim"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    placeholder="Masukkan NIM"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="nama" class="text-left text-sm font-medium text-gray-700">
                    Nama Mahasiswa
                </label>
                <input
                    type="text"
                    name="nama"
                    id="nama"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    placeholder="Masukkan Nama Mahasiswa"
                    required
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="jumlah-pelanggaran" class="text-left text-sm font-medium text-gray-700">
                    Jumlah Pelanggaran
                </label>
                <input
                    type="number"
                    min="0"
                    name="jumlah-pelanggaran"
                    id="jumlah-pelanggaran"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    placeholder="Masukkan Jumlah Pelanggaran"
                    required    
                />
            </div>
            <div class="flex flex-col w-full">
                <label for="kegiatan-tebusan" class="text-left text-sm font-medium text-gray-700">
                    Kegiatan Tebusan
                </label>
                <input
                    type="text"
                    name="kegiatan-tebusan"
                    id="kegiatan-tebusan"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    placeholder="Masukkan Kegiatan Tebusan"
                    required
                />
            </div>
            <div class="grid grid-cols-2 gap-10 mt-6">
                <button
                    type="button"
                    class="close px-4 py-2 border-2 border-[#647993] text-[#647993] rounded-md transition-all duration-300 ease-in-out hover:bg-gray-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-600"
                >
                    Kembali
                </button>
                <button
                    type="submit"
                    class="px-6 py-2 bg-[#0a97ff] text-white rounded-md transition-all duration-300 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600"
                >
                    Kirim
                </button>
            </div>
        </form>
    </div>
</section>