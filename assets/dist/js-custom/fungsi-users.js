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
            "url": "Users/get_data_user",
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

    //get data for delete record
    $('#table').on('click','.delete_users',function(){
        var kd_user = $(this).data('kd_users');
         
        // $('#Modal_Delete').modal('show');
        // $('[name="product_code_delete"]').val(product_code);
        Swal.fire({
            title: 'Apa anda yakin?',
            text: "mengahapus data ini",
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
                    url  : "Users/delete",
                    dataType : "JSON",
                    data : {kd_user:kd_user},
                    success: function(data){
                        Swal.fire(
                            'Hapus!',
                            'Data berhasil dihapus.',
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