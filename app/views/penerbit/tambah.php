<?php include_once('../app/views/templates/header.php'); ?>

<main class="valign-wrapper" style="height:100%">
    <div class="container">
        <form>
            <div class="input-field">
                <label for="kode">Kode Penerbit</label>
                <input type="text" name="kode" id="kode" maxlength='4'>
            </div>

            <div class="input-field">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </div>

            <button class="btn red accent-4 waves-light waves-effect" id="tambah" type="submit">Tambah</button>
        </form>
    </div>
</main>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        $('#tambah').click(() => {
            $.ajax({
                url: '/perpustakaan/app/controllers/penerbit/tambah.php',
                type: 'POST',
                data: {
                    nama: $('#nama').val(),
                    kode: $('#kode').val(),
                    tambah: true
                },
                success: (response) => {
                    console.log(response)
                    const resp = JSON.parse(response)
                    if (resp.status === 200) {
                        alert('Berhasil menambahkan penerbit baru')
                        location.reload()
                    } else {
                        alert(resp.message)
                    }
                }
            });
        })

        $('form').submit(evt => evt.preventDefault())
    })
</script>