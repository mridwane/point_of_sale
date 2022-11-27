var table;
$(document).ready(function(){
    // list_data(); //call function show all product  
    $('#harga_beli').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});
    $('#harga_jual').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});

    $('#table_harga_beli').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});
    $('#table_harga_jual').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});

    $('#harga_beliEdit').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});
    $('#harga_jualEdit').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});

     $('#tambah-data').on('shown.bs.modal', function () {
        $('#kd_barang').focus();
    })  

    table = $('#table').DataTable({ 
 
        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": "barang/get_data_user",
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
    $("#kd_barang").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[a-zA-Z0-9 ]+$/;
        var kd_barang = $('#kd_barang').val();
        if(kd_barang == 0)
        {
            $('#kd_barang').removeClass('is-valid');
            $('#kd_barang').addClass('is-invalid');

            $('#hintkd_barang').removeClass('text-muted');
            $('#hintkd_barang').removeClass('text-success');
            $('#hintkd_barang').addClass('text-danger');

            $('#hintkd_barang').text("kode barang tidak boleh kosong");
        } 
               
        else
        {
            if(kd_barang.match(validasiHuruf))
            {
                $.ajax({
                    type: "POST",
                    url: "barang/cek_kd_barang",
                    data: $(this).serialize(),
                    success: function (data){
                        // console.log(data);
                        if(data=="kd_barang ada")
                        {
                            $('#kd_barang').removeClass('is-valid');
                            $('#kd_barang').addClass('is-invalid');

                            $('#hintkd_barang').removeClass('text-muted');
                            $('#hintkd_barang').removeClass('text-success');
                            $('#hintkd_barang').addClass('text-danger');

                            $('#hintkd_barang').text("kode barang '"+kd_barang+"' sudah digunakan"); 
                        } 
                        else 
                        {
                            $('#kd_barang').removeClass('is-invalid');
                            $('#kd_barang').addClass('is-valid');
    
                            $('#hintkd_barang').removeClass('text-muted');
                            $('#hintkd_barang').removeClass('text-danger');
                            $('#hintkd_barang').addClass('text-success');
    
                            $('#hintkd_barang').text("*kode barang sudah diisi.");  
                            // $("#nama").focus();
                        }
                    }
                 });
            } 
            else
            {
                $('#kd_barang').removeClass('is-valid');
                $('#kd_barang').addClass('is-invalid');

                $('#hintkd_barang').removeClass('text-muted');
                $('#hintkd_barang').removeClass('text-success');
                $('#hintkd_barang').addClass('text-danger');
        
                $('#hintkd_barang').text("*tidak boleh mengandung karakter simbol."); 
            }           
        }
    });

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

            $('#hintnama').text("nama barang tidak boleh kosong");
        } 
               
        else
        {
            if(nama.match(validasiHuruf))
            {
                $.ajax({
                    type: "POST",
                    url: "barang/cek_nama",
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
                            $('#nama').addClass('is-valid');
    
                            $('#hintnama').removeClass('text-muted');
                            $('#hintnama').removeClass('text-danger');
                            $('#hintnama').addClass('text-success');
    
                            $('#hintnama').text("*nama barang sudah diisi.");  
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

    $("#kategori").click(function(){
        var kategori = $('#kategori').val();
        if(kategori == "Pilih Kategori")
        {
            $('#kategori').removeClass('is-valid');
            $('#kategori').addClass('is-invalid');

            $('#hintkategori').removeClass('text-muted');
            $('#hintkategori').removeClass('text-success');
            $('#hintkategori').addClass('text-danger');

            $('#hintkategori').text("kategori belum dipilih");
        } 
               
        else
        {
            $('#kategori').addClass('is-valid');
            $('#kategori').removeClass('is-invalid');

            $('#hintkategori').removeClass('text-muted');
            $('#hintkategori').removeClass('text-danger');
            $('#hintkategori').addClass('text-success');

            $('#hintkategori').text("kategori sudah dipilih");        
        }
    });

    $("#harga_beli").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[a-zA-Z0-9. ]+$/;
        var harga_beli = $('#harga_beli').val();
        if(harga_beli == 0)
        {
            $('#harga_beli').removeClass('is-valid');
            $('#harga_beli').addClass('is-invalid');

            $('#hintharga_beli').removeClass('text-muted');
            $('#hintharga_beli').removeClass('text-success');
            $('#hintharga_beli').addClass('text-danger');

            $('#hintharga_beli').text("harga beli tidak boleh kosong");
        } 
               
        else
        {
            if(harga_beli.match(validasiHuruf))
            {
                $('#harga_beli').removeClass('is-invalid');
                $('#harga_beli').addClass('is-valid');

                $('#hintharga_beli').removeClass('text-muted');
                $('#hintharga_beli').removeClass('text-danger');
                $('#hintharga_beli').addClass('text-success');

                $('#hintharga_beli').text("*harga beli sudah diisi.");  
            } 
            else
            {
                $('#harga_beli').removeClass('is-valid');
                $('#harga_beli').addClass('is-invalid');

                $('#hintharga_beli').removeClass('text-muted');
                $('#hintharga_beli').removeClass('text-success');
                $('#hintharga_beli').addClass('text-danger');
        
                $('#hintharga_beli').text("*tidak boleh mengandung karakter simbol."); 
            }           
        }
    });

    $("#harga_jual").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[a-zA-Z0-9. ]+$/;
        var harga_jual = $('#harga_jual').val();
        if(harga_jual == 0)
        {
            $('#harga_jual').removeClass('is-valid');
            $('#harga_jual').addClass('is-invalid');

            $('#hintharga_jual').removeClass('text-muted');
            $('#hintharga_jual').removeClass('text-success');
            $('#hintharga_jual').addClass('text-danger');

            $('#hintharga_jual').text("harga jual tidak boleh kosong");
        } 
               
        else
        {
            if(harga_jual.match(validasiHuruf))
            {
                $('#harga_jual').removeClass('is-invalid');
                $('#harga_jual').addClass('is-valid');

                $('#hintharga_jual').removeClass('text-muted');
                $('#hintharga_jual').removeClass('text-danger');
                $('#hintharga_jual').addClass('text-success');

                $('#hintharga_jual').text("*harga jual sudah diisi.");  
            } 
            else
            {
                $('#harga_jual').removeClass('is-valid');
                $('#harga_jual').addClass('is-invalid');

                $('#hintharga_jual').removeClass('text-muted');
                $('#hintharga_jual').removeClass('text-success');
                $('#hintharga_jual').addClass('text-danger');
        
                $('#hintharga_jual').text("*tidak boleh mengandung karakter simbol."); 
            }           
        }
    });

    $("#diskon").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[0-9]+$/;
        var diskon = $('#diskon').val();
        if(diskon == 0)
        {
            $('#diskon').removeClass('is-invalid');
            $('#diskon').removeClass('is-valid');

            $('#hintdiskon').removeClass('text-success');
            $('#hintdiskon').removeClass('text-danger');
            $('#hintdiskon').addClass('text-muted'); 
        }
        else
        {
            if(diskon.match(validasiHuruf))
            {
                $('#diskon').removeClass('is-invalid');
                $('#diskon').addClass('is-valid');

                $('#hintdiskon').removeClass('text-muted');
                $('#hintdiskon').removeClass('text-danger');
                $('#hintdiskon').addClass('text-success');

                $('#hintdiskon').text("*diskon sudah diisi.");  
            } 
            else
            {
                $('#diskon').removeClass('is-valid');
                $('#diskon').addClass('is-invalid');

                $('#hintdiskon').removeClass('text-muted');
                $('#hintdiskon').removeClass('text-success');
                $('#hintdiskon').addClass('text-danger');
        
                $('#hintdiskon').text("*hanya diperbolehkan angka."); 
            } 
        }
    });

    $("#stok").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[0-9]+$/;
        var stok = $('#stok').val();
        if(stok == 0)
        {
            $('#stok').removeClass('is-valid');
            $('#stok').addClass('is-invalid');

            $('#hintstok').removeClass('text-muted');
            $('#hintstok').removeClass('text-success');
            $('#hintstok').addClass('text-danger');

            $('#hintstok').text("stok tidak boleh kosong");
        } 
               
        else
        {
            if(stok.match(validasiHuruf))
            {
                $('#stok').removeClass('is-invalid');
                $('#stok').addClass('is-valid');

                $('#hintstok').removeClass('text-muted');
                $('#hintstok').removeClass('text-danger');
                $('#hintstok').addClass('text-success');

                $('#hintstok').text("*stok sudah diisi.");  
            } 
            else
            {
                $('#stok').removeClass('is-valid');
                $('#stok').addClass('is-invalid');

                $('#hintstok').removeClass('text-muted');
                $('#hintstok').removeClass('text-success');
                $('#hintstok').addClass('text-danger');
        
                $('#hintstok').text("*hanya diperbolehkan angka."); 
            }           
        }
    });

    // validasi edit
    $("#kd_barangEdit").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[a-zA-Z0-9 ]+$/;
        var kd_barangEdit = $('#kd_barangEdit').val();
        if(kd_barangEdit == 0)
        {
            $('#kd_barangEdit').removeClass('is-valid');
            $('#kd_barangEdit').addClass('is-invalid');

            $('#hintkd_barangEdit').removeClass('text-muted');
            $('#hintkd_barangEdit').removeClass('text-success');
            $('#hintkd_barangEdit').addClass('text-danger');

            $('#hintkd_barangEdit').text("kode barang tidak boleh kosong");
        } 
               
        else
        {
            if(kd_barangEdit.match(validasiHuruf))
            {
                $.ajax({
                    type: "POST",
                    url: "barang/cek_kd_barang",
                    data: $(this).serialize(),
                    success: function (data){
                        // console.log(data);
                        if(data=="kd_barang ada")
                        {
                            $('#kd_barangEdit').removeClass('is-valid');
                            $('#kd_barangEdit').addClass('is-invalid');

                            $('#hintkd_barangEdit').removeClass('text-muted');
                            $('#hintkd_barangEdit').removeClass('text-success');
                            $('#hintkd_barangEdit').addClass('text-danger');

                            $('#hintkd_barangEdit').text("kode barang '"+kd_barangEdit+"' sudah digunakan"); 
                        } 
                        else 
                        {
                            $('#kd_barangEdit').removeClass('is-invalid');
                            $('#kd_barangEdit').addClass('is-valid');
    
                            $('#hintkd_barangEdit').removeClass('text-muted');
                            $('#hintkd_barangEdit').removeClass('text-danger');
                            $('#hintkd_barangEdit').addClass('text-success');
    
                            $('#hintkd_barangEdit').text("*kode barang sudah diisi.");  
                        }
                    }
                 });
            } 
            else
            {
                $('#kd_barangEdit').removeClass('is-valid');
                $('#kd_barangEdit').addClass('is-invalid');

                $('#hintkd_barangEdit').removeClass('text-muted');
                $('#hintkd_barangEdit').removeClass('text-success');
                $('#hintkd_barangEdit').addClass('text-danger');
        
                $('#hintkd_barangEdit').text("*tidak boleh mengandung karakter simbol."); 
            }           
        }
    });

    $("#namaEdit").keyup(function(){
        var validasiHuruf = /^[a-zA-Z0-9 ]+$/;
        var namaEdit = $('#namaEdit').val();
        if(namaEdit == 0)
        {
            $('#namaEdit').removeClass('is-valid');
            $('#namaEdit').addClass('is-invalid');

            $('#hintnamaEdit').removeClass('text-muted');
            $('#hintnamaEdit').removeClass('text-success');
            $('#hintnamaEdit').addClass('text-danger');

            $('#hintnamaEdit').text("nama barang tidak boleh kosong");
        } 
               
        else
        {
            if(namaEdit.match(validasiHuruf))
            {
                $.ajax({
                    type: "POST",
                    url: "barang/cek_nama",
                    data: $(this).serialize(),
                    success: function (data){
                        // console.log(data);
                        if(data=="nama ada")
                        {
                            $('#namaEdit').removeClass('is-valid');
                            $('#namaEdit').addClass('is-invalid');

                            $('#hintnamaEdit').removeClass('text-muted');
                            $('#hintnamaEdit').removeClass('text-success');
                            $('#hintnamaEdit').addClass('text-danger');

                            $('#hintnamaEdit').text("namaEdit '"+namaEdit+"' sudah digunakan"); 
                        } 
                        else 
                        {
                            $('#namaEdit').removeClass('is-invalid');
                            $('#namaEdit').addClass('is-valid');
    
                            $('#hintnamaEdit').removeClass('text-muted');
                            $('#hintnamaEdit').removeClass('text-danger');
                            $('#hintnamaEdit').addClass('text-success');
    
                            $('#hintnamaEdit').text("*nama barang sudah diisi.");  
                        }
                    }
                 });
            } 
            else
            {
                $('#namaEdit').removeClass('is-valid');
                $('#namaEdit').addClass('is-invalid');

                $('#hintnamaEdit').removeClass('text-muted');
                $('#hintnamaEdit').removeClass('text-success');
                $('#hintnamaEdit').addClass('text-danger');
        
                $('#hintnamaEdit').text("*tidak boleh mengandung karakter simbol."); 
            }           
        }
    });

    $("#kategoriEdit").click(function(){
        
        var kategoriEdit = $('#kategoriEdit').val();
        if(kategoriEdit == "Pilih kategoriEdit")
        {
            $('#kategoriEdit').removeClass('is-valid');
            $('#kategoriEdit').addClass('is-invalid');

            $('#hintkategoriEdit').removeClass('text-muted');
            $('#hintkategoriEdit').removeClass('text-success');
            $('#hintkategoriEdit').addClass('text-danger');

            $('#hintkategoriEdit').text("kategori belum dipilih");
        } 
               
        else
        {
            $('#kategoriEdit').addClass('is-valid');
            $('#kategoriEdit').removeClass('is-invalid');

            $('#hintkategoriEdit').removeClass('text-muted');
            $('#hintkategoriEdit').removeClass('text-danger');
            $('#hintkategoriEdit').addClass('text-success');

            $('#hintkategoriEdit').text("kategori sudah dipilih");        
        }
    });

    $("#harga_beliEdit").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[a-zA-Z0-9. ]+$/;
        var harga_beliEdit = $('#harga_beliEdit').val();
        if(harga_beliEdit == 0)
        {
            $('#harga_beliEdit').removeClass('is-valid');
            $('#harga_beliEdit').addClass('is-invalid');

            $('#hintharga_beliEdit').removeClass('text-muted');
            $('#hintharga_beliEdit').removeClass('text-success');
            $('#hintharga_beliEdit').addClass('text-danger');

            $('#hintharga_beliEdit').text("harga beli tidak boleh kosong");
        } 
               
        else
        {
            if(harga_beliEdit.match(validasiHuruf))
            {
                $('#harga_beliEdit').removeClass('is-invalid');
                $('#harga_beliEdit').addClass('is-valid');

                $('#hintharga_beliEdit').removeClass('text-muted');
                $('#hintharga_beliEdit').removeClass('text-danger');
                $('#hintharga_beliEdit').addClass('text-success');

                $('#hintharga_beliEdit').text("*harga beli sudah diisi.");  
            } 
            else
            {
                $('#harga_beliEdit').removeClass('is-valid');
                $('#harga_beliEdit').addClass('is-invalid');

                $('#hintharga_beliEdit').removeClass('text-muted');
                $('#hintharga_beliEdit').removeClass('text-success');
                $('#hintharga_beliEdit').addClass('text-danger');
        
                $('#hintharga_beliEdit').text("*tidak boleh mengandung karakter simbol."); 
            }           
        }
    });

    $("#harga_jualEdit").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[a-zA-Z0-9. ]+$/;
        var harga_jualEdit = $('#harga_jualEdit').val();
        if(harga_jualEdit == 0)
        {
            $('#harga_jualEdit').removeClass('is-valid');
            $('#harga_jualEdit').addClass('is-invalid');

            $('#hintharga_jualEdit').removeClass('text-muted');
            $('#hintharga_jualEdit').removeClass('text-success');
            $('#hintharga_jualEdit').addClass('text-danger');

            $('#hintharga_jualEdit').text("harga jual tidak boleh kosong");
        } 
               
        else
        {
            if(harga_jualEdit.match(validasiHuruf))
            {
                $('#harga_jualEdit').removeClass('is-invalid');
                $('#harga_jualEdit').addClass('is-valid');

                $('#hintharga_jualEdit').removeClass('text-muted');
                $('#hintharga_jualEdit').removeClass('text-danger');
                $('#hintharga_jualEdit').addClass('text-success');

                $('#hintharga_jualEdit').text("*harga jual sudah diisi.");  
            } 
            else
            {
                $('#harga_jualEdit').removeClass('is-valid');
                $('#harga_jualEdit').addClass('is-invalid');

                $('#hintharga_jualEdit').removeClass('text-muted');
                $('#hintharga_jualEdit').removeClass('text-success');
                $('#hintharga_jualEdit').addClass('text-danger');
        
                $('#hintharga_jualEdit').text("*tidak boleh mengandung karakter simbol."); 
            }           
        }
    });

    $("#diskonEdit").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[0-9]+$/;
        var diskonEdit = $('#diskonEdit').val();
               
        if(diskonEdit == 0)
        {
            $('#diskonEdit').removeClass('is-invalid');
            $('#diskonEdit').addClass('is-valid');

            $('#hintdiskonEdit').removeClass('text-muted');
            $('#hintdiskonEdit').removeClass('text-danger');
            $('#hintdiskonEdit').addClass('text-success');

            $('#hintdiskonEdit').text("*diskon otomatis 0%"); 
        }
        else
        {
            if(diskonEdit.match(validasiHuruf))
            {
                $('#diskonEdit').removeClass('is-invalid');
                $('#diskonEdit').addClass('is-valid');

                $('#hintdiskonEdit').removeClass('text-muted');
                $('#hintdiskonEdit').removeClass('text-danger');
                $('#hintdiskonEdit').addClass('text-success');

                $('#hintdiskonEdit').text("*diskon sudah diisi.");  
            } 
            else
            {
                $('#diskonEdit').removeClass('is-valid');
                $('#diskonEdit').addClass('is-invalid');

                $('#hintdiskonEdit').removeClass('text-muted');
                $('#hintdiskonEdit').removeClass('text-success');
                $('#hintdiskonEdit').addClass('text-danger');
        
                $('#hintdiskonEdit').text("*hanya diperbolehkan angka."); 
            }        
        }
    });

    $("#stokEdit").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[0-9]+$/;
        var stokEdit = $('#stokEdit').val();
        if(stokEdit == 0)
        {
            $('#stokEdit').removeClass('is-valid');
            $('#stokEdit').addClass('is-invalid');

            $('#hintstokEdit').removeClass('text-muted');
            $('#hintstokEdit').removeClass('text-success');
            $('#hintstokEdit').addClass('text-danger');

            $('#hintstokEdit').text("stok tidak boleh kosong");
        } 
               
        else
        {
            if(stokEdit.match(validasiHuruf))
            {
                $('#stokEdit').removeClass('is-invalid');
                $('#stokEdit').addClass('is-valid');

                $('#hintstokEdit').removeClass('text-muted');
                $('#hintstokEdit').removeClass('text-danger');
                $('#hintstokEdit').addClass('text-success');

                $('#hintstokEdit').text("*stok sudah diisi.");  
            } 
            else
            {
                $('#stokEdit').removeClass('is-valid');
                $('#stokEdit').addClass('is-invalid');

                $('#hintstokEdit').removeClass('text-muted');
                $('#hintstokEdit').removeClass('text-success');
                $('#hintstokEdit').addClass('text-danger');
        
                $('#hintstokEdit').text("*hanya diperbolehkan angka."); 
            }           
        }
    });

    $("#stok_add").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[0-9]+$/;
        var stok_add = $('#stok_add').val();
        if(stok_add == 0)
        {
            $('#stok_add').removeClass('is-valid');
            $('#stok_add').addClass('is-invalid');

            $('#hintstok_add').removeClass('text-muted');
            $('#hintstok_add').removeClass('text-success');
            $('#hintstok_add').addClass('text-danger');

            $('#hintstok_add').text("stok tidak boleh kosong");
        } 
               
        else
        {
            if(stok_add.match(validasiHuruf))
            {
                $('#stok_add').removeClass('is-invalid');
                $('#stok_add').addClass('is-valid');

                $('#hintstok_add').removeClass('text-muted');
                $('#hintstok_add').removeClass('text-danger');
                $('#hintstok_add').addClass('text-success');

                $('#hintstok_add').text("*stok sudah diisi.");  
            } 
            else
            {
                $('#stok_add').removeClass('is-valid');
                $('#stok_add').addClass('is-invalid');

                $('#hintstok_add').removeClass('text-muted');
                $('#hintstok_add').removeClass('text-success');
                $('#hintstok_add').addClass('text-danger');
        
                $('#hintstok_add').text("*hanya diperbolehkan angka."); 
            }           
        }
    });


    //Save data
    $('#btn_save').on('click',function(e){
        var kd_barang = $('#kd_barang').val();
        var nama = $('#nama').val();
        var kategori = $('#kategori').val();
        var harga_beli = $('#harga_beli').val();
        var harga_jual = $('#harga_jual').val();
        var diskon = $('#diskon').val();
        var stok = $('#stok').val();

        var kd_baranghasClass = $("#kd_barang").hasClass("is-invalid");
        var namahasClass = $("#nama").hasClass("is-invalid");
        var kategorihasClass = $("#kategori").hasClass("is-invalid");
        var harga_belihasClass = $("#harga_beli").hasClass("is-invalid");
        var harga_jualhasClass = $("#harga_jual").hasClass("is-invalid");
        var diskonhasClass = $("#diskon").hasClass("is-invalid");
        var stokhasClass = $("#stok").hasClass("is-invalid");

        if(kd_barang == 0 || nama == 0 || kategori == "Pilih Kategori" || harga_beli == 0 || harga_jual == 0 || stok == 0)
        {
            e.preventDefault();
            Swal.fire(
                'Peringatan!',
                'Sepertinya ada kolom yang belum terisi.',
                'error'
              )
        }    
        else if(kd_baranghasClass || namahasClass || kategorihasClass || harga_belihasClass || harga_jualhasClass || diskonhasClass || stokhasClass)
        {
            e.preventDefault();
            Swal.fire(
                'Terjadi Kesalahan',
                'Sepertinya ada kolom yang merah.',
                'error'
              )
        }
        else
        {
            $.ajax({
                type : "POST",
                url  : "Barang/add",
                dataType : "JSON",
                data : {kd_barang:kd_barang, nama:nama, kategori:kategori, harga_beli:harga_beli, harga_jual:harga_jual, diskon:diskon, stok:stok},
                success: function(data){
                    Swal.fire(
                        'Simpan!',
                        'Data berhasil disimpan.',
                        'success'
                        )
                    $('[name="kd_barang"]').val("");
                    $('[name="nama"]').val("");
                    $('[name="kategori"]').val("Pilih Kategori");
                    $('[name="harga_beli"]').val("");
                    $('[name="harga_jual"]').val("");
                    $('[name="diskon"]').val("");
                    $('[name="stok"]').val("");

                    $('#kd_barang').removeClass('is-valid');
                    $('#hintkd_barang').removeClass('text-success');
                    $('#hintkd_barang').addClass('text-muted');

                    $('#nama').removeClass('is-valid');
                    $('#hintnama').removeClass('text-success');
                    $('#hintnama').addClass('text-muted');

                    $('#kategori').removeClass('is-valid');
                    $('#hintkategori').removeClass('text-success');
                    $('#hintkategori').addClass('text-muted');

                    $('#harga_beli').removeClass('is-valid');
                    $('#hintharga_beli').removeClass('text-success');
                    $('#hintharga_beli').addClass('text-muted');

                    $('#harga_jual').removeClass('is-valid');
                    $('#hintharga_jual').removeClass('text-success');
                    $('#hintharga_jual').addClass('text-muted');

                    $('#diskon').removeClass('is-valid');
                    $('#hintdiskon').removeClass('text-success');
                    $('#hintdiskon').addClass('text-muted');

                    $('#stok').removeClass('is-valid');
                    $('#hintstok').removeClass('text-success');
                    $('#hintstok').addClass('text-muted');

                    $('#tambah-data').modal('hide');
                    reload_table();
                    
                }
            });
            return false;
        }        
    });
     //tampilkan data
    $('#table').on('click','.edit_barang',function(){
        var kd_barang = $(this).data('kd_barang');
        var nama_barang = $(this).data('nama_barang');
        var kategori = $(this).data('kategori');
        var harga_beli = $(this).data('harga_beli');
        var harga_jual = $(this).data('harga_jual');
        var diskon = $(this).data('diskon');
        var stok = $(this).data('stok');
        $('[name="kd_barangEdit"]').val(kd_barang);
        $('[name="namaEdit"]').val(nama_barang);
        $('[name="kategoriEdit"]').val(kategori);
        $('[name="harga_beliEdit"]').val(harga_beli);
        $('[name="harga_jualEdit"]').val(harga_jual);
        $('[name="diskonEdit"]').val(diskon);
        $('[name="stokEdit"]').val(stok);
    });

    $('#table').on('click','.add_stok',function(){
        var kd_barang = $(this).data('kd_barang');
        var nama_barang = $(this).data('nama_barang');
        $('[name="kd_barang_add"]').val(kd_barang);
        $('[name="nama_add"]').val(nama_barang);
    });

    $('#btn_add_stok').on('click',function(e){
        var kd_barangAdd = $('#kd_barang_add').val();
        var stokAdd = $('#stok_add').val();

        var stok_add= $("#stok_add").hasClass("is-valid");

        if(stok_add)
        {
            $.ajax({
                type : "POST",
                url  : "Barang/add_stok",
                dataType : "JSON",
                data : {kd_barangAdd:kd_barangAdd, stokAdd:stokAdd},
                success: function(data){
                    Swal.fire(
                        'Ditambahkan',
                        'Stok berhasil ditambahkan',
                        'success'
                      )
                    $('[name="kd_barang_add"]').val("");
                    $('[name="nama_add"]').val("");
                    $('[name="stok_add"]').val("");

                    $('#stok_add').removeClass('is-valid');
                    $('#hintstok_add').removeClass('text-success');
                    $('#hintstok_add').addClass('text-muted');
                    $('#modal-add-stok').modal('hide');
                    reload_table();
                }
            });
            return false;
        }
        else
        {
            e.preventDefault();
            Swal.fire(
                'Terjadi Kesalahan',
                'Sepertinya ada kolom yang merah.',
                'error'
            )
        }
    });

    //update data
    $('#btn_update').on('click',function(e){
        var kd_barangEdit = $('#kd_barangEdit').val();
        var namaEdit = $('#namaEdit').val();
        var kategoriEdit = $('#kategoriEdit').val();
        var harga_beliEdit = $('#harga_beliEdit').val();
        var harga_jualEdit = $('#harga_jualEdit').val();
        var diskonEdit = $('#diskonEdit').val();

        var kd_barangEdithasClass = $("#kd_barangEdit").hasClass("is-valid");
        var namaEdithasClass = $("#namaEdit").hasClass("is-valid");
        var kategoriEdithasClass = $("#kategoriEdit").hasClass("is-valid");
        var harga_beliEdithasClass = $("#harga_beliEdit").hasClass("is-valid");
        var harga_jualEdithasClass = $("#harga_jualEdit").hasClass("is-valid");
        var diskonEdithasClass = $("#diskonEdit").hasClass("is-valid");

        var kd_barangEdithasClassText = $("#hintkd_barangEdit").hasClass("text-muted");
        var namaEdithasClassText = $("#hintnamaEdit").hasClass("text-muted");
        var kategoriEdithasClassText = $("#hintkategoriEdit").hasClass("text-muted");
        var harga_beliEdithasClassText = $("#hintharga_beliEdit").hasClass("text-muted");
        var harga_jualEdithasClassText = $("#hintharga_jualEdit").hasClass("text-muted");
        var diskonEdithasClassText = $("#hintdiskonEdit").hasClass("text-muted");

        if(kd_barangEdithasClass || namaEdithasClass || kategoriEdithasClass || harga_beliEdithasClass || harga_jualEdithasClass || diskonEdithasClass)
        {
            $.ajax({
                type : "POST",
                url  : "Barang/update",
                dataType : "JSON",
                data : {kd_barangEdit:kd_barangEdit, nama_barangEdit:namaEdit, kategoriEdit:kategoriEdit, harga_beliEdit:harga_beliEdit, harga_jualEdit:harga_jualEdit, diskonEdit:diskonEdit},
                success: function(data){
                    Swal.fire(
                        'Update',
                        'Data berhasil diupdate.',
                        'success'
                      )
                    $('[name="kd_barangEdit"]').val("");
                    $('[name="namaEdit"]').val("");
                    $('[name="kategoriEdit"]').val("");
                    $('[name="harga_beliEdit"]').val("");
                    $('[name="harga_jualEdit"]').val("");
                    $('[name="diskonkEdit"]').val("");

                    $('#kd_barangEdit').removeClass('is-valid');
                    $('#hintkd_barangEdit').removeClass('text-success');
                    $('#hintkd_barangEdit').addClass('text-muted');

                    $('#namaEdit').removeClass('is-valid');
                    $('#hintnamaEdit').removeClass('text-success');
                    $('#hintnamaEdit').addClass('text-muted');

                    $('#kategoriEdit').removeClass('is-valid');
                    $('#hintkategoriEdit').removeClass('text-success');
                    $('#hintkategoriEdit').addClass('text-muted');

                    $('#harga_beliEdit').removeClass('is-valid');
                    $('#hintharga_beliEdit').removeClass('text-success');
                    $('#hintharga_beliEdit').addClass('text-muted');

                    $('#harga_jualEdit').removeClass('is-valid');
                    $('#hintharga_jualEdit').removeClass('text-success');
                    $('#hintharga_jualEdit').addClass('text-muted');

                    $('#diskonEdit').removeClass('is-valid');
                    $('#hintdiskonEdit').removeClass('text-success');
                    $('#hintdiskonEdit').addClass('text-muted');

                    $('#stokEdit').removeClass('is-valid');
                    $('#hintstokEdit').removeClass('text-success');
                    $('#hintstokEdit').addClass('text-muted');
                    $('#modal-edit-data').modal('hide');
                    reload_table();
                }
            });
            return false;
        }
        else if(kd_barangEdithasClassText || namaEdithasClassText || kategoriEdithasClassText || harga_beliEdithasClassText || harga_jualEdithasClassText || diskonEdithasClassText)
        {
            e.preventDefault();
            Swal.fire(
                'Tidak Ada Perubahan',
                'Anda tidak mengedit apapun.',
                'info'
            )
        }
        else
        {
            e.preventDefault();
            Swal.fire(
                'Terjadi Kesalahan',
                'Sepertinya ada kolom yang merah.',
                'error'
            )
        }
    });

    //get data for delete record
    $('#table').on('click','.delete_barang',function(){
        var kd_barang = $(this).data('kd_barang');
         
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
                    url  : "barang/delete",
                    dataType : "JSON",
                    data : {kd_barang:kd_barang},
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