$('#tambah-peminjaman').on('click', function () {
    let idmember = $('#id-member').val();
    let buku = $('#buku').val();
    let waktu = $('#lama-pinjam').val();
    $.ajax({
        url: 'peminjaman.php?op=tambah',
        data: {
            idmember: idmember,
            buku: buku,
            waktu: waktu
        },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == 'exist') {
                alert('Buku ini sudah masuk ke sesi peminjaman');
            } else if (data == 'x') {
                alert('Buku ini sudah dipinjam dan belum dikembalikan, harap dikembalikan dulu');
            } else {
                let tabel = '';
                let j = 1;
                $.each(data, function (i, val) {
                    tabel +=
                        '<tr>' +
                        '<td>' + j++ + '</td>' +
                        '<td>' + val.judul + '</td>' +
                        '<td><a href="peminjaman.php?op=hapus&row_id=' + val.row_id + '" class="badge badge-danger btn-hapus">Hapus</a></td>' +
                        '</tr>'
                });
                $('#tabel-ajax').html(tabel);
                $('#id-member').prop('disabled', true);
                $('#lama-pinjam').prop('disabled', true);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    });
});

$('#cek-member').on('click', function () {
    let idmember = $('#id-member').val();
    $.ajax({
        url: 'peminjaman.php?op=cekmember',
        data: {
            idmember: idmember
        },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == 'tidak ditemukan') {
                $('#ada').html('Member tidak ditemukan!');
                $('#nama-member').html('');
            } else {
                $('#ada').html('Member ditemukan!');
                $('#nama-member').html(data.nama);
            }
        }
    });
});

$('#simpan-pinjaman').on('click', function () {
    $.ajax({
        url: 'peminjaman.php?op=simpan',
        method: 'post',
        dataType: 'json',
        success: function (data) {
            if (data == 'no_session') {
                alert('Silahkan buat sesi peminjaman terlebih dahulu!');
            } else {
                alert('Peminjaman baru berhasil disimpan');
                location.reload();
            }
        }
    });
});

$('.btn-detail-pinjaman').on('click', function () {
    let id = $(this).data('id');
    if ($(this).data('kembali') == true) {
        $('#selesaikan-pinjaman').hide();
    } else {
        $('#selesaikan-pinjaman').data('id', id);
        $('#selesaikan-pinjaman').show();
    }
    $('#id-pinjaman').html(id);
    $.ajax({
        url: 'peminjaman.php?op=detail',
        data: {
            id: id
        },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            $('#nama-member').html(data[1].nama);
            $('#lama-pinjam').html(data[1].lama_pinjam + ' hari');
            let buku = '';
            $.each(data[0], function (i, val) {
                buku +=
                    '<li>' + val.judul + '</li>'
            });
            $('#daftar-buku').html(buku);
        }
    });
});

$('#selesaikan-pinjaman').on('click', function () {
    let id = $(this).data('id');
    if (confirm('Apakah anda yakin ingin menyelesaikan pinjaman ini?')) {
        $.ajax({
            url: 'peminjaman.php?op=selesai',
            data: {
                id: id
            },
            method: 'post',
            dataType: 'json',
            success: function (data) {
                if (data == 'tidak denda') {
                    alert('Pinjaman berhasil diselesaikan, tidak ada denda');
                    location.reload();
                } else {
                    alert('Pinjaman berhasil diselesaikan, denda Rp ' + data)
                    location.reload();
                }
            }
        });
    }
});