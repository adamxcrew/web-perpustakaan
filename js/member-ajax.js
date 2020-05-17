$('.btn-detail-buku').on('click', function () {
    // console.log('OK');
    let id = $(this).data('id');
    // console.log(id);
    $.ajax({
        type: 'post',
        url: 'ambil-buku.php',
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