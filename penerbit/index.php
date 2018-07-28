<?php

include_once('../app/core/init.php');
include_once('../app/resources/menu.php');
include_once('../app/database/Database.php');
include_once('../app/models/Penerbit.php');

$title = 'Lihat Penerbit - Perpustakaan';
$navMenu = getNavbarMenu($_SESSION['userJenis']);
$navSubMenu = getNavbarSubMenu($_SESSION['userJenis']);
$penerbit = Penerbit::findAll();

include_once('../app/views/Penerbit/index.php');