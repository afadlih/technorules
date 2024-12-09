<?php
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
        <?php
        require_once "controller/connection.php";
        require_once "model/admin.php";

        $admin = new Admin($conn);
        $profile = $admin->getProfile($_SESSION['admin_id']); // Assuming session contains admin_id

        echo "<div class='profile-details'>
                <p>NIP: {$profile['nip']}</p>
                <p>Nama: {$profile['nama']}</p>
                <p>Email: {$profile['email']}</p>
              </div>";
        ?>
        <button class="mt-8 w-fit ml-[5%] px-7 py-2.5 font-semibold rounded bg-[#0a97ff] text-[#d2efff]"
            onclick="showEditForm()">
            Edit Profil
        </button>
        <div id="editForm" class="hidden">
            <form method="POST" action="controller/update_profile.php">
                <input type="text" name="nama" value="<?php echo $profile['nama']; ?>" required>
                <input type="email" name="email" value="<?php echo $profile['email']; ?>" required>
                <button type="submit">Simpan</button>
            </form>
        </div>
        <script>
        function showEditForm() {
            document.getElementById('editForm').classList.remove('hidden');
        }
        </script>
    </section>
</main>