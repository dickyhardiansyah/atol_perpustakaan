<?php 

function redirect($location) {
    header("Location: $location");
}

session_start();

if (!isset($_SESSION['userId']) && $_SERVER['REQUEST_URI'] !== '/perpustakaan/login.php' && $_SERVER['REQUEST_URI'] !== '/perpustakaan/app/controllers/login/login.php') {
    redirect('/perpustakaan/login.php');
} else if (isset($_SESSION['userId']) && $_SERVER['REQUEST_URI'] === '/perpustakaan/login.php') {
    redirect('/perpustakaan');
}