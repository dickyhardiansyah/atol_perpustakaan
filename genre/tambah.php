<?php

include_once('../app/core/init.php');
include_once('../app/resources/menu.php');

$title = 'Tambah Genre - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);

include_once('../app/views/genre/tambah.php');