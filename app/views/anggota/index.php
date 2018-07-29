<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <table class="striped">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>JK</td>
                    <td>Alamat</td>
                    <td>Tanggal Lahir</td>
                    <td>Instansi</td>
                    <td>Bergabung</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($anggota) === 0) { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php } ?>
                <?php foreach ($anggota as $item) { ?>
                    <tr>
                        <td><?php echo $item->nama; ?></td>
                        <td><?php echo $item->jenisKelamin; ?></td>
                        <td><?php echo $item->alamat; ?></td>
                        <td><?php echo $item->tanggalLahir; ?></td>
                        <td><?php echo $item->instansi; ?></td>
                        <td><?php echo $item->tanggalBergabung; ?></td>
                        <td id="<?php echo $item->idAnggota ?>">
                            <button class="btn red accent-4 waves-effect waves-light hapus"><i class="material-icons">delete</i></button>
                            <a class="btn red accent-4 waves-effect waves-light edit" href="/perpustakaan/anggota/ubah.php?id=<?php echo $item->idAnggota ?>"><i class="material-icons">edit</i></a>
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

            if (confirm(`Apakah anda yakin ingin menghapus anggota dengan id ${targetId}`)) {
                $.ajax({
                    url: `/perpustakaan/app/controllers/anggota/hapus.php?id=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert("Berhasil menghapus anggota")
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>