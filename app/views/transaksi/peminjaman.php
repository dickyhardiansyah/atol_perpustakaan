<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <form>
            <div class="input-field">
                <select id="id_anggota" class="validate">
                    <option value="" disabled selected>Pilih Anggota</option>
                    <?php foreach ($anggota as $option) { ?>
                        <option value="<?php echo $option->idAnggota ?>"><?php echo $option->nama ?></option> 
                    <?php } ?>
                </select>
                <label for="id_anggota">Nama Anggota</label>
            </div>

            <div class="input-field">
                <select id="genre" class="validate">
                    <option value="" selected>Semua</option>
                    <?php foreach ($genre as $option) { ?>
                        <option value="<?php echo $option->idGenre ?>"><?php echo $option->genre ?></option> 
                    <?php } ?>
                </select>
                <label for="genre">Genre</label>
            </div>

            <div class="input-field">
                <select id="buku" class="validate">
                    <option value="" disabled selected>Pilih Buku</option>
                    <?php foreach ($buku as $option) { ?>
                        <option value="<?php echo $option->kodeBuku ?>"><?php echo $option->judul ?></option> 
                    <?php } ?>
                </select>
                <label for="buku">Buku</label>
            </div>

            <div class="input-field">
                <input type="number" name="lama" id="lama" class="validate" min="1" max="7">
                <label for="lama">Lama Meminjam</label>
            </div>

            <button class="btn red accent-4 waves-light waves-effect" id="tambah" type="submit">Tambah</button>
        </form>
    </div>
</main>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        $buku = JSON.parse('<?php echo json_encode($buku) ?>')

        $('#genre').change(() => {
            $.ajax({
                url: '/perpustakaan/app/controllers/buku/by_genre.php',
                type: 'POST',
                data: {
                    genre: $('#genre').val()
                },
                success: (response) => {
                    buku = JSON.parse(response)
                    
                    $('#buku option').remove()
                    $('#buku').append($('<option>', {
                        value: '',
                        disabled: true,
                        text: 'Pilih Buku',
                        selected: true
                    }))

                    for (let book of buku) {
                        $('#buku').append($('<option>', {
                            value: book.kode,
                            text: book.judul
                        }))
                    }

                    $('#buku').formSelect()
                }
            });
        })

        $('select').formSelect()

        $('#tambah').click(() => {
            $.ajax({
                url: '/perpustakaan/app/controllers/transaksi/peminjaman.php',
                type: 'POST',
                data: {
                    idAnggota: $('#id_anggota').val(),
                    kodeBuku: $('#buku').val(),
                    lama: $('#lama').val(),
                    daftar: true
                },
                success: (response) => {
                    console.log(response)
                    const resp = JSON.parse(response)
                    if (resp.status === 200) {
                        alert('Berhasil melakukan peminjaman')
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