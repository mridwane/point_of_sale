const flashData = $('.flash-data').data('flashdata');
// console.log(flashData);
if(flashData == "berhasil update")
{
    Swal.fire({
        title: 'Berhasil',
        text: 'Password berhasil diganti',
        icon: 'success'
    })
}
else if (flashData == "gagal update")
{
    Swal.fire({
        title: 'Gagal',
        text: 'Password lama anda tidak cocok',
        icon: 'error'
    })
}

$(document).ready(function(){ 

    $('#tg_pwdold').click(function(){
       
        if($(this).hasClass('fa-eye-slash'))
        {           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#passold').attr('type','text');
            
        }
        else
        {         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#passold').attr('type','password');
        }
    });

    $('#tg_pwdnew').click(function(){
       
        if($(this).hasClass('fa-eye-slash'))
        {           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#passnew').attr('type','text');
            
        }
        else
        {         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#passnew').attr('type','password');
        }
    });

    $('#tg_pwdconf').click(function(){
       
        if($(this).hasClass('fa-eye-slash'))
        {           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#passconf').attr('type','text');
            
        }
        else
        {         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#passconf').attr('type','password');
        }
    });

    $("#passold").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var passold = $('#passold').val(); 
        var validasi = /^[a-zA-Z0-9]*$/;
        
        if(passold == 0)
        {
            $('#passold').addClass('is-invalid');

            $('#hintpassold').removeClass('text-muted');
            $('#hintpassold').addClass('text-danger');

            $('#hintpassold').text("password tidak boleh kosong");
        }    
        
        else
        {
            if(passold.match(validasi))
            {
                $('#passold').removeClass('is-valid');                
                $('#passold').removeClass('is-invalid');

                $('#hintpassold').removeClass('text-danger');
                $('#hintpassold').removeClass('text-muted');
                $('#hintpassold').text("*password 8-20 karakter.");
            } 
            else
            {
                $('#passold').removeClass('is-valid');
                $('#passold').addClass('is-invalid');

                $('#hintpassold').removeClass('text-muted');
                $('#hintpassold').removeClass('text-success');
                $('#hintpassold').addClass('text-danger');
        
                $('#hintpassold').text("*tidak boleh mengandung karakter simbol."); 
            } 
        }
    });

    $("#passnew").keyup(function()
    {
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var passnew = $('#passnew').val();
        var hitung = $('#passnew').val().length;
        var validasi1 = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        var validasi2 = /^[a-zA-Z0-9]*$/;
        if(passnew == 0)
        {
            $('#passnew').removeClass('is-valid');
            $('#passnew').addClass('is-invalid');

            $('#hintpassnew').removeClass('text-muted');
            $('#hintpassnew').removeClass('text-success');
            $('#hintpassnew').addClass('text-danger');

            $('#hintpassnew').text("password tidak boleh kosong");
        }  
        else if(hitung <= 7)
        {
            $('#passnew').removeClass('is-valid');
            $('#passnew').addClass('is-invalid');

            $('#hintpassnew').removeClass('text-muted');
            $('#hintpassnew').removeClass('text-success');
            $('#hintpassnew').addClass('text-danger');

            $('#hintpassnew').text("password minimal 8 karakter.");
        }       
        else
        {
            if(passnew.match(validasi1))
            {
                if(passnew.match(validasi2))
                {
                    $('#passnew').removeClass('is-invalid');
                    $('#passnew').addClass('is-valid');

                    $('#hintpassnew').removeClass('text-danger');
                    $('#hintpassnew').removeClass('text-muted');
                    $('#hintpassnew').addClass('text-success');
            
                    $('#hintpassnew').text("*password baik."); 
                }
                else
                {
                    $('#passnew').removeClass('is-valid');
                    $('#passnew').addClass('is-invalid');

                    $('#hintpassnew').removeClass('text-success');
                    $('#hintpassnew').removeClass('text-muted');
                    $('#hintpassnew').addClass('text-danger');
            
                    $('#hintpassnew').text("*password tidak mengandung karakter simbol."); 
                }
            } 
            else
            {
                $('#passnew').removeClass('is-valid');
                $('#passnew').addClass('is-invalid');

                $('#hintpassnew').removeClass('text-muted');
                $('#hintpassnew').removeClass('text-success');
                $('#hintpassnew').addClass('text-danger');
        
                $('#hintpassnew').text("*harus memiliki angka, huruf besar, dan huruf kecil."); 
            }    

                      
        }
    });

    $("#passconf").keyup(function()
    {
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var passnew = $('#passnew').val();
        var passconf = $('#passconf').val();
        var validasi = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        if(passconf == 0)
        {
            $('#passconf').removeClass('is-valid');
            $('#passconf').addClass('is-invalid');

            $('#hintpassconf').removeClass('text-muted');
            $('#hintpassconf').removeClass('text-success');
            $('#hintpassconf').addClass('text-danger');

            $('#hintpassconf').text("Password konfirmasi tidak boleh kosong.");
        }        
        else
        {
            if(passconf.match(validasi))
            {
                if(passnew == passconf)
                {
                    $('#passconf').removeClass('is-invalid');
                    $('#passconf').addClass('is-valid');

                    $('#hintpassconf').removeClass('text-danger');
                    $('#hintpassconf').removeClass('text-muted');
                    $('#hintpassconf').addClass('text-success');
            
                    $('#hintpassconf').text("*password dikonfirmasi.");  
                }
                else
                {
                    $('#passconf').removeClass('is-valid');
                    $('#passconf').addClass('is-invalid');

                    $('#hintpassconf').removeClass('text-success');
                    $('#hintpassconf').removeClass('text-muted');
                    $('#hintpassconf').addClass('text-danger');
            
                    $('#hintpassconf').text("*password tidak sama.");
                }
                
            } 
            else
            {
                $('#passconf').removeClass('is-valid');
                $('#passconf').addClass('is-invalid');

                $('#hintpassconf').removeClass('text-muted');
                $('#hintpassconf').removeClass('text-success');
                $('#hintpassconf').addClass('text-danger');
        
                $('#hintpassconf').text("*harus memiliki angka, huruf besar, dan huruf kecil."); 
            }    

                      
        }
    });

    $("#passnew").keyup(function()
    {
        $('#passconf').val("");
        $('#passconf').removeClass('is-valid');
        $('#passconf').removeClass('is-invalid');

        $('#hintpassconf').removeClass('text-danger');
        $('#hintpassconf').removeClass('text-success');
        $('#hintpassconf').addClass('text-muted');

        $('#hintpassconf').text("*masukan kembali password anda.");
    });

    $('#btnSimpan').click(function(e)
    {
        var passold = $("#passold").hasClass("is-invalid");
        var passnew = $("#passnew").hasClass("is-invalid");
        var passconf = $("#passconf").hasClass("is-invalid");

        var passold_val = $("#passold").val();
        var passnew_val = $("#passold").val();
        var passconf_val = $("#passconf").val();

        if(passold || passnew || passconf)
        {
            e.preventDefault();
            Swal.fire(
                'error',
                'Silahkan cek lagi password anda',
                'error'
              )
        }
        else if(passold_val == 0 || passnew_val == 0 || passconf_val == 0)
        {
            e.preventDefault();
            Swal.fire(
                'error',
                'Sepertinya ada kolom yang belum diisi',
                'error'
              )
        }
        else
        {
            return true;
        }
    });
    

});