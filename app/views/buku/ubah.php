<?php include_once('../app/views/templates/header.php'); ?>

<main class="valign-wrapper" style="height: 100%">
    <div class="container">
        <form>
            <input type="hidden" id="kode_lama" value="<?php echo $buku->kodeBuku ?>">

            <div class="input-field">
                <label for="kode">Kode Buku</label>
                <input type="text" maxlength="10" name="kode" id="kode" class="validate" value="<?php echo $buku->kodeBuku ?>">
            </div>

            <div class="input-field">
                <label for="judul">Judul</label>
                <input type="text" name="judul" id="judul" class="validate" value="<?php echo $buku->judul ?>">
            </div>

            <div class="input-field">
                <label for="penulis">Penulis</label>
                <input type="text" name="penulis" id="penulis" class="validate" value="<?php echo $buku->penulis ?>">
            </div>

            <div class="input-field">
                <label for="tahun">Tahun Terbit</label>
                <input type="number" name="tahun" id="tahun" min="1950" max="2018" class="validate" value="<?php echo $buku->tahunTerbit ?>">
            </div>

            <div class="input-field">
                <label for="stok">Stok</label>
                <input type="number" name="stok" id="stok" min="1" class="validate" value="<?php echo $buku->stok ?>">
            </div>
            
            <div class="input-field">
                <select id="kode_penerbit" class="validate">
                    <option value="" disabled selected>Pilih Penerbit</option>
                    <?php foreach ($penerbit as $option) { ?>
                        <option value="<?php echo $option->kodePenerbit ?>" <?php echo $buku->penerbit === $option->nama ? 'selected' : '' ?>><?php echo $option->nama ?></option> 
                    <?php } ?>
                </select>
                <label for="kode_penerbit">Penerbit</label>
            </div>

            <div class="input-field">
                <select id="id_genre" class="validate">
                    <option value="" disabled selected>Pilih Genre</option>
                    <?php foreach ($genre as $option) { ?>
                        <option value="<?php echo $option->idGenre ?>" <?php echo $buku->genre === $option->genre ? 'selected' : '' ?>><?php echo $option->genre ?></option> 
                    <?php } ?>
                </select>
                <label for="id_genre">Genre</label>
            </div>

            <button class="btn red accent-4 waves-light waves-effect" id="ubah" type="submit">Simpan</button>
        </form>
    </div>
</main>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    Number.prototype.pad = function(size) {
        var s = String(this);
        while (s.length < (size || 2)) {s = "0" + s;}
        return s;
    }
    $(document).ready(() => {
        const penerbit = JSON.parse('<?php echo json_encode($penerbit); ?>') 
        const genre = JSON.parse('<?php echo json_encode($genre); ?>') 

        let kodePenerbit = ''
        let idGenre = ''
        let bookNum = ''

        let pad = (number, size) => {
            let s = String(number);
            while (s.length < (size || 2)) {s = "0" + s;}
            return s;
        }

        let changeKodeBuku = () => {
            $('#kode').val(`${kodePenerbit}${idGenre}${bookNum}`)
        }

        let getBookNum = () => {
            $.ajax({
                url: '/perpustakaan/app/controllers/buku/count.php',
                type: 'POST',
                data: {
                    kodePenerbit: kodePenerbit,
                    idGenre: idGenre
                },
                success: (response) => {
                    const num = parseInt(response) + 1
                    bookNum = pad(num, 5)
                    changeKodeBuku()
                }
            })
        }

        $('#id_genre').change(() => {
            idGenre = $('#id_genre').val()
            getBookNum()
        })

        $('#kode_penerbit').change(() => {
            kodePenerbit = $('#kode_penerbit').val()
            getBookNum()
        })

        $('select').formSelect()

        $('#ubah').click(() => {
            $.ajax({
                url: '/perpustakaan/app/controllers/buku/ubah.php',
                type: 'POST',
                data: {
                    kodeLama: $('#kode_lama').val(),
                    kode: $('#kode').val(),
                    judul: $('#judul').val(),
                    penulis: $('#penulis').val(),
                    tahun: $('#tahun').val(),
                    stok: $("#stok").val(),
                    kodePenerbit: $("#kode_penerbit").val(),
                    idGenre: $("#id_genre").val(),
                    ubah: true
                },
                success: (response) => {
                    console.log(response)
                    const resp = JSON.parse(response)
                    if (resp.status === 200) {
                        alert('Berhasil memperbarui buku')
                        window.location = '/perpustakaan/buku'
                    } else {
                        alert(resp.message)
                    }
                }
            });
        })

        $('form').submit(evt => evt.preventDefault())
    })
</script>