<?php

include_once('../../core/init.php');

if (!isset($_POST['login'])) {
    redirect(ROOT);
}

include_once('../../resources/status.php');
include_once('../../database/Database.php');
include_once('../../models/Petugas.php');

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    echo json_encode([
        "status" => BAD_REQUEST,
        "message" => 'Username atau password tidak boleh kosong.'
    ]);
} else {
    $petugas = Petugas::findByUsername($username);

    foreach ($petugas as $item) {
        if (password_verify($password, $item->password)) {
            $_SESSION['userId'] = $item->idPetugas;
            $_SESSION['userName'] = $item->nama;
            $_SESSION['userJenis'] = $item->jenis;
            $_SESSION['userUsername'] = $item->username;
            echo json_encode([
                "status" => SUCCESS,
                "data" => $item
            ]);
        } else {
            echo json_encode([
                "status" => UNATHORIZED,
                "message" => 'Password salah.'
            ]);
        }
    }

    if (sizeof($petugas) === 0) {
        echo json_encode([
            "status" => UNATHORIZED,
            "message" => 'Petugas tidak ditemukan'
        ]);
    }
}