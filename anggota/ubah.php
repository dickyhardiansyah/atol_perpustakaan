<?php

include_once('../app/core/init.php');

if (!isset($_GET['id'])) {
    redirect('/pelajaran/Anggota');
}

include_once('../app/database/Database.php');
include_once('../app/models/Anggota.php');

$anggota = Anggota::find($_GET['id']);

if (!$anggota) {
    redirect('/pelajaran/anggota');
}

include_once('../app/resources/menu.php');

$title = 'Ubah Anggota - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/anggota/ubah.php');