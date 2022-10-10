var table;
$(document).ready(function(){
    // list_data(); //call function show all product  
    $('#diskon').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});
    $('#cash').autoNumeric('init' ,{aSep: '.', aDec: ',', mDec: '0'});
    
    $('#kd_barang').focus();

    table = $('#listBarang').DataTable({ 
 
        info: false,
        paging: false,
        searching: false,
        "processing": true, 
        "serverSide": true, 
        "order": [], 
         
        "ajax": {
            "url": "Transaksi_offline/list_cart",
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
    
    $('#subtotal').load("Transaksi_offline/load_subtotal");
    $('#discount').load("Transaksi_offline/load_discount");
    $('#grandtotal').load("Transaksi_offline/load_grandtotal");

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
                    url: "Transaksi_offline/cek_stok",
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
                                    url : "Transaksi_offline/add_cart",
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
                                        $('#subtotal').load("Transaksi_offline/load_subtotal");  
                                        $('#discount').load("Transaksi_offline/load_discount");  
                                        $('#grandtotal').load("Transaksi_offline/load_grandtotal");                    
                                        $("#kd_barang").val(""); 
                                        $("#kd_barang").focus();
                                        $("#cash").val(""); 
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
            url  : "Transaksi_offline/remove_item",
            dataType : "JSON",
            data : {kd_barang:kd_barang},
            success: function(data){
                  reload_table();
                  $('#subtotal').load("Transaksi_offline/load_subtotal");
                  $('#discount').load("Transaksi_offline/load_discount");
                  $('#grandtotal').load("Transaksi_offline/load_grandtotal");
                  $("#kd_barang").focus();
                  $("#total").text("Rp. 0");
            }
        });
        return false;
    });

    $('#cash').keypress(function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13')
        {
            // $('#cetak').attr("disabled", "disabled");
            var cashstring= $("#cash").val();
            var pay= $("#pay").val();            
            var cash = Number(cashstring.replace(/[^0-9-]+/g,""));
            var changes = Number(cash-pay);
            $("#changes").val('Rp. '+changes);
            $('#cetak').removeAttr('disabled');
            // $('#cetak').focus();
        }
    });

    $('#selesai').click(function(){
        $('#cash').val("");
        $('#total').text("Rp. 0");
        $('#diskon').val("Rp. 0");
        $('#changes').val("Rp. 0");
        $("#anggota").val(0);
        $('.show-member').attr("hidden", "hidden");
        $('#member_number').attr("hidden", "hidden");
        $('#member_number').val("");
        $('#memberName').val("");
        $('#memberArea').val("");
        $('#cetak').removeAttr("hidden");
        $('#batal').removeAttr("disabled");
        $('#kd_barang').removeAttr("disabled");
        $('#cetak').attr("disabled", "disabled");
        $('#cash').attr("disabled", "disabled");
        $('#selesai').attr("disabled", "disabled");

        $.ajax({
            type : "POST",
            url  : "Transaksi_offline/remove_all",
            dataType : "JSON",
            success: function(data){
                  reload_table();
                  $('#subtotal').load("Transaksi_offline/load_subtotal");
                  $('#discount').load("Transaksi_offline/load_discount");
                  $('#grandtotal').load("Transaksi_offline/load_grandtotal");
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
        // var discountString = $('#discountval').val();
        // var discount = Number(discountString.replace(/[^0-9-]+/g,""));
        // var cashString= $("#cash").val();
        // var pay= $("#pay").val();            
        // var cash = Number(cashString.replace(/[^0-9-]+/g,""));
        // var changesString= $("#changes").val(); 
        // var changes = Number(changesString.replace(/[^0-9-]+/g,""));
        // console.log(discount)
        // console.log(pay)
        // console.log(cash)
        // console.log(changes)
        // // var bayar = $('#cash').val();
        // // var kembali = $('#kembalian').val();
        // var link = $(this).attr('http://localhost/pos/Transaksi/cetak_struk');
        // window.open(link, '_blank');

        // $.ajax({
        //     type : "POST",
        //     url  : "Transaksi_offline/cetak_struk",
        //     dataType : "JSON",
        //     data : {discount:discount, pay:pay, cash:cash, changes:changes},
        //     success: function(data){
                
        //     }
        // });
    });

    $('#batal').click(function(){
        $('#cetak').attr("disabled", "disabled");
        $('#kembalian').val('Rp. 0');
        $('#cash').val("");
        $('#total').text("Rp. 0");
         
        $.ajax({
            type : "POST",
            url  : "Transaksi_offline/remove_all",
            dataType : "JSON",
            success: function(data){
                  reload_table();
                  $('#subtotal').load("Transaksi_offline/load_subtotal");
                  $('#discount').load("Transaksi_offline/load_discount");
                  $('#grandtotal').load("Transaksi_offline/load_grandtotal");
                  $("#kd_barang").focus();
            }
        });
        return false;
    });

    $("#anggota").change(function(){
        var selected = $(this).children("option:selected").val();
        
        // console.log(selected)
        if(selected == "anggota"){
            $("#member_number").removeAttr("hidden")
            $(".show-member").removeAttr("hidden")
        }
        else{
            $("#member_number").attr("hidden", true)
            $(".show-member").attr("hidden", true)
        }
        $("#cash").removeAttr("disabled")
    });

    $("#member_number").keypress(function(event)
    {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
        // console.log($(this).serialize())
        $.ajax({
                url : "Transaksi_offline/get_member",
                type: "POST",
                data: $(this).serialize(),
                dataType:'JSON',
                success: function(data)
                {
                    $("#memberId").val(data.member_id);  
                    $("#memberName").val(data.member_name);      
                    $("#memberArea").val(data.member_area);  
                },
                error: function()
                {
                    Swal.fire(
                        'Kosong',
                        'Data Anggota Tidak Ada.',
                        'warning'
                        )
                },
            });     
        }    
    });

   
});