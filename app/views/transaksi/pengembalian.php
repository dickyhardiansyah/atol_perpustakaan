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
                <select id="peminjaman" class="validate">
                    <option value="" disabled selected>Pilih Peminjaman</option>
                </select>
                <label for="peminjaman">Peminjaman</label>
            </div>

            <div class="input-field">
                <label for="denda">Denda</label>
                <input type="text" name="denda" id="denda" class="validate" value="0" disabled>
            </div>

            <input type="hidden" id="kode" value="">

            <button class="btn red accent-4 waves-light waves-effect" id="kembali" type="submit">Kembali</button>
        </form>
    </div>
</main>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script src="../app/public/js/moment.js"></script>
<script>
    $(document).ready(() => {
        let peminjaman = [];
        $('#id_anggota').change(() => {
            $.ajax({
                url: '/perpustakaan/app/controllers/transaksi/anggota.php',
                type: 'POST',
                data: {
                    idAnggota: $('#id_anggota').val()
                },
                success: (response) => {
                    peminjaman = JSON.parse(response)

                    $('#peminjaman option').remove()
                    $('#peminjaman').append($('<option>', {
                        value: '',
                        disabled: true,
                        text: 'Pilih Peminjaman',
                        selected: true
                    }))

                    for (let option of peminjaman) {
                        $('#peminjaman').append($('<option>', {
                            value: option.id,
                            text: option.judul
                        }))
                    }

                    $('#peminjaman').formSelect()
                    $('#denda').val('0')
                }
            });
        })

        $('#peminjaman').change(() => {
            let selectedPeminjaman = {}
            for (let item of peminjaman) {
                if (item.id == $('#peminjaman').val()) {
                    selectedPeminjaman = item
                    break
                }
            }

            $('#kode').val(selectedPeminjaman.kodeBuku)

            const now = moment()
            const deadline = moment(selectedPeminjaman.deadline, 'YYYY-MM-DD')
            const diff = now.diff(deadline, 'days')
            const denda = 1000 * diff;
            $('#denda').val(denda > 0 ? denda : 0)
        })

        $('select').formSelect()

        $('#kembali').click(() => {
            $.ajax({
                url: '/perpustakaan/app/controllers/transaksi/pengembalian.php',
                type: 'POST',
                data: {
                    id_peminjaman: $('#peminjaman').val(),
                    kode_buku: $('#kode').val(),
                    kembali: true
                },
                success: (response) => {
                    alert('Berhasil melakukan pengembalian')
                    window.location = '/perpustakaan/transaksi'
                }
            });
        })

        $('form').submit(evt => evt.preventDefault())
    })
</script>