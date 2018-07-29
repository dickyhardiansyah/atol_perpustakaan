<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <table class="striped">
            <thead>
                <tr>
                    <td>Kode</td>
                    <td>Judul</td>
                    <td>Penulis</td>
                    <td>Tahun</td>
                    <td>Stok</td>
                    <td>Penerbit</td>
                    <td>Genre</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($buku) === 0) { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php } ?>
                <?php foreach ($buku as $item) { ?>
                    <tr>
                        <td><?php echo $item->kodeBuku; ?></td>
                        <td><?php echo $item->judul; ?></td>
                        <td><?php echo $item->penulis; ?></td>
                        <td><?php echo $item->tahunTerbit; ?></td>
                        <td><?php echo $item->stok; ?></td>
                        <td><?php echo $item->penerbit; ?></td>
                        <td><?php echo $item->genre; ?></td>
                        <td id="<?php echo $item->kodeBuku ?>">
                            <button class="btn red accent-4 waves-effect waves-light hapus"><i class="material-icons">delete</i></button>
                            <a class="btn red accent-4 waves-effect waves-light edit" href="/perpustakaan/buku/ubah.php?id=<?php echo $item->kodeBuku ?>"><i class="material-icons">edit</i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        $('.hapus').click(evt => {
            const target = $(evt.target)
            const targetId = target.parents('td').attr('id')

            if (confirm(`Apakah anda yakin ingin menghapus buku dengan kode ${targetId}`)) {
                $.ajax({
                    url: `/perpustakaan/app/controllers/buku/hapus.php?kode=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert("Berhasil menghapus buku")
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>