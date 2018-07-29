<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <table class="striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Peminjam</td>
                    <td>Buku</td>
                    <td>Status</td>
                    <td>Dipinjam</td>
                    <td>Pengembalian</td>
                    <td>Dikembalikan</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($peminjaman) === 0) { ?>
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
                <?php foreach ($peminjaman as $item) { ?>
                    <tr>
                        <td><?php echo $item->idPeminjaman; ?></td>
                        <td><?php echo $item->peminjam; ?></td>
                        <td><?php echo $item->buku; ?></td>
                        <td><?php echo $item->status; ?></td>
                        <td><?php echo $item->tanggalPeminjaman; ?></td>
                        <td><?php echo $item->tanggalPengembalian; ?></td>
                        <td><?php echo $item->tanggalDikembalikan ? $item->tanggalDikembalikan : '-' ; ?></td>
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
    })
</script>