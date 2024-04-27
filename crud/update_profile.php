<?php

include('../config/db.php');
include('../classes/DB.php');
include('../classes/Profile.php');
include('../classes/Role.php');
include('../classes/Creature.php');
include('../classes/Template.php');


// buat instance profile, role, dan creature
$profile = new Profile($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$role = new Role($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$creature = new Creature($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$home = new Template('../templates/skinform.html');

$profile->open();
$role->open();
$creature->open();

//jika update profile di klik
if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    if ($profile->updateProfile($id, $_POST) > 0) {
        echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = '../index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'update_profile.php?id = $id';
            </script>";
    }
}

$id = $_GET['id'];
$profile->getProfileById($id);
$row = $profile->getResult();

$getFoto = $row['profile_foto'];
$getIgn = $row['profile_ign'];
$getRealname = $row['profile_realname'];
$getRoleID = $row['role_id'];
$getCreatureID = $row['creature_id'];

$data = null;

$data .= '<form action="update_profile.php?id=' .$id. '" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="profile_ign">In-Game Name:</label>
              <input
                type="text"
                class="form-control"
                id="profile_ign"
                name="profile_ign"
                value="' . $getIgn . '"
                required />
            </div>
            <div class="form-group">
              <label for="profile_realname">Real Name:</label>
              <input
                type="text"
                class="form-control"
                id="profile_realname"
                name="profile_realname"
                value="' .$getRealname. '"
                required />
            </div>
            <div class="form-group">
              <label for="role_id">Role:</label>
              <select
                class="form-control"
                id="role_id"
                name="role_id"
                required>';

                while ($row = $role->getResult()) {
                    $selected = ($row['role_id'] == $getRoleID) ? 'selected' : '';
                    $data .= '<option value="' . $row['role_id'] . '" ' . $selected . '>' . $row['role_nama'] . '</option>';
                }

$data .= '</select>
            </div>
            <div class="form-group">
              <label for="creature_id">Creature:</label>
              <select
                class="form-control"
                id="creature_id"
                name="creature_id"
                required>';
                while ($row2 = $creature->getResult()) {
                    $selected2 = ($row2['creature_id'] == $getCreatureID) ? 'selected' : '';
                    $data .= '<option value="' . $row2['creature_id'] . '" ' . $selected . '>' . $row2['creature_nama'] . '</option>';
                }

$data .= '</select>
            </div>
            </div>
            <div class="form-group">
              <label for="profile_foto">Profile Photo:</label>
              <input
                type="file"
                class="form-control-file"
                id="profile_foto"
                name="profile_foto"
                required />
            </div>
            <button type="submit" id="submit" name="submit">
              Update Profile
            </button>
            </form>';

// tutup koneksi
$creature->close();
$profile->close();
$role->close();

// buat instance template
$judul = 'Update Profile';

// simpan data ke template
$home->replace('DATA_CRUD', $data);
$home->replace('DATA_JUDUL', $judul);
$home->write();