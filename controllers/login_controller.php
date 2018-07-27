<?php

session_start();

$_SESSION['has_login'] = 1;
header('location: /atol_perpustakaan');