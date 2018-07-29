<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <form>
            <input type="hidden" id="id" value="<?php echo $petugas->idPetugas ?>">

            <div class="input-field">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" value="<?php echo $petugas->nama ?>">
            </div>

            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $petugas->username ?>">
            </div>

            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <label for="jenis">Jenis</label>
            <p>
                <label>
                    <input type="radio" name="jenis" value="Admin" <?php echo $petugas->jenis === 'Admin' ? 'checked' : '' ?>>
                    <span>Admin</span> 
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="jenis" value="Buku" <?php echo $petugas->jenis === 'Buku' ? 'checked' : '' ?>>
                    <span>Buku</span> 
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="jenis" value="Transaksi" <?php echo $petugas->jenis === 'Transaksi' ? 'checked' : '' ?>>
                    <span>Transaksi</span> 
                </label>
            </p>

            <button class="btn red accent-4 waves-light waves-effect" id="ubah" type="submit">Simpan</button>
        </form>
    </div>
</main>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        $('#ubah').click(() => {
            $.ajax({
                url: '<?php echo ROOT ?>app/controllers/petugas/ubah.php',
                type: 'POST',
                data: {
                    id: $('#id').val(),
                    nama: $('#nama').val(),
                    username: $('#username').val(),
                    password: $('#password').val(),
                    jenis: $("input[name='jenis']:checked").val(),
                    ubah: true
                },
                success: (response) => {
                    console.log(response)
                    const resp = JSON.parse(response)
                    if (resp.status === 200) {
                        alert('Berhasil memperbarui petugas')
                        window.location = '<?php echo ROOT ?>petugas'
                    } else {
                        alert(resp.message)
                    }
                }
            });
        })

        $('form').submit(evt => evt.preventDefault())
    })
</script>