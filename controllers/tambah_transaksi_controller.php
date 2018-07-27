<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/transaksi_repository.php");

if (isset($_POST["submit"])) {
  $id_transaksi = $_POST["id_transaksi"];
  $nama = $_POST["nama"];
  $judul = $_POST["judul"];
  $tanggal_pinjam = $_POST["tanggal_pinjam"];
  $tanggal_kembali = $_POST["tanggal_kembali"];

  insert_transaksi([
    "id_transaksi" => $id_transaksi,
    "nama" => $nama,
    "judul" => $judul,
    "tanggal_pinjam" => $tanggal_pinjam,
    "tanggal_kembali" => $tanggal_kembali
  ]);
}

header("location: ../tambah_transaksi.php");

?>