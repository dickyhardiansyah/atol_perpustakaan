<?php

include_once('../app/core/init.php');

if (!isset($_GET['id'])) {
    redirect('/pelajaran/penerbit');
}

include_once('../app/database/Database.php');
include_once('../app/models/Penerbit.php');

$penerbit = Penerbit::find($_GET['id']);

if (!$penerbit) {
    redirect('/pelajaran/penerbit');
}

include_once('../app/resources/menu.php');

$title = 'Ubah penerbit - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/penerbit/ubah.php');