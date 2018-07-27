function confirmDeletion(nim) {
    if (confirm(`Yakin ingin menghapus anggota dengan nim ${nim}?`)) {
        window.location = `controllers/hapus_anggota_controller.php?nim=${nim}`    
    }
}