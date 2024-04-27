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

//jika tambah profile di klik
if (isset($_POST['submit'])) {

    if ($profile->addProfile($_POST) > 0) {
        echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = '../index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'create_profile.php';
            </script>";
    }
}


$role->getRole();
$creature->getCreature();

$role_dropdown = '';
$creature_dropdown = '';
$data = null;

while ($row = $role->getResult()) {
    $role_dropdown .= '<option value="' . $row['role_id'] . '">' . $row['role_nama'] . '</option>';
}

while ($row2 = $creature->getResult()) {
    $creature_dropdown .= '<option value="' . $row2['creature_id'] . '">' . $row2['creature_nama'] . '</option>';
}

$data .= '<form action="create_profile.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label for="profile_ign">In-Game Name:</label>
              <input
                type="text"
                class="form-control"
                id="profile_ign"
                name="profile_ign"
                required />
            </div>
            <div class="form-group">
              <label for="profile_realname">Real Name:</label>
              <input
                type="text"
                class="form-control"
                id="profile_realname"
                name="profile_realname"
                required />
            </div>
            <div class="form-group">
              <label for="role_id">Role:</label>
              <select
                class="form-control"
                id="role_id"
                name="role_id"
                required />
                ' . $role_dropdown . '
                </select>
            </div>
            <div class="form-group">
              <label for="creature_id">Creature:</label>
              <select
                class="form-control"
                id="creature_id"
                name="creature_id"
                required />
                ' . $creature_dropdown . '
              </select>
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
              Tambah Profile
            </button>
            </form>';

// tutup koneksi
$profile->close();
$role->close();
$creature->close();

// buat instance template
$judul = 'Tambah Profil Agent';

// simpan data ke template
$home->replace('DATA_CRUD', $data);
$home->replace('DATA_JUDUL', $judul);
$home->write();
