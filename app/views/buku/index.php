<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <div class='row valign-wrapper'>
            <div class='col s4'>
                <div class='input-field'>
                    <label for='judul' id="judulLabel">Cari Judul</label>
                    <input type='text' name='judul' id='judul'>
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
                        <option value='kode_buku'>Kode</option>
                        <option value='judul' selected>Judul</option>
                        <option value='penulis'>Penulis</option>
                        <option value='tahun_terbit'>Tahun Terbit</option>
                        <option value='stok'>Stok</option>
                        <option value='nama'>Penerbit</option>
                        <option value='genre'>Genre</option>
                    </select>
                    <label for='orderby'>Sort By</label>
                </div>
            </div>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <td>Kode</td>
                    <td>Judul</td>
                    <td>Penulis</td>
                    <td>Tahun</td>
                    <td>Stok</td>
                    <td>Penerbit</td>
                    <td>Genre</td>
                    <?php if ($_SESSION['userJenis'] !== 'Transaksi') { ?>
                    <td>Aksi</td>
                    <?php } ?>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($buku) === 0) { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <?php if ($_SESSION['userJenis'] !== 'Transaksi') { ?>
                        <td>-</td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <?php foreach ($buku as $item) { ?>
                    <tr>
                        <td><?php echo $item->kodeBuku; ?></td>
                        <td><?php echo $item->judul; ?></td>
                        <td><?php echo $item->penulis; ?></td>
                        <td><?php echo $item->tahunTerbit; ?></td>
                        <td><?php echo $item->stok; ?></td>
                        <td><?php echo $item->penerbit; ?></td>
                        <td><?php echo $item->genre; ?></td>
                        <?php if ($_SESSION['userJenis'] !== 'Transaksi') { ?>
                        <td id="<?php echo $item->kodeBuku ?>">
                            <button class="btn red accent-4 waves-effect waves-light hapus"><i class="material-icons">delete</i></button>
                            <a class="btn red accent-4 waves-effect waves-light edit" href="/perpustakaan/buku/ubah.php?id=<?php echo $item->kodeBuku ?>"><i class="material-icons">edit</i></a>
                        </td>
                        <?php } ?>
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
            <label for='kode'>Cari Kode</label>
            <input type='text' name='kode' id='kode'>
        </div>

        <div class='input-field'>
            <label for='title' id="titleLabel">Cari Judul</label>
            <input type='text' name='title' id='title'>
        </div>

        <div class='input-field'>
            <label for='penulis'>Cari Penulis</label>
            <input type='text' name='penulis' id='penulis'>
        </div>

        <div class='input-field'>
            <label for='tahun'>Cari Tahun</label>
            <input type='number' name='tahun' id='tahun'>
        </div>

        <div class='input-field'>
            <label for='stok'>Cari Stok</label>
            <input type='number' name='stok' id='stok' min=0>
        </div>

        <div class='input-field'>
            <label for='penerbit'>Cari Penerbit</label>
            <input type='text' name='penerbit' id='penerbit'>
        </div>

        <div class='input-field'>
            <label for='genre'>Cari Genre</label>
            <input type='text' name='genre' id='genre'>
        </div>

        <button class='btn red accent-4 waves-effect waves-light modal-close' id='tutup'>Tutup</button>
    </div>
    <br>
</div>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        let buku = JSON.parse('<?php echo json_encode($buku) ?>')

        const inflateTable = () => {
            $('tbody tr').remove()

            if (buku.length === 0) {
                const tr = $('<tr>')
                for (let i = 0; i < 8; i++) {
                    tr.append($('<td>').append('-'))
                }
                $('tbody').append(tr)
            } else {
                for (let item of buku) {
                    const tr = $('<tr>')
                    tr.append($('<td>').append(item.kodeBuku))
                    tr.append($('<td>').append(item.judul))
                    tr.append($('<td>').append(item.penulis))
                    tr.append($('<td>').append(item.tahunTerbit))
                    tr.append($('<td>').append(item.stok))
                    tr.append($('<td>').append(item.penerbit))
                    tr.append($('<td>').append(item.genre))

                    <?php if ($_SESSION['userJenis'] !== 'Transaksi') { ?>
                    const td = $('<td>', { id: item.kodeBuku })

                    const deleteButton = $('<button>', {
                        class: 'btn red accent-4 waves-effect waves-light hapus'
                    }).append($('<i>', { class: 'material-icons' }).append('delete'))
                    
                    const editButton = $('<a>', {
                        class: 'btn red accent-4 waves-effect waves-light edit',
                        href: `/perpustakaan/buku/ubah.php?id=${item.kodeBuku}`
                    }).append($('<i>', { class: 'material-icons' }).append('edit'))
                    
                    td.append(deleteButton)
                    td.append(editButton)
                    tr.append(td)
                    <?php } ?>
                    $('tbody').append(tr)
                }
            }
        }

        const filter = () => {
            $.ajax({
                url: '/perpustakaan/app/controllers/buku/filter.php',
                type: 'POST',
                data: {
                    orderby: $('#orderby').val(),
                    kode: $('#kode').val(),
                    judul: $('#judul').val(),
                    penulis: $('#penulis').val(),
                    tahun: $('#tahun').val(),
                    stok: $('#stok').val(),
                    penulis: $('#penulis').val(),
                    genre: $('#genre').val(),
                    penerbit: $('#penerbit').val()
                },
                success: (response) => {
                    buku = JSON.parse(response)
                    inflateTable()
                    $('.hapus').click(evt => {
                        const target = $(evt.target)
                        const targetId = target.parents('td').attr('id')

                        if (confirm(`Apakah anda yakin ingin menghapus buku dengan kode ${targetId}`)) {
                            $.ajax({
                                url: `/perpustakaan/app/controllers/buku/hapus.php?kode=${targetId}`,
                                type: 'GET',
                                success: (response) => {
                                    alert("Berhasil menghapus buku")
                                    target.parents('tr').remove()
                                }
                            })
                        }
                    })
                }
            })
        }

        $('#kode').keyup(() => filter())
        $('#judul').keyup(() => {
            filter()
            if (!$('#titleLabel').hasClass('active')) {
                $('#titleLabel').addClass('active')
            }
            $('#title').val($('#judul').val())
        })
        $('#title').keyup(() => {
            if (!$('#judulLabel').hasClass('active')) {
                $('#judulLabel').addClass('active')
            }
            $('#judul').val($('#title').val())
            filter()
        })
        $('#penulis').keyup(() => filter())
        $('#tahun').keyup(() => filter())
        $('#stok').keyup(() => filter())
        $('#penulis').keyup(() => filter())
        $('#genre').keyup(() => filter())
        $('#penerbit').keyup(() => filter())

        $('#orderby').change(() => filter())

        $('.modal').modal()
        $('select').formSelect()

        $('.hapus').click(evt => {
            const target = $(evt.target)
            const targetId = target.parents('td').attr('id')

            if (confirm(`Apakah anda yakin ingin menghapus buku dengan kode ${targetId}`)) {
                $.ajax({
                    url: `/perpustakaan/app/controllers/buku/hapus.php?kode=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert("Berhasil menghapus buku")
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>