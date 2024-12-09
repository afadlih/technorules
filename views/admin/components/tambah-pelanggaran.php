<button class="mt-8 bg-[#0a97ff] text-[#d2efff] font-bold py-2 px-4 rounded-[5px]" onclick="showAddForm()">
    Tambah Data
</button>
<div id="addForm" class="hidden">
    <form method="POST" action="controller/add_violation.php">
        <input type="text" name="deskripsi_pelanggaran" placeholder="Deskripsi Pelanggaran" required>
        <select name="tingkat_pelanggaran" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button type="submit">Submit</button>
    </form>
</div>
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
        require_once "controller/connection.php";
        require_once "model/admin.php";

        $admin = new Admin($conn);
        $violations = $admin->getViolations();

        foreach ($violations as $index => $violation) {
            echo "<tr>
                    <td>" . ($index + 1) . "</td>
                    <td>{$violation['nim']}</td>
                    <td>{$violation['nama_mahasiswa']}</td>
                    <td>{$violation['deskripsi_pelanggaran']}</td>
                    <td>{$violation['tingkat_pelanggaran']}</td>
                    <td>
                        <i class='edit fa-solid fa-pen-to-square cursor-pointer text-xl text-[#414f63]' onclick='showValidationForm({$violation['id_pelanggaran']})'></i>
                        <i class='delete fa-solid fa-trash-can cursor-pointer text-xl text-[#e70000]'></i>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>

<div id="validationForm" class="hidden">
    <form method="POST" action="handle_validation.php" class="bg-white p-6 rounded-lg">
        <h3 class="text-lg font-bold mb-4">Validasi Pelanggaran</h3>
        <input type="hidden" name="id_pelanggaran" id="violation_id">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Keputusan</label>
            <select name="keputusan" class="w-full p-2 border rounded">
                <option value="Cuti">Cuti</option>
                <option value="DO">DO</option>
                <option value="Lanjut">Lanjut</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Tebusan</label>
            <input type="text" name="kegiatan_tebusan" class="w-full p-2 border rounded">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <button type="button" onclick="hideValidationForm()"
                class="ml-2 bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
        </div>
    </form>
</div>

<script>
function showAddForm() {
    document.getElementById('addForm').classList.remove('hidden');
}

function showValidationForm(violationId) {
    document.getElementById('violation_id').value = violationId;
    document.getElementById('validationForm').classList.remove('hidden');
}

function hideValidationForm() {
    document.getElementById('validationForm').classList.add('hidden');
}
</script>