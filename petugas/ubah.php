<?php

include_once('../app/core/init.php');

if (!isset($_GET['id'])) {
    redirect('/pelajaran/petugas');
}

include_once('../app/database/Database.php');
include_once('../app/models/Petugas.php');

$petugas = Petugas::find($_GET['id']);

if (!$petugas) {
    redirect('/pelajaran/petugas');
}

include_once('../app/resources/menu.php');

$title = 'Ubah Petugas - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/petugas/ubah.php');