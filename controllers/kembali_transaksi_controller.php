<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/transaksi_repository.php");
require_once("../repositories/buku_repository.php");

if (isset($_GET["id_transaksi"])) {
  $id_transaksi = $_GET["id_transaksi"];

  hapus_transaksi($id_transaksi);
  kembali_buku($judul);

}

header("location: ../tampil_transaksi.php");

?>