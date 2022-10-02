var table;
$(document).ready(function(){
    // list_data(); //call function show all product  
    $('#diskon').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});
    $('#bayar').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});
    
    $('#kd_barang').focus();

    table = $('#listBarang').DataTable({ 
 
        info: false,
        paging: false,
        searching: false,
        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": "Transaksi/list_cart",
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
    
    $('#subtotal').load("Transaksi/load_total");

    $("#kosong").click(function()
    {
        $("#kd_barang").val(""); 
        $("#kd_barang").focus();
        $('#kd_barang').removeClass('is-invalid');
        $('#hintkd_barang').removeClass('text-danger');
        $('#hintkd_barang').addClass('text-secondary');

        $('#hintkd_barang').text("*masukan kode barang kemudian tekan enter.");
    });

    $("#kd_barang").keypress(function(event)
    {
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var validasiHuruf = /^[a-zA-Z0-9 ]+$/;
        var kd_barang = $('#kd_barang').val();
        if(kd_barang.match(validasiHuruf))
        {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $.ajax({
                    type: "POST",
                    url: "Transaksi/cek_stok",
                    data: $(this).serialize(),
                    success: function (data){
                        // console.log(data);
                        var stok = data;
                        if(data=="0")
                        {
                            Swal.fire(
                                'Barang kosong!',
                                'Sepertinya stok barang habis',
                                'warning'
                                )
                        }
                        else
                        {
                            var jumlah = $('#'+kd_barang).text();
                            console.log(jumlah);
                            if(jumlah == stok)
                            {
                                Swal.fire(
                                    'Stok habis!',
                                    'Sepertinya stok barang habis',
                                    'info'
                                    )
                            }
                            else
                            {
                                $.ajax({
                                    url : "Transaksi/add_cart",
                                    type: "POST",
                                    data: {kd_barang:kd_barang},
                                    dataType: "JSON",
                                    success: function(data)
                                    {
                                        $('#kd_barang').removeClass('is-invalid');
                                        $('#hintkd_barang').removeClass('text-danger');
                                        $('#hintkd_barang').addClass('text-muted');
                                        $('#hintkd_barang').text("*masukan kode barang kemudian tekan enter.");
                                        reload_table();
                                        $('#subtotal').load("Transaksi/load_total");                        
                                        $("#kd_barang").val(""); 
                                        $("#kd_barang").focus();
                                        $("#bayar").val(""); 
                                        $('#kembalian').val('Rp. 0');  
                                    },
                                    error: function()
                                    {
                                        Swal.fire(
                                            'Kosong',
                                            'Data tidak ada.',
                                            'warning'
                                            )
                                    },
                                });
                            }
                        }
                    }
                    });
                $('#kd_barang').removeClass('is-invalid');
                $('#hintkd_barang').removeClass('text-danger');
                $('#hintkd_barang').addClass('text-muted');
                $('#hintkd_barang').text("*masukan kode barang kemudian tekan enter.");  
            }     
            
        } 
        else if(kd_barang == 0)
        {
            $('#kd_barang').removeClass('is-invalid');
            $('#hintkd_barang').removeClass('text-danger');
            $('#hintkd_barang').addClass('text-muted');

            $('#hintkd_barang').text("*masukan kode barang kemudian tekan enter."); 
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

         
    });

    //get data for delete record
    $('#listBarang').on('click','.delete_item',function(){
        var kd_barang = $(this).data('kd_barang');
         
        $.ajax({
            type : "POST",
            url  : "Transaksi/remove_item",
            dataType : "JSON",
            data : {kd_barang:kd_barang},
            success: function(data){
                  reload_table();
                  $('#subtotal').load("Transaksi/load_total");
                  $("#kd_barang").focus();
                  $("#total").text("Rp. 0");
            }
        });
        return false;
    });

    $("#diskon").focusin(function()
    {
        // $('#cetak').removeAttr("hidden");
        $('#cetak').attr("disabled", "disabled");
    });

    $("#diskon").keypress(function(event)
    {
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13')
        {
            var subtotal= $("#subtotalval").val();
            var diskon= $("#diskon").val();
            var subtotalint = Number(subtotal.replace(/[^0-9-]+/g,""));
            var diskonint = Number(diskon.replace(/[^0-9-]+/g,""));
            var hasil = Number(subtotalint-diskonint);
            var output = hasil.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            $("#total").text('Rp. '+output);
            $('#bayar').focus();
            event.preventDefault();
        }  
    });

    $("#diskon").focusout(function(event)
    {
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var subtotal= $("#subtotalval").val();
        var diskon= $("#diskon").val();
        var subtotalint = Number(subtotal.replace(/[^0-9-]+/g,""));
        var diskonint = Number(diskon.replace(/[^0-9-]+/g,""));
        var hasil = Number(subtotalint-diskonint);
        var output = hasil.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $("#total").text('Rp. '+output);
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13')
        {
            $('#bayar').focus();
            event.preventDefault();
        }
    });
    
    $("#bayar").focusin(function()
    {
        // $('#cetak').removeAttr("hidden");
        $('#cetak').attr("disabled", "disabled");
        var subtotal= $("#subtotalval").val();
        var diskon= $("#diskon").val();
        var subtotalint = Number(subtotal.replace(/[^0-9-]+/g,""));
        var diskonint = Number(diskon.replace(/[^0-9-]+/g,""));
        var hasil = Number(subtotalint-diskonint);
        var output = hasil.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $("#total").text('Rp. '+output);
        $('#bayar').focus();
        event.preventDefault();
    });

    $('#bayar').keypress(function(event){
        var currency = $('#total').text();
        var getbayar = $('#bayar').val();
        var bayar = Number(getbayar.replace(/[^0-9-]+/g,""));
        var total = Number(currency.replace(/[^0-9-]+/g,""));
        var hasil = Number(bayar-total);
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13')
        {
            // var output = (hasil/1000).toFixed(3);
            var output = hasil.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
            $('#kembalian').val('Rp. '+output);
            event.preventDefault();
            $('#cetak').removeAttr('disabled');
            $('#cetak').focus();
            event.preventDefault();
            // 
        }
    });

    $('#bayar').focusout(function(event){
        var currency = $('#total').text();
        var getbayar = $('#bayar').val();
        var bayar = Number(getbayar.replace(/[^0-9-]+/g,""));
        var total = Number(currency.replace(/[^0-9-]+/g,""));
        var hasil = Number(bayar-total);
        // var output = (hasil/1000).toFixed(3);
        var output = hasil.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $('#kembalian').val('Rp. '+output);
        event.preventDefault();
        $('#cetak').removeAttr('disabled');
        $('#cetak').focus();
    });

    $('#selesai').click(function(){
        $('#kembalian').val('Rp. 0');
        $('#diskon').val("");
        $('#bayar').val("");
        $('#total').text("Rp. 0");
        $('#diskon').val("Rp. 0");
        $('#cetak').removeAttr("hidden");
        $('#batal').removeAttr("disabled");
        $('#kd_barang').removeAttr("disabled");
        $('#cetak').attr("disabled", "disabled");
        $('#selesai').attr("disabled", "disabled");

        $.ajax({
            type : "POST",
            url  : "Transaksi/remove_all",
            dataType : "JSON",
            success: function(data){
                  reload_table();
                  $('#subtotal').load("Transaksi/load_total");
                  $("#kd_barang").focus();

                  Swal.fire(
                    'Transaksi Selesai',
                    'Transaksi dibersihkan',
                    'success'
                    )
            }
        });
        return false;
    });
    
    $('#cetak').click(function(){
        $('#selesai').removeAttr('disabled');
        $('#cetak').attr("hidden", "hidden");
        $('#kd_barang').attr("disabled", "disabled");
        $('#batal').attr("disabled", "disabled");
        // var diskon = $('#diskon').val();
        // var bayar = $('#bayar').val();
        // var kembali = $('#kembalian').val();
        // var link = $(this).attr('http://localhost/pos/Transaksi/cetak_struk');
        // window.open(link, '_blank');
        // $.ajax({
        //     type : "POST",
        //     url  : "Transaksi/cetak_struk",
        //     dataType : "JSON",
        //     data : {diskon:diskon, bayar:bayar, kembali:kembali},
        //     success: function(data){
                
        //     }
        // });
    });

    $('#batal').click(function(){
        $('#cetak').attr("disabled", "disabled");
        $('#kembalian').val('Rp. 0');
        $('#bayar').val("");
        $('#total').text("Rp. 0");
         
        $.ajax({
            type : "POST",
            url  : "Transaksi/remove_all",
            dataType : "JSON",
            success: function(data){
                  reload_table();
                  $('#subtotal').load("Transaksi/load_total");
                  $("#kd_barang").focus();
            }
        });
        return false;
    });

    $("#anggota").change(function(){
        var selected = $(this).children("option:selected").val();
        // console.log(selected)
        if(selected == "anggota"){
            $("#noAnggota").removeAttr("hidden")
        }
        else{
            $("#noAnggota").attr("hidden", true)
        }
    });

   
});