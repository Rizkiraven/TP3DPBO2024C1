<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Creature.php');
include('classes/Template.php');

$creature = new Creature($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$creature->open();
$creature->getCreature();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($creature->addCreature($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'creature.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'creature.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Creature';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Creature</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'creature';

while ($crea = $creature->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $crea['creature_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="crud/update_creature.php?id=' . $crea['creature_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="creature.php?hapus=' . $crea['creature_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

$addrole = '<div class="mt-3">
    <a href="crud/create_creature.php" class="btn btn-primary">Tambah Creature</a>
</div>';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($creature->updateCreature($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'creature.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'creature.php';
            </script>";
            }
        }

        $creature->getCreatureById($id);
        $row = $creature->getResult();

        $dataUpdate = $row['creature_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($creature->deleteCreature($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'creature.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'creature.php';
            </script>";
        }
    }
}

$creature->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_TAMBAH', $addrole);
$view->write();
