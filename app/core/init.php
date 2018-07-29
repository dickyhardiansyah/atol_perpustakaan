<?php 

define('ROOT', '/');

function redirect($location) {
    header("Location: $location");
}

session_start();

if (!isset($_SESSION['userId']) && $_SERVER['REQUEST_URI'] !== ROOT . 'login.php' && $_SERVER['REQUEST_URI'] !== ROOT . 'app/controllers/login/login.php') {
    redirect(ROOT . 'login.php');
} else if (isset($_SESSION['userId']) && $_SERVER['REQUEST_URI'] === ROOT . 'login.php') {
    redirect(ROOT);
}