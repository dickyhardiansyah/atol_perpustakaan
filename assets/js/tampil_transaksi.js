function confirmDeletion(id_transaksi) {
    if (confirm(`Yakin ingin mengembalikan buku dengan kode ${id_transaksi}?`)) {
        window.location = `controllers/kembali_transaksi_controller.php?id_transaksi=${id_transaksi}`    
    }
}