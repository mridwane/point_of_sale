var table;
$(document).ready(function(){
    // list_data(); //call function show all product  

    table = $('#table').DataTable({ 
 
        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": "Kategori/get_data_user",
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

    // validasi form
    $("#nama").keyup(function(){
        var validasiHuruf = /^[a-zA-Z0-9 ]+$/;
        var nama = $('#nama').val();
        if(nama == 0)
        {
            $('#nama').removeClass('is-valid');
            $('#nama').addClass('is-invalid');

            $('#hintnama').removeClass('text-muted');
            $('#hintnama').removeClass('text-success');
            $('#hintnama').addClass('text-danger');

            $('#hintnama').text("nama kategori tidak boleh kosong");
        } 
               
        else
        {
            if(nama.match(validasiHuruf))
            {
                $.ajax({
                    type: "POST",
                    url: "Kategori/cek_nama",
                    data: $(this).serialize(),
                    success: function (data){
                        // console.log(data);
                        if(data=="nama ada")
                        {
                            $('#nama').removeClass('is-valid');
                            $('#nama').addClass('is-invalid');

                            $('#hintnama').removeClass('text-muted');
                            $('#hintnama').removeClass('text-success');
                            $('#hintnama').addClass('text-danger');

                            $('#hintnama').text("nama '"+nama+"' sudah digunakan"); 
                        } 
                        else 
                        {
                            $('#nama').removeClass('is-invalid');
                            $('#nama').removeClass('is-valid');
    
                            $('#hintnama').removeClass('text-success');
                            $('#hintnama').removeClass('text-danger');
                            $('#hintnama').addClass('text-muted');
    
                            $('#hintnama').text("*max 20 karakter.");  
                        }
                    }
                 });
            } 
            else
            {
                $('#nama').removeClass('is-valid');
                $('#nama').addClass('is-invalid');

                $('#hintnama').removeClass('text-muted');
                $('#hintnama').removeClass('text-success');
                $('#hintnama').addClass('text-danger');
        
                $('#hintnama').text("*tidak boleh mengandung karakter simbol."); 
            }           
        }
    });
    //Save data
    $('#btn_save').on('click',function(){
        var nama = $('#nama').val();
        var validasi = /^[a-zA-Z0-9 ]*$/;
        var namahasClass = $("#nama").hasClass("is-invalid");
        if(nama == 0)
        {
            $('#nama').addClass('is-invalid');

            $('#hintnama').removeClass('text-muted');
            $('#hintnama').addClass('text-danger');

            $('#hintnama').text("nama kategori tidak boleh kosong");
        }    
        else if(namahasClass)
        {
            e.preventDefault();
        }
        else
        {
            if(nama.match(validasi))
            {
                $.ajax({
                    type : "POST",
                    url  : "Kategori/add",
                    dataType : "JSON",
                    data : {nama:nama},
                    success: function(data){
                        Swal.fire(
                            'Simpan!',
                            'Data berhasil disimpan.',
                            'success'
                          )
                        $('[name="nama"]').val("");
                        $('#tambah-data').modal('hide');
                        reload_table();
                        
                    }
                });
                return false;
            } 
            else
            {
                $('#nama').removeClass('is-valid');
                $('#nama').addClass('is-invalid');

                $('#hintnama').removeClass('text-muted');
                $('#hintnama').removeClass('text-success');
                $('#hintnama').addClass('text-danger');
        
                $('#hintnama').text("*tidak boleh mengandung karakter simbol."); 
            } 
        }        
    });

    //get data for delete record
    $('#table').on('click','.delete_kategori',function(){
        var kd_kategori = $(this).data('kd_kategori');
         
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
                    url  : "Kategori/delete",
                    dataType : "JSON",
                    data : {kd_kategori:kd_kategori},
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