<?php

require_once('core/init.php');
require_once('middlewares/login_middleware.php');
require_once('services/database.php');
require_once('repositories/anggota_repository.php');
require_once('repositories/buku_repository.php');

$menus = get_menu();

$result = find_all_anggota();
$anggotaList = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($anggotaList, [
        "nama" => $row["nama"]
    ]);
}

$result = find_all_buku();
$bukuList = [];
while ($row = mysqli_fetch_assoc($result)) {
    array_push($bukuList, [
        "judul" => $row["judul"]
    ]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Transaksi - Sistem Informasi Perpustakaan</title>

    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
    <main class="flex">
        <sidebar class="side-bar primary-orange-color">
            <h3 class="side-bar-title">Selamat Datang, Admin</h3>
            <ul>
                <li class="side-bar-menu">
                    <a href="tampil_transaksi.php">Lihat Transaksi</a>
                </li>
                <li class="side-bar-menu">
                    <a href="tambah_transaksi.php">Tambah Transaksi</a>
                </li>
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

            <article style="padding:24px;">
                <form action="controllers/tambah_transaksi_controller.php" method="post" onsubmit="return validateForm()">

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <select name="nama" id="nama">
                            <?php foreach ($anggotaList as $anggota) { ?>
                            <option value="<?php echo $anggota['nama']; ?>">
                                <?php echo $anggota['nama']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <select name="judul" id="judul">
                            <?php foreach ($bukuList as $buku) { ?>
                            <option value="<?php echo $buku['judul']; ?>">
                                <?php echo $buku['judul']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kembali">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="tanggal_kembali">
                        <small class="hide">* Isi ini dulu yuk</small>
                    </div>                    

                    <div class="form-group">
                        <input type="submit" value="Simpan" class="btn accent-color" name="submit">
                    </div>
                </form>

                <?php if (isset($_SESSION['sukses']) && $_SESSION['sukses'] === 1) { ?>
                    <p class="success">Berhasil menambahkan siswa baru</p>
                    <?php $_SESSION['sukses'] = 0; ?>
                <?php } ?>
            </article>
        </section>
    </main>
</body>

</html>