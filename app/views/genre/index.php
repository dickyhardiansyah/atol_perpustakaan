<?php include_once('../app/views/templates/header.php'); ?>

<br><br>

<main class="valign-wrapper">
    <div class="container">
        <div class='row valign-wrapper'>
            <div class='col s4'>
                <div class='input-field'>
                    <label for='genre' id="genreLabel">Cari Nama</label>
                    <input type='text' name='genre' id='genre'>
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
                        <option value='id_genre'>Id</option>
                        <option value='genre' selected>Nama</option>
                    </select>
                    <label for='orderby'>Sort By</label>
                </div>
            </div>
        </div>

        <table class="striped">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Nama</td>
                    <td>Aksi</td>
                </tr>
            </thead>

            <tbody>
                <?php if (sizeof($genre) === 0) { ?>
                    <tr>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                <?php } ?>
                <?php foreach ($genre as $item) { ?>
                    <tr>
                        <td><?php echo $item->idGenre; ?></td>
                        <td><?php echo $item->genre; ?></td>
                        <td id="<?php echo $item->idGenre ?>">
                            <button class="btn red accent-4 waves-effect waves-light hapus"><i class="material-icons">delete</i></button>
                            <a class="btn red accent-4 waves-effect waves-light edit" href="/perpustakaan/genre/ubah.php?id=<?php echo $item->idGenre ?>"><i class="material-icons">edit</i></a>
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
        let genre = JSON.parse('<?php echo json_encode($genre) ?>')
        
        const inflateTable = () => {
            $('tbody tr').remove()

            if (genre.length === 0) {
                const tr = $('<tr>')
                for (let i = 0; i < 3; i++) {
                    tr.append($('<td>').append('-'))
                }
                $('tbody').append(tr)
            } else {
                for (let item of genre) {
                    const tr = $('<tr>')
                    tr.append($('<td>').append(item.idGenre))
                    tr.append($('<td>').append(item.genre))

                    const td = $('<td>', { id: item.idGenre })

                    const deleteButton = $('<button>', {
                        class: 'btn red accent-4 waves-effect waves-light hapus'
                    }).append($('<i>', { class: 'material-icons' }).append('delete'))
                    
                    const editButton = $('<a>', {
                        class: 'btn red accent-4 waves-effect waves-light edit',
                        href: `/perpustakaan/genre/ubah.php?id=${item.idGenre}`
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
                url: '/perpustakaan/app/controllers/genre/filter.php',
                type: 'POST',
                data: {
                    orderby: $('#orderby').val(),
                    genre: $('#genre').val(),
                    id: $('#id').val()
                },
                success: (response) => {
                    genre = JSON.parse(response)
                    inflateTable()
                    $('.hapus').click(evt => {
                        const target = $(evt.target)
                        const targetId = target.parents('td').attr('id')

                        if (confirm(`Apakah anda yakin ingin menghapus genre dengan id ${targetId}`)) {
                            $.ajax({
                                url: `/perpustakaan/app/controllers/genre/hapus.php?id=${targetId}`,
                                type: 'GET',
                                success: (response) => {
                                    alert('Berhasil menghapus genre')
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
        $('#genre').keyup(() => {
            filter()
            if (!$('#nameLabel').hasClass('active')) {
                $('#nameLabel').addClass('active')
            }
            $('#name').val($('#genre').val())
        })
        $('#name').keyup(() => {
            if (!$('#genreLabel').hasClass('active')) {
                $('#genreLabel').addClass('active')
            }
            $('#genre').val($('#name').val())
            filter()
        })

        $('select').formSelect()
        $('.modal').modal()

        $('.hapus').click(evt => {
            const target = $(evt.target)
            const targetId = target.parents('td').attr('id')

            if (confirm(`Apakah anda yakin ingin menghapus genre dengan id ${targetId}`)) {
                $.ajax({
                    url: `/perpustakaan/app/controllers/genre/hapus.php?id=${targetId}`,
                    type: 'GET',
                    success: (response) => {
                        alert("Berhasil menghapus genre")
                        target.parents('tr').remove()
                    }
                })
            }
        })
    })
</script>