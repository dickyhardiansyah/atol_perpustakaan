<?php include_once('../app/views/templates/header.php'); ?>

<style>
.datepicker-date-display, .datepicker-table td.is-selected {
    background-color: #d50000;
}
.btn-flat, .datepicker-table td.is-today, select-options-a15b68a4-1952-ac6f-d947-dfcd001ce412 {
    color: #d50000;
}
</style>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <form>
            <div class="input-field">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="validate">
            </div>

            <div class="input-field">
                <label for="instansi">Instansi</label>
                <input type="text" name="instansi" id="instansi" class="validate">
            </div>

            <div class="input-field">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" class="validate materialize-textarea"></textarea>
            </div>

            <div class="input-field">
                <input type="text" name="ttl" id="ttl" class="validate datepicker">
                <label for="ttl">Tanggal Lahir</label>
            </div>

            <label for="jk">Jenis Kelamin</label>
            <p>
                <label>
                    <input type="radio" name="jk" value="Laki-laki" checked>
                    <span>Laki-laki</span> 
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="jk" value="Perempuan">
                    <span>Perempuan</span> 
                </label>
            </p>

            <button class="btn red accent-4 waves-light waves-effect" id="tambah">Tambah</button>
        </form>
    </div>
</main>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
            yearRange: 80
        })

        $('#tambah').click(() => {
            $.ajax({
                url: '<?php echo ROOT ?>app/controllers/anggota/tambah.php',
                type: 'POST',
                data: {
                    nama: $('#nama').val(),
                    instansi: $('#instansi').val(),
                    alamat: $('#alamat').val(),
                    tanggalLahir: $('#ttl').val(),
                    jk: $('input[name="jk"]:checked').val(),
                    tambah: true
                },
                success: (response) => {
                    const resp = JSON.parse(response)
                    if (resp.status === 200) {
                        alert('Berhasil menambahkan anggota baru')
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