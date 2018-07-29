<?php

include_once('../app/core/init.php');
include_once('../app/database/Database.php');
include_once('../app/resources/menu.php');

$title = 'Tambah Anggota - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/anggota/tambah.php');