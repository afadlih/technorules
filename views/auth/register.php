<?php
require_once "./controller/register_controller.php";

$judul = "Daftar | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = true;

include "common/components/layouts/dpa.php";
?>

<main class="h-screen w-full grid place-items-center bg-[#0242a6] lg:h-[195vh] sm:h-[170vh]">
    <section class="mx-auto flex h-4/5 w-4/5 bg-[#eceff2] rounded-3xl overflow-hidden gap-10 lg:px-14 lg:py-8">
        <div class="relative w-2/5 hidden lg:inline">
            <img src="images/login.png" alt="Selamat datang di Polinema!"
                class="h-full w-full rounded-3xl object-cover" />
            <span class="absolute inset-0 opacity-40 bg-[#0242a6] rounded-3xl"></span>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center bg-white rounded-3xl p-8 lg:w-3/5">
            <h1 class="text-3xl font-bold text-[#0242a6]">
                Sign Up
            </h1>
            <?php if (isset($_GET['error'])) { ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">
                        <?php
                        if ($_GET['error'] == "password_mismatch") {
                            echo "Password tidak cocok.";
                        } elseif ($_GET['error'] == "registration_failed") {
                            echo "Registrasi gagal. Silakan coba lagi.";
                        }
                        ?>
                    </span>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">Registrasi berhasil. Silakan login.</span>
                </div>
            <?php } ?>
            <form action="/technorules/controller/register_controller.php" method="post" class="w-full lg:w-[90%]">
                <div class="flex flex-col gap-3 mt-10">
                    <label for="nama_mahasiswa" class="font-semibold text-lg text-[#0242a6]">
                        Nama Lengkap
                    </label>
                    <input id="nama_mahasiswa" name="nama_mahasiswa" type="text" placeholder="Masukkan Nama Lengkap"
                        class="bg-[#ececec] text-sm px-4 py-3 rounded-lg" required />
                    <span id="error_full_name" class="text-red-600 text-sm italic"></span>
                </div>
                <div class="flex flex-col gap-3 mt-2">
                    <label for="nim" class="font-semibold text-lg text-[#0242a6]">
                        Nama Pengguna (NIM)
                    </label>
                    <input id="nim" name="nim" type="text" placeholder="Masukkan NIM"
                        class="bg-[#ececec] text-sm px-4 py-3 rounded-lg" required />
                    <span id="error_username" class="text-red-600 text-sm italic"></span>
                </div>
                <div class="flex flex-col gap-3 mt-2">
                    <label for="password" class="font-semibold text-lg text-[#0242a6]">
                        Kata Sandi
                    </label>
                    <input id="password" name="password" type="password" placeholder="Masukkan Kata Sandi"
                        class="bg-[#ececec] text-sm px-4 py-3 rounded-lg" required />
                    <span id="error_password" class="text-red-600 text-sm italic"></span>
                </div>
                <div class="flex flex-col gap-3 mt-2">
                    <label for="confirm_password" class="font-semibold text-lg text-[#0242a6]">
                        Konfirmasi Kata Sandi
                    </label>
                    <input id="confirm_password" name="confirm_password" type="password"
                        placeholder="Masukkan Kata Sandi" class="bg-[#ececec] text-sm px-4 py-3 rounded-lg" required />
                    <span id="error_confirm_password" class="text-red-600 text-sm italic"></span>
                </div>
                <div class="mt-2 flex">
                    <input type="checkbox" name="checkbox" id="checkbox" onclick="togglePasswordVisibility()" />
                    <label for="checkbox" class="text-sm ml-2">Tampilkan Kata Sandi</label>
                </div>
                <button type="submit"
                    class="mt-7 w-full bg-[#0242a6] text-white font-semibold text-sm px-4 py-3 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#173f80]">
                    Register
                </button>
            </form>
            <span class="mt-7 text-sm">
                Sudah punya akun?
                <a href="login" class="text-[#0242a6]">Masuk</a>
            </span>
        </div>
    </section>
</main>

<script>
    // Memastikan halaman dimuat ulang saat menavigasi kembali
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            location.reload();
        }
    });
</script>