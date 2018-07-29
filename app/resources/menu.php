<?php

function getNavbarMenu($usertype) {
    switch ($usertype) {
        case 'Admin':
            return [
                [ "title" => "Petugas", "target" => "targetPetugas", "link" => "#" ],
                [ "title" => "Buku", "target" => "targetBuku", "link" => "#" ],
                [ "title" => "Anggota", "target" => "targetAnggota", "link" => "#" ],
                [ "title" => "Transaksi", "target" => "targetTransaksi", "link" => "#" ],
                [ "title" => "Logout", "target" => "", "link" => "/perpustakaan/logout.php" ]
            ];
        case 'Buku':
            return [
                [ "title" => "Buku", "target" => "targetBuku", "link" => "#" ],
                [ "title" => "Logout", "target" => "", "link" => "/perpustakaan/logout.php" ]
            ];
        case 'Transaksi':
            return [
                [ "title" => "Buku", "target" => "targetBuku", "link" => "#" ],
                [ "title" => "Anggota", "target" => "targetAnggota", "link" => "#" ],
                [ "title" => "Transaksi", "target" => "targetTransaksi", "link" => "#" ],
                [ "title" => "Logout", "target" => "", "link" => "/perpustakaan/logout.php" ]
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
                        [ "title" => "Lihat Petugas", "link" => "/perpustakaan/petugas" ],
                        [ "title" => "Tambah Petugas", "link" => "/perpustakaan/petugas/tambah.php" ]
                    ]
                ],
                [
                    "id" => "targetBuku",
                    "menus" => [
                        [ "title" => "Lihat Buku", "link" => "/perpustakaan/buku" ],
                        [ "title" => "Tambah Buku", "link" => "/perpustakaan/buku/tambah.php" ],
                        [ "title" => "Lihat Penerbit", "link" => "/perpustakaan/penerbit" ],
                        [ "title" => "Tambah Penerbit", "link" => "/perpustakaan/penerbit/tambah.php" ],
                        [ "title" => "Lihat Genre", "link" => "/perpustakaan/genre" ],
                        [ "title" => "Tambah Genre", "link" => "/perpustakaan/genre/tambah.php" ]
                    ]
                ],
                [
                    "id" => "targetAnggota",
                    "menus" => [
                        [ "title" => "Lihat Anggota", "link" => "/perpustakaan/anggota" ],
                        [ "title" => "Tambah Anggota", "link" => "/perpustakaan/anggota/tambah.php" ]
                    ]
                ],
                [
                    "id" => "targetTransaksi",
                    "menus" => [
                        [ "title" => "Peminjaman", "link" => "/perpustakaan/transaksi/peminjaman.php" ],
                        [ "title" => "Pengembalian", "link" => "/perpustakaan/transaksi/pengembalian.php" ],
                        [ "title" => "Lihat Peminjaman", "link" => "/perpustakaan/transaksi" ]
                    ]
                ],
            ];
        case 'Buku':
            return [
                [
                    "id" => "targetBuku",
                    "menus" => [
                        [ "title" => "Lihat Buku", "link" => "/perpustakaan/buku" ],
                        [ "title" => "Tambah Buku", "link" => "/perpustakaan/buku/tambah.php" ],
                        [ "title" => "Lihat Penerbit", "link" => "/perpustakaan/penerbit" ],
                        [ "title" => "Tambah Penerbit", "link" => "/perpustakaan/penerbit/tambah.php" ],
                        [ "title" => "Lihat Genre", "link" => "/perpustakaan/genre" ],
                        [ "title" => "Tambah Genre", "link" => "/perpustakaan/genre/tambah.php" ]
                    ]
                ]
            ];
        case 'Transaksi':
            return [
                [
                    "id" => "targetBuku",
                    "menus" => [
                        [ "title" => "Lihat Buku", "link" => "/perpustakaan/buku" ],
                    ]
                ],
                [
                    "id" => "targetAnggota",
                    "menus" => [
                        [ "title" => "Lihat Anggota", "link" => "/perpustakaan/anggota" ],
                        [ "title" => "Tambah Anggota", "link" => "/perpustakaan/anggota/tambah.php" ]
                    ]
                ],
                [
                    "id" => "targetTransaksi",
                    "menus" => [
                        [ "title" => "Peminjaman", "link" => "/perpustakaan/transaksi/peminjaman.php" ],
                        [ "title" => "Pengembalian", "link" => "/perpustakaan/transaksi/pengembalian.php" ],
                        [ "title" => "Lihat Peminjaman", "link" => "/perpustakaan/transaksi" ]
                    ]
                ]
            ];
    }
}