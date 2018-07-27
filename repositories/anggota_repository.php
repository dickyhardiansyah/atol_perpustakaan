<?php

function insert_anggota($anggota) {
  $link = get_connection();

  $query = "INSERT INTO anggota VALUES (?, ?, ?, ?,?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "sssss", 
    $anggota["nim"], 
    $anggota["nama"], 
    $anggota["tanggal_lahir"], 
    $anggota["jenis_kelamin"],
    $anggota["program_studi"]
  ) or die(mysqli_stmt_error($stmt));
  mysqli_stmt_execute($stmt) or die(mysqli_stmt_error($stmt));
  
  if (!mysqli_stmt_errno($stmt)) {
    $_SESSION['sukses'] = 1;
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

function find_all_anggota() {
  $link = get_connection();

  $query = "SELECT * FROM anggota ORDER BY nim";
  $result = mysqli_query($link, $query);
  mysqli_close($link);
  return $result;
}

function find_by_nim($nim) {
  $link = get_connection();

  $query = "SELECT * FROM anggota WHERE nim=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "d", $nim);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt,$nim,$nama,$jenis_kelamin,$tanggal_lahir,$program_studi);

  $result = [];
  if (mysqli_stmt_fetch($stmt)) {
    $result["nim"] = $nim;
    $result["nama"] = $nama;
    $result["jenis_kelamin"] = $jenis_kelamin;
    $result["tanggal_lahir"] = $tanggal_lahir;
    $result["program_studi"] = $program_studi;
  }
  mysqli_stmt_close($stmt);
  return $result;
} 

function update_anggota($anggota) {
  $link = get_connection();

  $query = "UPDATE anggota SET nim=?, nama=?, jenis_kelamin=?, tanggal_lahir= ?, program_studi=? WHERE nim=?";
  $stmt = mysqli_prepare($link, $query) or die(mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "ssssss", 
    $anggota['nim'],
    $anggota['nama'],
    $anggota['jenis_kelamin'],
    $anggota['tanggal_lahir'],
    $anggota['program_studi'],
    $anggota['nim_lama']
  );

  mysqli_stmt_execute($stmt);
  if (!mysqli_stmt_errno($stmt)) {
    $_SESSION['sukses'] = 1;
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

function hapus_anggota($nim) {
  $link = get_connection();

  $query = "DELETE FROM anggota WHERE nim=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $nim);
  mysqli_stmt_execute($stmt);

  if (!mysqli_stmt_errno($stmt)) {
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}