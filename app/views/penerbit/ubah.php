<?php include_once('../app/views/templates/header.php'); ?>

<main class="valign-wrapper" style="height: 100%">
    <div class="container">
        <form>
            <input type="hidden" id="kode_lama" value="<?php echo $penerbit->kodePenerbit ?>">

            <div class="input-field">
                <label for="kode">Kode Penerbit</label>
                <input type="text" name="kode" id="kode" value="<?php echo $penerbit->kodePenerbit ?>">
            </div>

            <div class="input-field">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?php echo $penerbit->nama ?>">
            </div>

            <button class="btn red accent-4 waves-light waves-effect" id="ubah" type="submit">Simpan</button>
        </form>
    </div>
</main>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        $('#ubah').click(() => {
            $.ajax({
                url: '/perpustakaan/app/controllers/penerbit/ubah.php',
                type: 'POST',
                data: {
                    kodeLama: $('#kode_lama').val(),
                    kode: $('#kode').val(),
                    nama: $('#nama').val(),
                    ubah: true
                },
                success: (response) => {
                    const resp = JSON.parse(response)
                    if (resp.status === 200) {
                        alert('Berhasil memperbarui penerbit')
                        window.location = '/perpustakaan/penerbit'
                    } else {
                        alert(resp.message)
                    }
                }
            });
        })

        $('form').submit(evt => evt.preventDefault())
    })
</script>