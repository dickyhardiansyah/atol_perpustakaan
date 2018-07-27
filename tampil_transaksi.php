<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/transaksi_repository.php');

$menus = get_menu();
$results = find_all_transaksi();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transaksi - Sistem Informasi Perpustakaan</title>
    
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu"><a href="tampil_transaksi.php">Lihat Transaksi</a></li>
                <li class="side-bar-menu"><a href="tambah_transaksi.php">Tambah Transaksi</a></li>
            </ul>
        </sidebar>

        <section class="column flex fg-1">
            <header>
                <nav class="nav-bar primary-color flex">
                    <ul class="flex">
                        <?php foreach ($menus as $menu) { ?>
                            <li class="nav-menu">
                                <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'Transaksi' ? 'active' : ''; ?>">
                                    <?php echo $menu['judul']; ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </header>

            <article>
                <ul class="data">
                    <ul class="data-header">

                        <li><h4>Nama</h4></li>
                        <li><h4>Judul</h4></li>
                        <li><h4>Tanggal Pinjam</h4></li>
                        <li><h4>Tanggal Kembali</h4></li>
                        <li><h4>Aksi</h4></li>
                    </ul>

                    <?php foreach ($results as $transaksi) { ?>
                    <ul class="data-body">
                        <li><?php echo $transaksi['nama']; ?></li>
                        <li><?php echo $transaksi['judul']; ?></li>
                        <li><?php echo $transaksi['tanggal_pinjam']; ?></li>
                        <li><?php echo $transaksi['tanggal_kembali']; ?></li>
                        <li>
                            <button class="btn btn-data" 
                                onclick="confirmDeletion('<?php echo $transaksi['id_transaksi']; ?>')">
                                Kembali
                            </button>
                        </li>
                    </ul>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>

    <script src="assets/js/tampil_transaksi.js"></script>
</body>
</html>