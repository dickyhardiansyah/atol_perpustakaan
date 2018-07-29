<?php

function getNavbarMenu($usertype) {
    switch ($usertype) {
        case 'Admin':
            return [
                [ "title" => "Petugas", "target" => "targetPetugas", "link" => "#" ],
                [ "title" => "Buku", "target" => "targetBuku", "link" => "#" ],
                [ "title" => "Anggota", "target" => "targetAnggota", "link" => "#" ],
                [ "title" => "Transaksi", "target" => "targetTransaksi", "link" => "#" ],
                [ "title" => "Logout", "target" => "", "link" => ROOT . "logout.php" ]
            ];
        case 'Buku':
            return [
                [ "title" => "Buku", "target" => "targetBuku", "link" => "#" ],
                [ "title" => "Logout", "target" => "", "link" => ROOT . "logout.php" ]
            ];
        case 'Transaksi':
            return [
                [ "title" => "Buku", "target" => "targetBuku", "link" => "#" ],
                [ "title" => "Anggota", "target" => "targetAnggota", "link" => "#" ],
                [ "title" => "Transaksi", "target" => "targetTransaksi", "link" => "#" ],
                [ "title" => "Logout", "target" => "", "link" => ROOT . "logout.php" ]
            ];
    }
}

function getNavbarSubMenu($usertype) {
    switch ($usertype) {
        case 'Admin': 
            return [
                [
                    "id" => "targetPetugas",
                    "menus" => [
                        [ "title" => "Lihat Petugas", "link" => ROOT . "petugas" ],
                        [ "title" => "Tambah Petugas", "link" => ROOT . "petugas/tambah.php" ]
                    ]
                ],
                [
                    "id" => "targetBuku",
                    "menus" => [
                        [ "title" => "Lihat Buku", "link" => ROOT . "buku" ],
                        [ "title" => "Tambah Buku", "link" => ROOT . "buku/tambah.php" ],
                        [ "title" => "Lihat Penerbit", "link" => ROOT . "penerbit" ],
                        [ "title" => "Tambah Penerbit", "link" => ROOT . "penerbit/tambah.php" ],
                        [ "title" => "Lihat Genre", "link" => ROOT . "genre" ],
                        [ "title" => "Tambah Genre", "link" => ROOT . "genre/tambah.php" ]
                    ]
                ],
                [
                    "id" => "targetAnggota",
                    "menus" => [
                        [ "title" => "Lihat Anggota", "link" => ROOT . "anggota" ],
                        [ "title" => "Tambah Anggota", "link" => ROOT . "anggota/tambah.php" ]
                    ]
                ],
                [
                    "id" => "targetTransaksi",
                    "menus" => [
                        [ "title" => "Peminjaman", "link" => ROOT . "transaksi/peminjaman.php" ],
                        [ "title" => "Pengembalian", "link" => ROOT . "transaksi/pengembalian.php" ],
                        [ "title" => "Lihat Peminjaman", "link" => ROOT . "transaksi" ]
                    ]
                ],
            ];
        case 'Buku':
            return [
                [
                    "id" => "targetBuku",
                    "menus" => [
                        [ "title" => "Lihat Buku", "link" => ROOT . "buku" ],
                        [ "title" => "Tambah Buku", "link" => ROOT . "buku/tambah.php" ],
                        [ "title" => "Lihat Penerbit", "link" => ROOT . "penerbit" ],
                        [ "title" => "Tambah Penerbit", "link" => ROOT . "penerbit/tambah.php" ],
                        [ "title" => "Lihat Genre", "link" => ROOT . "genre" ],
                        [ "title" => "Tambah Genre", "link" => ROOT . "genre/tambah.php" ]
                    ]
                ]
            ];
        case 'Transaksi':
            return [
                [
                    "id" => "targetBuku",
                    "menus" => [
                        [ "title" => "Lihat Buku", "link" => ROOT . "buku" ],
                    ]
                ],
                [
                    "id" => "targetAnggota",
                    "menus" => [
                        [ "title" => "Lihat Anggota", "link" => ROOT . "anggota" ],
                        [ "title" => "Tambah Anggota", "link" => ROOT . "anggota/tambah.php" ]
                    ]
                ],
                [
                    "id" => "targetTransaksi",
                    "menus" => [
                        [ "title" => "Peminjaman", "link" => ROOT . "transaksi/peminjaman.php" ],
                        [ "title" => "Pengembalian", "link" => ROOT . "transaksi/pengembalian.php" ],
                        [ "title" => "Lihat Peminjaman", "link" => ROOT . "transaksi" ]
                    ]
                ]
            ];
    }
}