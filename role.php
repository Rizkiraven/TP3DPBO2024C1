<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Role.php');
include('classes/Template.php');

$role = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$role->open();
$role->getRole();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($role->addRole($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'role.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'role.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Role';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Role</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'role';

while ($rol = $role->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $rol['role_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="crud/update_role.php?id=' . $rol['role_id'] . '" title="Update Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="role.php?hapus=' . $rol['role_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

$addrole = '<div class="mt-3">
    <a href="crud/create_role.php" class="btn btn-primary">Tambah Role</a>
</div>';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($role->updateRole($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'role.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'role.php';
            </script>";
            }
        }

        $role->getRoleById($id);
        $row = $role->getResult();

        $dataUpdate = $row['role_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($role->deleteRole($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'role.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'role.php';
            </script>";
        }
    }
}

$role->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('DATA_TAMBAH', $addrole);
$view->write();
