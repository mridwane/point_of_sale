$(document).ready(function(){

    $('#cetak').click(function(e){
        var cek = $('#bulan').val();
        if (cek == 0)
        {
            e.preventDefault();
            Swal.fire(
                'Pilih Bulan',
                'Anda belum memilih bulan untuk menampilkan data yang akan di buat laporan.',
                'warning'
              )
        }
    });


});