<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/anggota_repository.php");

if (isset($_GET["nim"])) {
  $nim = $_GET["nim"];

  hapus_anggota($nim);
}

header("location: ../tampil_anggota.php");

?>