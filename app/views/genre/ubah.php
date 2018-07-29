<?php include_once('../app/views/templates/header.php'); ?>

<main class="valign-wrapper" style="height: 100%">
    <div class="container">
        <form>
            <input type="hidden" id="id" value="<?php echo $genre->idGenre ?>">

            <div class="input-field">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?php echo $genre->genre ?>">
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
                url: '<?php echo ROOT ?>app/controllers/genre/ubah.php',
                type: 'POST',
                data: {
                    id: $('#id').val(),
                    nama: $('#nama').val(),
                    ubah: true
                },
                success: (response) => {
                    console.log(response)
                    const resp = JSON.parse(response)
                    if (resp.status === 200) {
                        alert('Berhasil memperbarui genre')
                        window.location = '<?php echo ROOT ?>genre'
                    } else {
                        alert(resp.message)
                    }
                }
            });
        })

        $('form').submit(evt => evt.preventDefault())
    })
</script>