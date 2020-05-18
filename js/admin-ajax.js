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