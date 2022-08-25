const base_url = $('meta[name="base_url"]').attr('content');
$(document).on('click', '.btn-detail-buku', function () {
    // console.log('OK');
    let id = $(this).data('id');
    // console.log(id);
    $.ajax({
        method: 'post',
        url: base_url + '/member/ambil-buku',
        data: {
            id: id
        },
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            $('#judul-buku').html(response.judul);
            $('#tahun-terbit').html(response.tahun_terbit);
            $('#penulis').html(response.penulis);
            $('#isbn').html(response.isbn);
        }
    });
});

$(document).on('click', '.btn-detail-pinjaman', function () {
    let id = $(this).data('id');
    $('#id-pinjaman').html(id);
    $.ajax({
        url: base_url + '/member/ambil-pinjaman',
        data: {
            id: id
        },
        method: 'post',
        dataType: 'json',
        success: function (data) {
            if (data[1].tanggal_kembali == null) {
                $('#tanggal-kembali').html('Belum Dikembalikan');
            } else {
                const options = {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                let date = new Date(data[1].tanggal_kembali);
                $('#tanggal-kembali').html(date.toLocaleString('id-ID', options));
            }
            if (data[1].denda == null) {
                $('#denda').html('-');
            } else {
                $('#denda').html(data[1].denda);
            }
            let buku = '';
            $.each(data[0], function (i, val) {
                buku +=
                    '<li>' + val.judul + '</li>'
            });
            $('#daftar-buku').html(buku);
        }
    });
});