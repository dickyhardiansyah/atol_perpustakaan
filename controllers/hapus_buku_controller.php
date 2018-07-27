<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/buku_repository.php");

if (isset($_GET["kode_buku"])) {
  $kode_buku = $_GET["kode_buku"];

  hapus_buku($kode_buku);
}

header("location: ../tampil_buku.php");

?>