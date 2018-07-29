<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <form>
            <div class="input-field">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama">
            </div>

            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>

            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>

            <label for="jenis">Jenis</label>
            <p>
                <label>
                    <input type="radio" name="jenis" value="Admin" checked>
                    <span>Admin</span> 
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="jenis" value="Buku">
                    <span>Buku</span> 
                </label>
            </p>
            <p>
                <label>
                    <input type="radio" name="jenis" value="Transaksi">
                    <span>Transaksi</span> 
                </label>
            </p>

            <button class="btn red accent-4 waves-light waves-effect" id="tambah" type="submit">Daftar</button>
        </form>
    </div>
</main>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        $('#tambah').click(() => {
            $.ajax({
                url: '<?php echo ROOT ?>app/controllers/petugas/tambah.php',
                type: 'POST',
                data: {
                    nama: $('#nama').val(),
                    username: $('#username').val(),
                    password: $('#password').val(),
                    jenis: $("input[name='jenis']:checked").val(),
                    daftar: true
                },
                success: (response) => {
                    const resp = JSON.parse(response)
                    if (resp.status === 200) {
                        alert('Berhasil menambahkan petugas baru')
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