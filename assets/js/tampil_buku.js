function confirmDeletion(kode_buku) {
    if (confirm(`Yakin ingin menghapus buku dengan kode ${kode_buku}?`)) {
        window.location = `controllers/hapus_buku_controller.php?kode_buku=${kode_buku}`    
    }
}