<?php

function insert_transaksi($transaksi) {
  $link = get_connection();

  $query = "INSERT INTO transaksi VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $query) or die("Error pas buat stmt, errornya: " . mysqli_error($link));
  mysqli_stmt_bind_param(
    $stmt, 
    "sssss", 
    $transaksi["id_transaksi"],
    $transaksi["nama"],
    $transaksi["judul"],
    $transaksi["tanggal_pinjam"],
    $transaksi["tanggal_kembali"] 

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

function find_all_transaksi() {
  $link = get_connection();

  $query = "SELECT * FROM transaksi ORDER BY nama";
  $result = mysqli_query($link, $query);
  mysqli_close($link);
  return $result;
}

function hapus_transaksi($id_transaksi) {
  $link = get_connection();

  $query = "DELETE FROM transaksi WHERE id_transaksi=?";
  $stmt = mysqli_prepare($link, $query);
  mysqli_stmt_bind_param($stmt, "s", $id_transaksi);
  mysqli_stmt_execute($stmt);

  if (!mysqli_stmt_errno($stmt)) {
    mysqli_close($link);
    mysqli_stmt_close($stmt);
  } else {
    echo mysqli_stmt_error($stmt); die();
  }
}

?>