<button class="mt-8 bg-[#0a97ff] text-[#d2efff] font-bold py-2 px-4 rounded-[5px]" onclick="showAddForm()">
    Tambah Data
</button>
<div id="addForm" class="hidden">
    <form method="POST" action="controller/add_lecturer.php">
        <input type="text" name="nidn" placeholder="NIDN" required>
        <input type="text" name="nama_dosen" placeholder="Nama Dosen" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="status_dosen" placeholder="Status Dosen" required>
        <input type="text" name="jabatan_dosen" placeholder="Jabatan Dosen" required>
        <select name="role" required>
            <option value="dosen">Dosen</option>
            <option value="dpa">DPA</option>
            <option value="komdis">Komdis</option>
        </select>
        <button type="submit">Submit</button>
    </form>
</div>
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
        <!-- Add code to display lecturers from the database -->
        <?php
        require_once "controller/connection.php";
        require_once "model/admin.php";

        $admin = new Admin($conn);
        $lecturers = $admin->getLecturers();

        foreach ($lecturers as $lecturer) {
            echo "<tr>
                    <td>{$lecturer['id_dosen']}</td>
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