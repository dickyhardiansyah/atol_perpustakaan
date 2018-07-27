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

  insert_anggota([
    "nim" => $nim,
    "nama" => $nama,
    "tanggal_lahir" => $tanggal_lahir,
    "jenis_kelamin" => $jenis_kelamin,
    "program_studi" => $program_studi
  ]);
}

header("location: ../tambah_anggota.php");

?>