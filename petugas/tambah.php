<?php

include_once('../app/core/init.php');
include_once('../app/resources/menu.php');

$title = 'Tambah Petugas - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/petugas/tambah.php');