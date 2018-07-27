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
    <title>Tambah Buku - Sistem Informasi Perpustakaan</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu">
                    <a href="tampil_buku.php">Lihat Buku</a>
                </li>
                <li class="side-bar-menu">
                    <a href="tambah_buku.php">Tambabh Buku</a>
                </li>
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

            <article style="padding:24px;">
                <form action="controllers/tambah_buku_controller.php" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="kode_buku">Kode</label>
                        <input type="text" name="kode_buku" id="kode_buku" placeholder="BKxxx" maxlength="10">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" placeholder="Algoritma">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" name="pengarang" id="pengarang" placeholder="Soesanto">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" name="penerbit" id="penerbit" placeholder="Gramedia">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="jml_buku">Jumlah</label>
                        <input type="text" name="jml_buku" id="jml_buku" placeholder="3" >
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>

                <?php if (isset($_SESSION['sukses']) && $_SESSION['sukses'] === 1) { ?>
                    <p class="success">Berhasil menambahkan data buku</p>
                    <?php $_SESSION['sukses'] = 0; ?>
                <?php } ?>
            </article>
        </section>
    </main>
</body>

</html>