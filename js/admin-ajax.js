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
            } else {
                let tabel = '';
                let j = 1;
                $.each(data, function (i, val) {
                    console.log(val.judul);
                    console.log(val.row_id);
                    tabel +=
                        '<tr>' +
                        '<td>' + j++ + '</td>' +
                        '<td>' + val.judul + '</td>' +
                        '<td><a href="peminjaman.php?op=hapus&row_id=' + val.row_id + '" class="badge badge-danger btn-hapus">Hapus</a></td>' +
                        '</tr>'
                });
                $('#tabel-ajax').html(tabel);
                $('#id-member').prop('disabled', true);
            }
        },
    });
});