<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <div class='row valign-wrapper'>
            <div class='col s4'>
                <div class='input-field'>
                    <label for='nama' id="namaLabel">Cari Nama</label>
                    <input type='text' name='nama' id='nama'>
                </div>
            </div>

            <div class='col s2'>
                <button class='red waves-light waves-effect btn modal-trigger' data-target='filter'>
                    Filter <i class='material-icons'>filter_list</i>
                </button>
            </div>

            <div class='col s4 offset-s2'>
                <div class='input-field'>
                    <select id='orderby' class='validate'>
                        <option value='nama' selected>Nama</option>
                        <option value='jenis_kelamin'>Jenis Kelamin</option>
                        <option value='alamat'>Alamat</option>
                        <option value='tanggal_lahir'>Tanggal Lahir</option>
                        <option value='instansi'>Instansi</option>
                        <option value='tanggal_bergabung'>Tanggal Bergabung</option>
                    </select>
                    <label for='orderby'>Sort By</label>
                </div>
            </div>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <td>Nama</td>
                    <td>JK</td>
                    <td>Alamat</td>
                    <td>Tanggal Lahir</td>
                    <td>Instansi</td>
                    <td>Bergabung</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($anggota) === 0) { ?>
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
                <?php foreach ($anggota as $item) { ?>
                    <tr>
                        <td><?php echo $item->nama; ?></td>
                        <td><?php echo $item->jenisKelamin; ?></td>
                        <td><?php echo $item->alamat; ?></td>
                        <td><?php echo $item->tanggalLahir; ?></td>
                        <td><?php echo $item->instansi; ?></td>
                        <td><?php echo $item->tanggalBergabung; ?></td>
                        <td id="<?php echo $item->idAnggota ?>">
                            <button class="btn red accent-4 waves-effect waves-light hapus"><i class="material-icons">delete</i></button>
                            <a class="btn red accent-4 waves-effect waves-light edit" href="<?php echo ROOT ?>anggota/ubah.php?id=<?php echo $item->idAnggota ?>"><i class="material-icons">edit</i></a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<div id='filter' class='modal'>
    <br>
    <div class='container'>
        <div class='input-field'>
            <label for='name' id="titleLabel">Cari Nama</label>
            <input type='text' name='name' id='name'>
        </div>

        <div class='input-field'>
            <select id='jenisKelamin' class='validate'>
                <option value=''>Semua</option>
                <option value='Laki-laki'>Laki-laki</option>
                <option value='Perempuan'>Perempuan</option>
            </select>
            <label for='jenisKelamin'>Cari Jenis Kelamin</label>
        </div>

        <div class='input-field'>
            <label for='alamat'>Cari Alamat</label>
            <input type='text' name='alamat' id='alamat'>
        </div>

        <div class='input-field'>
            <label for='tanggalLahir'>Cari Tanggal Lahir</label>
            <input type='text' name='tanggalLahir' id='tanggalLahir'>
        </div>

        <div class='input-field'>
            <label for='instansi'>Cari Instansi</label>
            <input type='text' name='instansi' id='instansi'>
        </div>

        <div class='input-field'>
            <label for='tanggalBergabung'>Cari Tanggal Bergabung</label>
            <input type='text' name='tanggalBergabung' id='tanggalBergabung'>
        </div>

        <button class='btn red accent-4 waves-effect waves-light modal-close' id='tutup'>Tutup</button>
    </div>
    <br>
</div>


<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        let anggota = JSON.parse('<?php echo json_encode($anggota) ?>')

        const inflateTable = () => {
            $('tbody tr').remove()

            if (anggota.length === 0) {
                const tr = $('<tr>')
                for (let i = 0; i < 7; i++) {
                    tr.append($('<td>').append('-'))
                }
                $('tbody').append(tr)
            } else {
                for (let item of anggota) {
                    const tr = $('<tr>')
                    tr.append($('<td>').append(item.nama))
                    tr.append($('<td>').append(item.jenisKelamin))
                    tr.append($('<td>').append(item.alamat))
                    tr.append($('<td>').append(item.tanggalLahir))
                    tr.append($('<td>').append(item.instansi))
                    tr.append($('<td>').append(item.tanggalBergabung))

                    const td = $('<td>', { id: item.idAnggota })

                    const deleteButton = $('<button>', {
                        class: 'btn red accent-4 waves-effect waves-light hapus'
                    }).append($('<i>', { class: 'material-icons' }).append('delete'))
                    
                    const editButton = $('<a>', {
                        class: 'btn red accent-4 waves-effect waves-light edit',
                        href: `<?php echo ROOT ?>anggota/ubah.php?id=${item.idAnggota}`
                    }).append($('<i>', { class: 'material-icons' }).append('edit'))
                    
                    td.append(deleteButton)
                    td.append(editButton)
                    tr.append(td)
                    $('tbody').append(tr)
                }
            }
        }

        const filter = () => {
            $.ajax({
                url: '<?php echo ROOT ?>app/controllers/anggota/filter.php',
                type: 'POST',
                data: {
                    orderby: $('#orderby').val(),
                    nama: $('#nama').val(),
                    jenisKelamin: $('#jenisKelamin').val(),
                    alamat: $('#alamat').val(),
                    tanggalLahir: $('#tanggalLahir').val(),
                    instansi: $('#instansi').val(),
                    tanggalBergabung: $('#tanggalBergabung').val()
                },
                success: (response) => {
                    anggota = JSON.parse(response)
                    inflateTable()
                    $('.hapus').click(evt => {
                        const target = $(evt.target)
                        const targetId = target.parents('td').attr('id')

                        if (confirm(`Apakah anda yakin ingin menghapus anggota dengan id ${targetId}`)) {
                            $.ajax({
                                url: `<?php echo ROOT ?>app/controllers/anggota/hapus.php?id=${targetId}`,
                                type: 'GET',
                                success: (response) => {
                                    alert("Berhasil menghapus anggota")
                                    target.parents('tr').remove()
                                }
                            })
                        }
                    })
                }
            })
        }

        $('#nama').keyup(() => {
            filter()
            if (!$('#titleLabel').hasClass('active')) {
                $('#titleLabel').addClass('active')
            }
            $('#name').val($('#nama').val())
        })
        $('#name').keyup(() => {
            if (!$('#namaLabel').hasClass('active')) {
                $('#namaLabel').addClass('active')
            }
            $('#nama').val($('#name').val())
            filter()
        })
        $('#jenisKelamin').change(() => filter())
        $('#alamat').keyup(() => filter())
        $('#tanggalLahir').keyup(() => filter())
        $('#instansi').keyup(() => filter())
        $('#tanggalBergabung').keyup(() => filter())

        $('#orderby').change(() => filter())

        $('.modal').modal()
        $('select').formSelect()

        $('.hapus').click(evt => {
            const target = $(evt.target)
            const targetId = target.parents('td').attr('id')

            if (confirm(`Apakah anda yakin ingin menghapus anggota dengan id ${targetId}`)) {
                $.ajax({
                    url: `<?php echo ROOT ?>app/controllers/anggota/hapus.php?id=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert("Berhasil menghapus anggota")
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>