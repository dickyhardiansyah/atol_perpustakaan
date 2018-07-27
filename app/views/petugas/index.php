<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <table class="striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nama</td>
                    <td>Jenis</td>
                    <td>Username</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($petugas) === 0) { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php } ?>
                <?php foreach ($petugas as $item) { ?>
                    <tr>
                        <td><?php echo $item->idPetugas; ?></td>
                        <td><?php echo $item->nama; ?></td>
                        <td><?php echo $item->jenis; ?></td>
                        <td><?php echo $item->username; ?></td>
                        <td id="<?php echo $item->idPetugas ?>">
                            <button class="btn red accent-4 waves-effect waves-light hapus"><i class="material-icons">delete</i></button>
                            <a class="btn red accent-4 waves-effect waves-light edit" href="/perpustakaan/petugas/ubah.php?id=<?php echo $item->idPetugas ?>"><i class="material-icons">edit</i></a>
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

            if (confirm(`Apakah anda yakin ingin menghapus petugas dengan id ${targetId}`)) {
                $.ajax({
                    url: `/perpustakaan/app/controllers/petugas/hapus.php?id=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert("Berhasil menghapus petugas")
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>