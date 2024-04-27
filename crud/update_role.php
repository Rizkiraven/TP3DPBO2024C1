<?php

include('../config/db.php');
include('../classes/DB.php');
include('../classes/Role.php');
include('../classes/Template.php');


// buat instance role
$role = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$home = new Template('../templates/skinform.html');

$role->open();

//jika tambah role di klik
if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    if ($role->updateRole($id, $_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = '../role.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'update_role.php?id = $id';
            </script>";
    }
}

$id = $_GET['id'];
$role->getRoleById($id);
$row = $role->getResult();

$getNama = $row['role_nama'];

$data = null;

$data .= '<form action="update_role.php?id='.$id.'" method="POST" enctype="multipart/form-data">
<div class="form-group mb-3">
  <label for="role_nama">Nama Role:</label>
  <input type="text" class="form-control" id="role_nama" name="role_nama" value="'.$getNama.'" required />
</div>

<button type="submit" id="submit" name="submit">Update Role</button>
</form>';

// tutup koneksi
$role->close();

// buat instance template
$judul = 'Update Role';

// simpan data ke template
$home->replace('DATA_CRUD', $data);
$home->replace('DATA_JUDUL', $judul);
$home->write();