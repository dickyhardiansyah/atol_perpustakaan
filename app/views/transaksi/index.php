<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <div class='row valign-wrapper'>
            <div class='col s4'>
                <div class='input-field'>
                    <label for='nama' id="namaLabel">Cari Peminjam</label>
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
                        <option value='id_peminjaman'>Id</option>
                        <option value='id_anggota'>Nama</option>
                        <option value='kode_buku'>Buku</option>
                        <option value='status' selected>Status</option>
                        <option value='tanggal_peminjaman'>Tanggal Peminjaman</option>
                        <option value='tanggal_pengembalian'>Tanggal Pengembalian</option>
                        <option value='tanggal_dikembalikan'>Tanggal Dikembalikan</option>
                    </select>
                    <label for='orderby'>Sort By</label>
                </div>
            </div>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Peminjam</td>
                    <td>Buku</td>
                    <td>Status</td>
                    <td>Dipinjam</td>
                    <td>Pengembalian</td>
                    <td>Dikembalikan</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($peminjaman) === 0) { ?>
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
                <?php foreach ($peminjaman as $item) { ?>
                    <tr>
                        <td><?php echo $item->idPeminjaman; ?></td>
                        <td><?php echo $item->peminjam; ?></td>
                        <td><?php echo $item->buku; ?></td>
                        <td><?php echo $item->status; ?></td>
                        <td><?php echo $item->tanggalPeminjaman; ?></td>
                        <td><?php echo $item->tanggalPengembalian; ?></td>
                        <td><?php echo $item->tanggalDikembalikan ? $item->tanggalDikembalikan : '-' ; ?></td>
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
            <label for='id'>Cari Id</label>
            <input type='text' name='id' id='id'>
        </div>

        <div class='input-field'>
            <label for='name' id="titleLabel">Cari Peminjam</label>
            <input type='text' name='name' id='name'>
        </div>

        <div class='input-field'>
            <select id='status' class='validate'>
                <option value=''>Semua</option>
                <option value='Dipinjam'>Dipinjam</option>
                <option value='Dikembalikan'>Dikembalikan</option>
            </select>
            <label for='status'>Cari Status</label>
        </div>

        <div class='input-field'>
            <label for='buku'>Cari Buku</label>
            <input type='text' name='buku' id='buku'>
        </div>

        <div class='input-field'>
            <label for='tanggalPeminjaman'>Cari Tanggal Peminjaman</label>
            <input type='text' name='tanggalPeminjaman' id='tanggalPeminjaman'>
        </div>

        <div class='input-field'>
            <label for='tanggalPengembalian'>Cari Tanggal Pengembalian</label>
            <input type='text' name='tanggalPengembalian' id='tanggalPengembalian'>
        </div>

        <div class='input-field'>
            <label for='tanggalDikembalikan'>Cari Tanggal Dikembalikan</label>
            <input type='text' name='tanggalDikembalikan' id='tanggalDikembalikan'>
        </div>

        <button class='btn red accent-4 waves-effect waves-light modal-close' id='tutup'>Tutup</button>
    </div>
    <br>
</div>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        let peminjaman = JSON.parse('<?php echo json_encode($peminjaman) ?>')

        const inflateTable = () => {
            $('tbody tr').remove()

            if (peminjaman.length === 0) {
                const tr = $('<tr>')
                for (let i = 0; i < 7; i++) {
                    tr.append($('<td>').append('-'))
                }
                $('tbody').append(tr)
            } else {
                for (let item of peminjaman) {
                    const tr = $('<tr>')
                    tr.append($('<td>').append(item.idPeminjaman))
                    tr.append($('<td>').append(item.peminjam))
                    tr.append($('<td>').append(item.buku))
                    tr.append($('<td>').append(item.status))
                    tr.append($('<td>').append(item.tanggalPeminjaman))
                    tr.append($('<td>').append(item.tanggalPengembalian))
                    tr.append($('<td>').append(item.tanggalDikembalikan))

                    const td = $('<td>', { id: item.idPeminjaman })

                    const deleteButton = $('<button>', {
                        class: 'btn red accent-4 waves-effect waves-light hapus'
                    }).append($('<i>', { class: 'material-icons' }).append('delete'))
                    
                    const editButton = $('<a>', {
                        class: 'btn red accent-4 waves-effect waves-light edit',
                        href: `/perpustakaan/peminjaman/ubah.php?id=${item.idPeminjaman}`
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
                url: '/perpustakaan/app/controllers/transaksi/filter.php',
                type: 'POST',
                data: {
                    orderby: $('#orderby').val(),
                    id: $('#id').val(),
                    nama: $('#nama').val(),
                    status: $('#status').val(),
                    buku: $('#buku').val(),
                    tanggalPeminjaman: $('#tanggalPeminjaman').val(),
                    tanggalPengembalian: $('#tanggalPengembalian').val(),
                    instansi: $('#instansi').val(),
                    tanggalDikembalikan: $('#tanggalDikembalikan').val()
                },
                success: (response) => {
                    peminjaman = JSON.parse(response)
                    inflateTable()
                    $('.hapus').click(evt => {
                        const target = $(evt.target)
                        const targetId = target.parents('td').attr('id')

                        if (confirm(`Apakah anda yakin ingin menghapus peminjaman dengan id ${targetId}`)) {
                            $.ajax({
                                url: `/perpustakaan/app/controllers/peminjaman/hapus.php?id=${targetId}`,
                                type: 'GET',
                                success: (response) => {
                                    alert("Berhasil menghapus peminjaman")
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
        $('#status').change(() => filter())
        $('#buku').keyup(() => filter())
        $('#tanggalDipinjam').keyup(() => filter())
        $('#instansi').keyup(() => filter())
        $('#tanggalDikembalikan').keyup(() => filter())
        $('#orderby').change(() => filter())

        $('.modal').modal()
        $('select').formSelect()
    })
</script>