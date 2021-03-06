<?php

include_once('../app/core/init.php');

if (!isset($_GET['id'])) {
    redirect('/pelajaran/genre');
}

include_once('../app/database/Database.php');
include_once('../app/models/Genre.php');

$genre = Genre::find($_GET['id']);

if (!$genre) {
    redirect('/pelajaran/genre');
}

include_once('../app/resources/menu.php');

$title = 'Ubah Genre - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/genre/ubah.php');