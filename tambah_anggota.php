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
    <title>Tambah Anggota - Sistem Informasi Perpustakaan</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu">
                    <a href="tampil_anggota.php">Lihat Anggota</a>
                </li>
                <li class="side-bar-menu">
                    <a href="tambah_anggota.php">Tambah Anggota</a>
                </li>
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

            <article style="padding:24px;">
                <form action="controllers/tambah_anggota_controller.php" method="post" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" id="nim" placeholder="101161xx" maxlength="10">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" placeholder="Budi Taher">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Laki-laki" checked> Laki-laki
                        <input type="radio" name="jenis_kelamin" id="jenis_kelamin" value="Perempuan"> Perempuan
                    </div>

                    <div class="form-group">
                        <label for="no_telepon">Program Studi</label>
                        <input type="text" name="program_studi" id="program_studi" placeholder="Teknik Informatika">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>

                <?php if (isset($_SESSION['sukses']) && $_SESSION['sukses'] === 1) { ?>
                    <p class="success">Berhasil menambahkan data anggota</p>
                    <?php $_SESSION['sukses'] = 0; ?>
                <?php } ?>
            </article>
        </section>
    </main>
</body>

</html>