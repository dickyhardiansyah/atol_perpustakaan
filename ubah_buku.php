<?php

require_once('core/init.php'); 
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/buku_repository.php');

if (!isset($_GET["kode_buku"])) {
    header("location: tampil_buku.php");
}

$menus = get_menu();
$buku = find_by_kode_buku($_GET["kode_buku"]);

if ($buku === []) {
    header("location: tampil_buku.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ubah Buku - Sistem Informasi Perpustakaan</title>

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
                    <a href="tambah_buku.php">Tambah Buku</a>
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

            <article>
                <form action="controllers/ubah_buku_controller.php" method="post" onsubmit="return validateForm()">
                    <input type="hidden" name="kode_buku_lama" id="kode_buku_lama" value="<?php echo $buku['kode_buku'] ?>">

                    <div class="form-group">
                        <label for="nis">Kode</label>
                        <input type="text" 
                            name="kode_buku" id="kode_buku" 
                            maxlength="10"
                            value="<?php echo $buku["kode_buku"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" 
                            name="judul" id="judul" 
                            value="<?php echo $buku["judul"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="pengarang">Pengarang</label>
                        <input type="text" 
                            name="pengarang" 
                            id="pengarang"
                            value="<?php echo $buku["pengarang"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="penerbit">Penerbit</label>
                        <input type="text" 
                            name="penerbit" 
                            id="penerbit"
                            value="<?php echo $buku["penerbit"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="jml_buku">Jumlah</label>
                        <input type="text" 
                            name="jml_buku" 
                            id="jml_buku"
                            value="<?php echo $buku["jml_buku"] ?>">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>

                <?php if (isset($_SESSION['sukses']) && $_SESSION['sukses'] === 1) { ?>
                    <p class="success">Berhasil merubah data anggota</p>
                    <?php $_SESSION['sukses'] = 0; ?>
                <?php } ?>
            </article>
        </section>
    </main>

    <script src="assets/js/tambah_buku.js"></script>
</body>

</html>