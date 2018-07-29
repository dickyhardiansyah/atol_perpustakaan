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
                        <option value='kode_penerbit'>Kode</option>
                        <option value='nama' selected>Nama</option>
                    </select>
                    <label for='orderby'>Sort By</label>
                </div>
            </div>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <td>Kode</td>
                    <td>Nama</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($penerbit) === 0) { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php } ?>
                <?php foreach ($penerbit as $item) { ?>
                    <tr>
                        <td><?php echo $item->kodePenerbit; ?></td>
                        <td><?php echo $item->nama; ?></td>
                        <td id="<?php echo $item->kodePenerbit ?>">
                            <button class="btn red accent-4 waves-effect waves-light hapus"><i class="material-icons">delete</i></button>
                            <a class="btn red accent-4 waves-effect waves-light edit" href="/perpustakaan/penerbit/ubah.php?id=<?php echo $item->kodePenerbit ?>"><i class="material-icons">edit</i></a>
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
            <label for='id'>Cari Id</label>
            <input type='text' name='id' id='id'>
        </div>

        <button class='btn red accent-4 waves-effect waves-light modal-close' id='tutup'>Tutup</button>
    </div>
    <br>
</div>

<br><br>

<?php include_once('../app/views/templates/footer.php'); ?>

<script>
    $(document).ready(() => {
        let penerbit = JSON.parse('<?php echo json_encode($penerbit) ?>')
        
        const inflateTable = () => {
            $('tbody tr').remove()

            if (penerbit.length === 0) {
                const tr = $('<tr>')
                for (let i = 0; i < 3; i++) {
                    tr.append($('<td>').append('-'))
                }
                $('tbody').append(tr)
            } else {
                for (let item of penerbit) {
                    const tr = $('<tr>')
                    tr.append($('<td>').append(item.kodePenerbit))
                    tr.append($('<td>').append(item.nama))

                    const td = $('<td>', { id: item.kodePenerbit })

                    const deleteButton = $('<button>', {
                        class: 'btn red accent-4 waves-effect waves-light hapus'
                    }).append($('<i>', { class: 'material-icons' }).append('delete'))
                    
                    const editButton = $('<a>', {
                        class: 'btn red accent-4 waves-effect waves-light edit',
                        href: `/perpustakaan/penerbit/ubah.php?id=${item.kodePenerbit}`
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
                url: '/perpustakaan/app/controllers/penerbit/filter.php',
                type: 'POST',
                data: {
                    orderby: $('#orderby').val(),
                    nama: $('#nama').val(),
                    id: $('#id').val()
                },
                success: (response) => {
                    penerbit = JSON.parse(response)
                    inflateTable()
                    $('.hapus').click(evt => {
                        const target = $(evt.target)
                        const targetId = target.parents('td').attr('id')

                        if (confirm(`Apakah anda yakin ingin menghapus penerbit dengan id ${targetId}`)) {
                            $.ajax({
                                url: `/perpustakaan/app/controllers/penerbit/hapus.php?id=${targetId}`,
                                type: 'GET',
                                success: (response) => {
                                    alert('Berhasil menghapus penerbit')
                                    target.parents('tr').remove()
                                }
                            })
                        }
                    })
                }
            })
        }

        $('#orderby').change(() => filter())
        $('#id').keyup(() => filter())
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

        $('select').formSelect()
        $('.modal').modal()

        $('.hapus').click(evt => {
            const target = $(evt.target)
            const targetId = target.parents('td').attr('id')

            if (confirm(`Apakah anda yakin ingin menghapus penerbit dengan id ${targetId}`)) {
                $.ajax({
                    url: `/perpustakaan/app/controllers/penerbit/hapus.php?id=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert("Berhasil menghapus penerbit")
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>