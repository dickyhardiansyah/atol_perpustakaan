<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/buku_repository.php");

if (isset($_POST["submit"])) {
  $kode_buku = $_POST["kode_buku"];
  $judul = $_POST["judul"];
  $pengarang = $_POST["pengarang"];
  $penerbit = $_POST["penerbit"];
  $jml_buku = $_POST["jml_buku"];
  $kode_buku_lama = $_POST["kode_buku_lama"];
  
  update_buku([
    "kode_buku" => $kode_buku,
    "judul" => $judul,
    "pengarang" => $pengarang,
    "penerbit" => $penerbit,
    "jml_buku" => $jml_buku,
    "kode_buku_lama" => $kode_buku_lama
  ]);
}

header("location: ../ubah_buku.php?nim=$nim");

?>