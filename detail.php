<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Role.php');
include('classes/Creature.php');
include('classes/Profile.php');
include('classes/Template.php');

$profile = new Profile($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$profile->open();

$data = nulL;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $profile->getProfileById($id);
        $row = $profile->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['profile_ign'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/' . $row['profile_foto'] . '" class="img-thumbnail" alt="' . $row['profile_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>In-game Name</td>
                                    <td>:</td>
                                    <td>' . $row['profile_ign'] . '</td>
                                </tr>
                                <tr>
                                    <td>Real Name</td>
                                    <td>:</td>
                                    <td>' . $row['profile_realname'] . '</td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>:</td>
                                    <td>' . $row['role_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Creature</td>
                                    <td>:</td>
                                    <td>' . $row['creature_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>';
            $data .= '<div class="card-footer text-end">
            <a href="crud/update_profile.php?id=' . $row['profile_id'] . '"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
            <a href="detail.php?hapus=' . $row['profile_id'] . '"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';

    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($profile->deleteProfile($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'detail.php?id=$id';
            </script>";
        }
    }
}

$profile->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_PROFILE', $data);
$detail->write();
