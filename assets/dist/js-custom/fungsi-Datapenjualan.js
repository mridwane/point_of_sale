$(document).ready(function(){

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        immediateUpdates: true,
        todayBtn: true,
        todayHighlight: true
    }).datepicker("setDate",'now');

      //pemanggilan fungsi tampil barang.
         
    $('#tablePenjualan').dataTable({
        searching: false,
        info: false,
        paging: false,
        "language": {
            "emptyTable": "Tidak Ada Data"}
    });

    $('#tampil').click(function(){
        var tanggal=$('#tanggal').val();
        $('#tablePenjualan').dataTable().fnClearTable(); // untuk menghilangkan data ditable
        console.log(tanggal)
        $.ajax({
            type: "POST",
            url: "DataPenjualan/cek_transaksi",
            data: {tanggal: tanggal},
            success: function (data){
                // console.log(data);
                if(data=="ada")
                {
                    $.ajax({
                        ajax: '/data-source',
                        method: "POST",
                        url   : 'DataPenjualan/data_penjualan',
                        data: {tanggal: tanggal},
                        async : false,
                        dataType : 'json',
                        success : function(data)
                        {
                            var html = '';
                            var no = 1;
                            var i;
                            for(i=0; i<data.length; i++){
                                html += '<tr>'+
                                        '<td>'+no+++'</td>'+
                                        '<td>'+data[i].cname+'</td>'+
                                        '<td>'+data[i].qty+'</td>'+
                                        '</tr>';
                                        
                                $('#show_data').html(html);
                            }
                        }
                    });
                } 
                else 
                {
                    Swal.fire(
                        'Kosong',
                        'Tidak Ada Transaksi di Tanggal Ini',
                        'info'
                      )
                }
            }
         });
    });


});