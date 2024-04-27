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

    if ($role->addRole($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = '../role.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'create_role.php';
            </script>";
    }
}

$data = null;


$data .= '<form action="create_role.php" method="POST" enctype="multipart/form-data">
<div class="form-group mb-3">
  <label for="role_nama">Nama Role:</label>
  <input type="text" class="form-control" id="role_nama" name="role_nama" required />
</div>

<button type="submit" id="submit" name="submit">Tambah Role</button>
</form>';

// tutup koneksi
$role->close();

// buat instance template
$judul = 'Tambah Role';

// simpan data ke template
$home->replace('DATA_CRUD', $data);
$home->replace('DATA_JUDUL', $judul);
$home->write();