<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Role.php');
include('classes/Creature.php');
include('classes/Profile.php');
include('classes/Template.php');

// buat instance profile
$listProfile = new Profile($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listProfile->open();
// tampilkan data profile
$listProfile->getProfileJoin();

// cari profile
if (isset($_POST['btn-cari'])) {
    // methode mencari data profile
    $listProfile->searchProfile($_POST['cari']);
} else {
    // method menampilkan data profile
    $listProfile->getProfileJoin();
}

// Tentukan apakah tombol "Sort by Role" diklik
if (isset($_GET['sort']) && $_GET['sort'] == 'role') {
    // Jika tombol "Sort by Role" diklik, panggil metode untuk mengambil data profile yang diurutkan berdasarkan peran
    $listProfile->getProfileJoinSortedByRole();
} else {
    // Jika tidak, panggil metode untuk mengambil data profile tanpa pengurutan khusus
    $listProfile->getProfileJoin();
}

$data = null;

// ambil data profile
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listProfile->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 profile-thumbnail">
        <a href="detail.php?id=' . $row['profile_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['profile_foto'] . '" class="card-img-top" alt="' . $row['profile_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text profile-nama my-0">' . $row['profile_ign'] . '</p>
                <p class="card-text role-nama">' . $row['role_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listProfile->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PROFILE', $data);
$home->write();
