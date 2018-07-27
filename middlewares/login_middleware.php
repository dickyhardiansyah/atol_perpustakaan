<?php

function get_menu() {
    if (!isset($_SESSION['has_login'])) {
        header('location: login.php');
    }

    return [
        [
            "judul" => "Beranda",
            "link" => "/atol_perpustakaan"
        ],
        [
            "judul" => "Data Anggota",
            "link" => "/atol_perpustakaan/tampil_anggota.php"
        ],
        [
            "judul" => "Data Buku",
            "link" => "/atol_perpustakaan/tampil_buku.php"
        ],
        [
            "judul" => "Transaksi",
            "link" => "/atol_perpustakaan/tampil_transaksi.php"
        ],
        [
            "judul" => "Logout",
            "link" => "/atol_perpustakaan/controllers/logout_controller.php"
        ]
    ];
}