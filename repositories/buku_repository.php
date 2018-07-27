<?php

function insert_buku($buku) {
  $link = get_connection();

  $query = "INSERT INTO buku VALUES (?, ?, ?, ?,?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "sssss", 
    $buku["kode_buku"],
    $buku["judul"],
    $buku["pengarang"],
    $buku["penerbit"],
    $buku["jml_buku"] 

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

function find_all_buku() {
  $link = get_connection();

  $query = "SELECT * FROM buku ORDER BY kode_buku";
  $result = mysqli_query($link, $query);
  mysqli_close($link);
  return $result;
}

function find_by_kode_buku($kode_buku) {
  $link = get_connection();

  $query = "SELECT * FROM buku WHERE kode_buku=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $kode_buku);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt,$kode_buku,$judul,$pengarang,$penerbit,$jml_buku);

  $result = [];
  if (mysqli_stmt_fetch($stmt)) {
    $result["kode_buku"] = $kode_buku;
    $result["judul"] = $judul;
    $result["pengarang"] = $pengarang;
    $result["penerbit"] = $penerbit;
    $result["jml_buku"] = $jml_buku;
  }
  mysqli_stmt_close($stmt);
  return $result;
}

function update_buku($buku) {
  $link = get_connection();

  $query = "UPDATE buku SET kode_buku=?, judul=?, pengarang=?, penerbit= ?, jml_buku=? WHERE kode_buku=?";
  $stmt = mysqli_prepare($link, $query) or die(mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "ssssss", 
    $buku['kode_buku'],
    $buku['judul'],
    $buku['pengarang'],
    $buku['penerbit'],
    $buku['jml_buku'],
    $buku['kode_buku_lama']
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


function hapus_buku($kode_buku) {
  $link = get_connection();

  $query = "DELETE FROM buku WHERE kode_buku=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $kode_buku);
  mysqli_stmt_execute($stmt);

  if (!mysqli_stmt_errno($stmt)) {
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

function kembali_buku($judul) {
  $link = get_connection();

  $query = "UPDATE buku set jml_buku=(jml_buku+1) WHERE judul=judul";
  $stmt = mysqli_prepare($link, $query) or die(mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "s", 
    $buku['jml_buku']
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
?>