
$(document).ready(function(){
    tampil_req();
    $('#table').dataTable( {
        "language": {
          "emptyTable": "Tidak Ada Permintaan Registrasi."
        }
    } );
    function tampil_req(){
        $.ajax({
            type  : 'ajax',
            url   : 'tampil_req',
            async : false,
            dataType : 'json',
            success : function(data){
                var html = '';
                var i;
                var no = 1;
                for(i=0; i<data.length; i++){
                    html += '<tr>'+
                            '<td>'+no+++'</td>'+
                            '<td>'+data[i].nama_user+'</td>'+
                            '<td>'+data[i].username+'</td>'+
                            '<td>'+data[i].nama_akses+'</td>'+
                            '<td><button class="btn waves-effect waves-light btn-rounded btn-outline-success konfirmasi" id="konf" data="'+data[i].kd_user+'">Konfirmasi</button></td>'+
                            '</tr>';
                }
                $('#show_data').html(html);
            }

        });
    }

    $('#show_data').on('click','.konfirmasi',function(){
        var kd_user=$(this).attr('data');
        // $('[name="kd_user"]').val(kd_user);
        $.ajax({
            type : "POST",
            url  : "konfirmasi",
            dataType : "JSON",
            data : {kd_user: kd_user},
            success: function(data){
                tampil_req();
                Swal.fire(
                    'Berhasil',
                    'Berhasil dikonfirmasi',
                    'success'
                )
            }
        });
    });



});