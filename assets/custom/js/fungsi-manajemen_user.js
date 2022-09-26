var table;
// const flashData = $('.flash-data').data('flashdata');
// // console.log(flashData);
// if(flashData == "is login")
// {
//     Swal.fire({
//         title: 'Gagal Hapus!',
//         text: 'Sepertinya user sedang login.',
//         icon: 'error'
//     })
// }
$(document).ready(function(){
    // list_data(); //call function show all product  

    table = $('#table').DataTable({ 
 
        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": "get_data_user",
            "type": "POST"
        },

         
        "columnDefs": [
        { 
            "targets": [ 0 ], 
            "orderable": false, 
        },
        ],
    });

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }

    // reset_password
    $('#table').on('click','.reset_user',function(){
        var kd_user = $(this).data('kd_user');
        var nama = $(this).data('nama');
        Swal.fire({
            title: 'Reset password '+nama+'?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Reset',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : "POST",
                    url  : "reset_password",
                    dataType : "JSON",
                    data : {kd_user:kd_user},
                    success: function(data){
                        Swal.fire(
                            'Reset Berhasil',
                            'Password Baru '+data,
                            'success'
                          )
                          reload_table();
                    }
                });
                return false;
              
            }
          })
    });
    //get data for delete record
    $('#table').on('click','.delete_user',function(){
        var kd_user = $(this).data('kd_user');
        var nama = $(this).data('nama');
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "mengahapus user "+nama ,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : "POST",
                    url  : "delete",
                    dataType : "JSON",
                    data : {kd_user:kd_user},
                    success: function(data){
                        Swal.fire(
                            'Hapus!',
                            'user '+nama+' berhasil dihapus.',
                            'success'
                          )
                          reload_table();
                    }
                });
                return false;
              
            }
          })
    });

    $('#table').on('click','.aktif',function(){
        var kd_user = $(this).data('kd_user');
        var nama = $(this).data('nama');
        var status = '1';
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "ingin Aktifkan akun "+nama+" ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0EF10E',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aktif',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : "POST",
                    url  : "update_status",
                    dataType : "JSON",
                    data : {kd_user:kd_user, status:status},
                    success: function(data){
                        Swal.fire(
                            'Berhasil!',
                            'user '+nama+' berhasil di Aktifkan.',
                            'success'
                          )
                          reload_table();
                    }
                });
                return false;
              
            }
          })
    });

    $('#table').on('click','.nonaktif',function(){
        var kd_user = $(this).data('kd_user');
        var nama = $(this).data('nama');
        var status = '0';
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "ingin nonaktifkan akun "+nama+" ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0EF10E',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Nonaktif',
            cancelButtonText: 'Batal'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type : "POST",
                    url  : "update_status",
                    dataType : "JSON",
                    data : {kd_user:kd_user, status:status},
                    success: function(data){
                        Swal.fire(
                            'Berhasil!',
                            'user '+nama+' berhasil di non aktifkan.',
                            'success'
                          )
                          reload_table();
                    }
                });
                return false;
              
            }
          })
    });
});