<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <table class="striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nama</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($penerbit) === 0) { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php } ?>
                <?php foreach ($penerbit as $item) { ?>
                    <tr>
                        <td><?php echo $item->kodePenerbit; ?></td>
                        <td><?php echo $item->nama; ?></td>
                        <td id="<?php echo $item->kodePenerbit ?>">
                            <button class="btn red accent-4 waves-effect waves-light hapus"><i class="material-icons">delete</i></button>
                            <a class="btn red accent-4 waves-effect waves-light edit" href="/perpustakaan/penerbit/ubah.php?id=<?php echo $item->kodePenerbit ?>"><i class="material-icons">edit</i></a>
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

            if (confirm(`Apakah anda yakin ingin menghapus penerbit dengan id ${targetId}`)) {
                $.ajax({
                    url: `/perpustakaan/app/controllers/penerbit/hapus.php?id=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert("Berhasil menghapus penerbit")
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>