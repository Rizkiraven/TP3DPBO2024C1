<?php

include('../config/db.php');
include('../classes/DB.php');
include('../classes/Creature.php');
include('../classes/Template.php');


// buat instance creature
$creature = new Creature($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$home = new Template('../templates/skinform.html');

$creature->open();

//jika tambah creature di klik
if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    if ($creature->updateCreature($id, $_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = '../creature.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'update_creature.php?id = $id';
            </script>";
    }
}

$id = $_GET['id'];
$creature->getCreatureById($id);
$row = $creature->getResult();

$getNama = $row['creature_nama'];

$data = null;

$data .= '<form action="update_creature.php?id='.$id.'" method="POST" enctype="multipart/form-data">
<div class="form-group mb-3">
  <label for="creature_nama">Nama Creature:</label>
  <input type="text" class="form-control" id="creature_nama" name="creature_nama" value="'.$getNama.'" required />
</div>

<button type="submit" id="submit" name="submit">Update Creature</button>
</form>';

// tutup koneksi
$creature->close();

// buat instance template
$judul = 'Update Creature';

// simpan data ke template
$home->replace('DATA_CRUD', $data);
$home->replace('DATA_JUDUL', $judul);
$home->write();