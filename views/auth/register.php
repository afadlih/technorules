<?php
$judul = "Daftar | Tata Tertib Polinema";
$deskripsi = "";
$halaman_khusus = true;

include "common/main-layout.php";
?>

<main class="h-screen w-full grid place-items-center bg-[#0242a6] lg:h-[185vh] sm:h-[160vh]">
    <section class="mx-auto flex h-4/5 w-4/5 bg-[#eceff2] rounded-3xl overflow-hidden gap-10 lg:px-14 lg:py-8">
        <div class="relative w-2/5 hidden lg:inline">
            <img
                src="images/login.png"
                alt="Selamat datang di Polinema!"
                class="h-full w-full rounded-3xl object-cover"
            />
            <span class="absolute inset-0 opacity-40 bg-[#0242a6] rounded-3xl"></span>
        </div>
        <div class="h-full w-full flex flex-col items-center justify-center bg-white rounded-3xl p-8 lg:w-3/5">
            <h1 class="text-3xl font-bold text-[#0242a6]">
                Sign Up
            </h1>
            <form action="controller/submit.php" method="post" class="w-full lg:w-[90%]">
                <div class="flex flex-col gap-3 mt-10">
                    <label for="full_name" class="font-semibold text-lg text-[#0242a6]">
                        Nama Lengkap
                    </label>
                    <input
                        id="full_name"
                        name="full_name"
                        type="text"
                        placeholder="Masukkan Lengkap"
                        class="bg-[#ececec] text-sm px-4 py-3 rounded-lg"
                        required
                    />
                    <span id="error_full_name" class="text-red-600 text-sm italic"></span>
                </div>
                <div class="flex flex-col gap-3 mt-2">
                    <label for="username" class="font-semibold text-lg text-[#0242a6]">
                        Nama Pengguna (NIM/NIP)
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        placeholder="Masukkan NIM/NIP"
                        class="bg-[#ececec] text-sm px-4 py-3 rounded-lg"
                        required
                    />
                    <span id="error_username" class="text-red-600 text-sm italic"></span>
                </div>
                <div class="flex flex-col gap-3 mt-2">
                    <label for="password" class="font-semibold text-lg text-[#0242a6]">
                        Kata Sandi
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Masukkan Kata Sandi"
                        class="bg-[#ececec] text-sm px-4 py-3 rounded-lg"
                        required
                    />
                    <span id="error_password" class="text-red-600 text-sm italic"></span>
                </div>
                <div class="flex flex-col gap-3 mt-2">
                    <label for="confirm_password" class="font-semibold text-lg text-[#0242a6]">
                        Konfirmasi Kata Sandi
                    </label>
                    <input
                        id="confirm_password"
                        name="confirm_password"
                        type="password"
                        placeholder="Masukkan Kata Sandi"
                        class="bg-[#ececec] text-sm px-4 py-3 rounded-lg"
                        required
                    />
                    <span id="error_confirm_password" class="text-red-600 text-sm italic"></span>
                </div>
                <div class="mt-2 flex">
                    <input type="checkbox" name="checkbox" id="checkbox" />
                    <label for="checkbox" class="text-sm ml-2">Tampilkan Kata Sandi</label>
                </div>
                <button
                    id="submit"
                    type="submit"
                    class="mt-7 w-full bg-[#0242a6] text-white font-semibold text-sm px-4 py-3 rounded-lg transition-all duration-300 ease-in-out hover:bg-[#173f80]"
                >
                    Daftar
                </button>
            </form>
            <span class="mt-7 text-sm">
                Sudah punya akun?
                <a href="login" class="text-[#0242a6]">Masuk</a>
            </span>
        </div>
    </section>
</main>