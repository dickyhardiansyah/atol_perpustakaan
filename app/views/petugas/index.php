<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class='valign-wrapper'>
    <div class='container'>
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
                        <option value='nama'>Nama</option>
                        <option value='jenis'>Jenis</option>
                        <option value='username'>Username</option>
                    </select>
                    <label for='orderby'>Sort By</label>
                </div>
            </div>
        </div>
        
        <table class='striped'>
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nama</td>
                    <td>Jenis</td>
                    <td>Username</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($petugas) === 0) { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php } ?>
                <?php foreach ($petugas as $item) { ?>
                    <tr>
                        <td><?php echo $item->idPetugas; ?></td>
                        <td><?php echo $item->nama; ?></td>
                        <td><?php echo $item->jenis; ?></td>
                        <td><?php echo $item->username; ?></td>
                        <td id='<?php echo $item->idPetugas ?>'>
                            <button class='btn red accent-4 waves-effect waves-light hapus'><i class='material-icons'>delete</i></button>
                            <a class='btn red accent-4 waves-effect waves-light edit' href='/perpustakaan/petugas/ubah.php?id=<?php echo $item->idPetugas ?>'><i class='material-icons'>edit</i></a>
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
            <label for='name' id="nameLabel">Cari Nama</label>
            <input type='text' name='name' id='name'>
        </div>

        <div class='input-field'>
            <select id='jenis' class='validate'>
                <option value=''>Semua</option>
                <option value='Admin'>Admin</option>
                <option value='Buku'>Buku</option>
                <option value='Transaksi'>Transaksi</option>
            </select>
            <label for='jenis'>Jenis</label>
        </div>

        <div class='input-field'>
            <label for='username'>Cari Username</label>
            <input type='text' name='username' id='username'>
        </div>

        <button class='btn red accent-4 waves-effect waves-light modal-close' id='tutup'>Tutup</button>
    </div>
    <br>
</div>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        let petugas = JSON.parse('<?php echo json_encode($petugas) ?>')

        const inflateTable = () => {
            $('tbody tr').remove()

            if (petugas.length === 0) {
                const tr = $('<tr>')
                for (let i = 0; i < 5; i++) {
                    tr.append($('<td>').append('-'))
                }
                $('tbody').append(tr)
            } else {
                for (let item of petugas) {
                    const tr = $('<tr>')
                    tr.append($('<td>').append(item.idPetugas))
                    tr.append($('<td>').append(item.nama))
                    tr.append($('<td>').append(item.jenis))
                    tr.append($('<td>').append(item.username))

                    const td = $('<td>', { id: item.idPetugas })

                    const deleteButton = $('<button>', {
                        class: 'btn red accent-4 waves-effect waves-light hapus'
                    }).append($('<i>', { class: 'material-icons' }).append('delete'))
                    
                    const editButton = $('<a>', {
                        class: 'btn red accent-4 waves-effect waves-light edit',
                        href: `/perpustakaan/petugas/ubah.php?id=${item.idPetugas}`
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
                url: '/perpustakaan/app/controllers/petugas/filter.php',
                type: 'POST',
                data: {
                    orderby: $('#orderby').val(),
                    nama: $('#nama').val(),
                    jenis: $('#jenis').val(),
                    username: $('#username').val()
                },
                success: (response) => {
                    petugas = JSON.parse(response)
                    inflateTable()
                    $('.hapus').click(evt => {
                        const target = $(evt.target)
                        const targetId = target.parents('td').attr('id')

                        if (confirm(`Apakah anda yakin ingin menghapus petugas dengan id ${targetId}`)) {
                            $.ajax({
                                url: `/perpustakaan/app/controllers/petugas/hapus.php?id=${targetId}`,
                                type: 'GET',
                                success: (response) => {
                                    alert('Berhasil menghapus petugas')
                                    target.parents('tr').remove()
                                }
                            })
                        }
                    })
                }
            })
        }

        $('#orderby').change(() => filter())
        $('#nama').keyup(() => {
            filter()
            if (!$('#nameLabel').hasClass('active')) {
                $('#nameLabel').addClass('active')
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
        $('#jenis').change(() => filter())
        $('#username').keyup(() => filter())

        $('select').formSelect()
        $('.modal').modal()

        $('.hapus').click(evt => {
            const target = $(evt.target)
            const targetId = target.parents('td').attr('id')

            if (confirm(`Apakah anda yakin ingin menghapus petugas dengan id ${targetId}`)) {
                $.ajax({
                    url: `/perpustakaan/app/controllers/petugas/hapus.php?id=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert('Berhasil menghapus petugas')
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>