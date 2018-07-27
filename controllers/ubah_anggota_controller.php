<?php

require_once("../core/init.php");
require_once("../services/database.php");
require_once("../repositories/anggota_repository.php");

if (isset($_POST["submit"])) {
  $nim = $_POST["nim"];
  $nama = $_POST["nama"];
  $tanggal_lahir = $_POST["tanggal_lahir"];
  $jenis_kelamin = $_POST["jenis_kelamin"];
  $program_studi = $_POST["program_studi"];
  $nim_lama = $_POST["nim_lama"];
  
  update_anggota([
    "nim" => $nim,
    "nama" => $nama,
    "tanggal_lahir" => $tanggal_lahir,
    "jenis_kelamin" => $jenis_kelamin,
    "program_studi" => $program_studi,
    "nim_lama" => $nim_lama
  ]);
}

header("location: ../ubah_anggota.php?nim=$nim");

?>