<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/buku_repository.php');

$menus = get_menu();
$results = find_all_buku();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buku - Sistem Informasi Perpustakaan</title>
    
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu"><a href="tampil_buku.php">Lihat Buku</a></li>
                <li class="side-bar-menu"><a href="tambah_buku.php">Tambah Buku</a></li>
            </ul>
        </sidebar>

        <section class="column flex fg-1">
            <header>
                <nav class="nav-bar primary-color flex">
                    <ul class="flex">
                        <?php foreach ($menus as $menu) { ?>
                            <li class="nav-menu">
                                <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'Data Buku' ? 'active' : ''; ?>">
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
                        <li><h4>Kode</h4></li>
                        <li><h4>Judul</h4></li>
                        <li><h4>Pengarang</h4></li>
                        <li><h4>Penerbit</h4></li>
                        <li><h4>Jumlah</h4></li>
                        <li><h4>Aksi</h4></li>
                    </ul>

                    <?php foreach ($results as $buku) { ?>
                    <ul class="data-body">
                        <li><?php echo $buku['kode_buku']; ?></li>
                        <li><?php echo $buku['judul']; ?></li>
                        <li><?php echo $buku['pengarang']; ?></li>
                        <li><?php echo $buku['penerbit']; ?></li>
                        <li><?php echo $buku['jml_buku']; ?></li>
                        <li>
                            <a href="ubah_buku.php?kode_buku=<?php echo $buku['kode_buku']; ?>" 
                                class="btn btn-data">
                                Ubah
                            </a>
                            <button class="btn btn-data" 
                                onclick="confirmDeletion('<?php echo $buku['kode_buku']; ?>')">
                                Hapus
                            </button>
                        </li>
                    </ul>
                    <?php } ?>
                </ul>
            </article>
        </section>
    </main>

    <script src="assets/js/tampil_buku.js"></script>
</body>
</html>