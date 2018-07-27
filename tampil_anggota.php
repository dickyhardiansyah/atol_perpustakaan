<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/anggota_repository.php');

$menus = get_menu();
$results = find_all_anggota();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anggota - Sistem Informasi Perpustakaan</title>
    
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu"><a href="tampil_anggota.php">Lihat Anggota</a></li>
                <li class="side-bar-menu"><a href="tambah_anggota.php">Tambah Anggota</a></li>
            </ul>
        </sidebar>

        <section class="column flex fg-1">
            <header>
                <nav class="nav-bar primary-color flex">
                    <ul class="flex">
                        <?php foreach ($menus as $menu) { ?>
                            <li class="nav-menu">
                                <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'Data Anggota' ? 'active' : ''; ?>">
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
                        <li><h4>NIM</h4></li>
                        <li><h4>Nama Anggota</h4></li>
                        <li><h4>Tanggal Lahir</h4></li>
                        <li><h4>Jenis Kelamin</h4></li>
                        <li><h4>Program Studi</h4></li>
                        <li><h4>Aksi</h4></li>
                    </ul>

                    <?php foreach ($results as $anggota) { ?>
                    <ul class="data-body">
                        <li><?php echo $anggota['nim']; ?></li>
                        <li><?php echo $anggota['nama']; ?></li>
                        <li><?php echo $anggota['tanggal_lahir']; ?></li>
                        <li><?php echo $anggota['jenis_kelamin']; ?></li>
                        <li><?php echo $anggota['program_studi']; ?></li>
                        <li>
                            <a href="ubah_anggota.php?nim=<?php echo $anggota['nim']; ?>" 
                                class="btn btn-data">
                                Ubah
                            </a>
                            <button class="btn btn-data" 
                                onclick="confirmDeletion('<?php echo $anggota['nim']; ?>')">
                                Hapus
                            </button>
                        </li>
                    </ul>
                    <?php } ?>
                </ul>
        </section>
    </main>

    <script src="assets/js/tampil_anggota.js"></script>
</body>
</html>