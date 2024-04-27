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

    if ($creature->addCreature($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = '../creature.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'create_creature.php';
            </script>";
    }
}

$data = null;


$data .= '<form action="create_creature.php" method="POST" enctype="multipart/form-data">
<div class="form-group mb-3">
  <label for="creature_nama">Nama Creature:</label>
  <input type="text" class="form-control" id="creature_nama" name="creature_nama" required />
</div>

<button type="submit" id="submit" name="submit">Tambah Creature</button>
</form>';

// tutup koneksi
$creature->close();

// buat instance template
$judul = 'Tambah Creature';

// simpan data ke template
$home->replace('DATA_CRUD', $data);
$home->replace('DATA_JUDUL', $judul);
$home->write();