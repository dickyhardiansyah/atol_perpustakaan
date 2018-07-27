<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');

$menus = get_menu();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beranda - Sistem Informasi Prpustakaan</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/index.css">
</head>
<body>
    <main class="flex column">
        <header>
            <nav class="nav-bar primary-color flex">
                <ul class="flex">
                    <?php foreach ($menus as $menu) { ?>
                        <li class="nav-menu">
                            <a href="<?php echo $menu['link'] ?>" class="<?php echo $menu['judul'] === 'Beranda' ? 'active' : ''; ?>">
                                <?php echo $menu['judul']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </header>
    
        <main class="flex center-vertical spread">
            <section class="card">
                <p class="card-title">Anggota</p>
                <ul>
                    <li class="card-list">
                        <a href="tampil_anggota.php">Lihat Anggota</a>
                    </li>
                </ul>
            </section>

            <section class="card">
                <p class="card-title">Buku</p>
                <ul>
                    <li class="card-list">
                        <a href="tampil_buku.php">Lihat Buku</a>
                    </li>
                </ul>
            </section>

            <section class="card">
                <p class="card-title">Transaksi</p>
                <ul>
                    <li class="card-list">
                        <a href="lihat_kelas.php">Lihat Transaksi</a>
                    </li>
                </ul>
            </section>

        </main>
    </main>
</body>
</html>