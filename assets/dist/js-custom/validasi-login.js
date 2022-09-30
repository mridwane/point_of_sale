const flashData = $('.flash-data').data('flashdata');
// console.log(flashData);
if(flashData == "berhasil mendaftar")
{
    Swal.fire({
        title: 'Berhasil Mendaftar',
        text: 'Silahkan Hubungi Admin Untuk Konfirmasi.',
        icon: 'success'
    })
}
else if(flashData == "password salah")
{
    Swal.fire({
        title: 'Password anda Salah',
        icon: 'error'
    })
}
else if(flashData == "username salah")
{
    Swal.fire({
        title: 'Username anda Salah',
        icon: 'error'
    })
}
else if(flashData == "berhasil update")
{
    Swal.fire({
        title: 'Berhasil',
        text: 'Password berhasil diganti',
        icon: 'success'
    })
}
else if(flashData == "belum terdaftar")
{
    Swal.fire({
        title: 'Akun Anda Belum Terdaftar',
        text: 'Pastikan admin untuk mengkonfirmasi pendaftaran anda.',
        icon: 'warning'
    })
}
else if(flashData == "status nonaktif")
{
    Swal.fire({
        title: 'Akun Nonaktif',
        text: 'Sepertinya akun anda dinonaktifkan untuk sementara, silahkan hubungi admin.',
        icon: 'warning'
    })
}

$(document).ready(function(){ 

    $('#tg_pwd1').click(function(){
       
        if($(this).hasClass('fa-eye-slash'))
        {           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#pass1').attr('type','text');
            
        }
        else
        {         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#pass1').attr('type','password');
        }
    });

    $("#username").blur(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var username = $('#username').val();
        var validasi = /^[a-zA-Z0-9]*$/;

        if(username == 0)
        {
            $('#username').removeClass('is-valid');
            $('#username').addClass('is-invalid');

            $('#hintusername').removeClass('text-muted');
            $('#hintusername').removeClass('text-success');
            $('#hintusername').addClass('text-danger');

            $('#hintusername').text("username tidak boleh Kosong");
        }         
        else
        {
            if(username.match(validasi))
            {
                $('#username').removeClass('is-invalid');
                $('#username').removeClass('is-valid');

                $('#hintusername').removeClass('text-danger');
                $('#hintusername').removeClass('text-success');
                $('#hintusername').removeClass('text-muted');
                $('#hintusername').text("");
            } 
            else
            {
                $('#username').removeClass('is-valid');
                $('#username').addClass('is-invalid');

                $('#hintusername').removeClass('text-muted');
                $('#hintusername').removeClass('text-success');
                $('#hintusername').addClass('text-danger');
        
                $('#hintusername').text("*tidak boleh mengandung karakter simbol."); 
            }    
        }
    });

    $("#username").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var username = $('#username').val();
        var validasi = /^[a-zA-Z0-9]*$/;

        if(username == 0)
        {
            $('#username').removeClass('is-valid');
            $('#username').addClass('is-invalid');

            $('#hintusername').removeClass('text-muted');
            $('#hintusername').removeClass('text-success');
            $('#hintusername').addClass('text-danger');

            $('#hintusername').text("username tidak boleh Kosong");
        }         
        else
        {
            if(username.match(validasi))
            {
                $('#username').removeClass('is-invalid');
                $('#username').removeClass('is-valid');

                $('#hintusername').removeClass('text-danger');
                $('#hintusername').removeClass('text-success');
                $('#hintusername').removeClass('text-muted');
                $('#hintusername').text("");
            } 
            else
            {
                $('#username').removeClass('is-valid');
                $('#username').addClass('is-invalid');

                $('#hintusername').removeClass('text-muted');
                $('#hintusername').removeClass('text-success');
                $('#hintusername').addClass('text-danger');
        
                $('#hintusername').text("*tidak boleh mengandung karakter simbol."); 
            }    
        }
    });

    $("#pass1").blur(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var pass1 = $('#pass1').val(); 
        var validasi = /^[a-zA-Z0-9]*$/;
        
        if(pass1 == 0)
        {
            $('#pass1').addClass('is-invalid');

            $('#hintpass1').removeClass('text-muted');
            $('#hintpass1').addClass('text-danger');

            $('#hintpass1').text("password tidak boleh kosong");
        }    
        
        else
        {
            if(pass1.match(validasi))
            {
                $('#pass1').removeClass('is-invalid');
                $('#hintpass1').removeClass('text-danger');
                $('#hintpass1').removeClass('text-muted');
                $('#hintpass1').text("*");
            } 
            else
            {
                $('#pass1').removeClass('is-valid');
                $('#pass1').addClass('is-invalid');

                $('#hintpass1').removeClass('text-muted');
                $('#hintpass1').removeClass('text-success');
                $('#hintpass1').addClass('text-danger');
        
                $('#hintpass1').text("*tidak boleh mengandung karakter simbol."); 
            } 
        }
    });

    $("#pass1").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var pass1 = $('#pass1').val(); 
        var validasi = /^[a-zA-Z0-9]*$/;
        
        if(pass1 == 0)
        {
            $('#pass1').addClass('is-invalid');

            $('#hintpass1').removeClass('text-muted');
            $('#hintpass1').addClass('text-danger');

            $('#hintpass1').text("password tidak boleh kosong");
        }    
        
        else
        {
            if(pass1.match(validasi))
            {
                $('#pass1').removeClass('is-invalid');
                $('#hintpass1').removeClass('text-danger');
                $('#hintpass1').removeClass('text-muted');
                $('#hintpass1').text("*");
            } 
            else
            {
                $('#pass1').removeClass('is-valid');
                $('#pass1').addClass('is-invalid');

                $('#hintpass1').removeClass('text-muted');
                $('#hintpass1').removeClass('text-success');
                $('#hintpass1').addClass('text-danger');
        
                $('#hintpass1').text("*tidak boleh mengandung karakter simbol."); 
            } 
            
        }
    });

    $('#btnLogin').click(function(e){
        
        var username = $("#username").hasClass("is-invalid");
        var pass1 = $("#pass1").hasClass("is-invalid");
        var usernameValue = $("#username").val();
        var pass1Value = $("#pass1").val();

        if(username || pass1)
        {
            e.preventDefault();
        }

        else if(usernameValue == 0)
        {
            e.preventDefault();

            $('#username').addClass('is-invalid');
            $('#hintusername').addClass('text-danger');
            $('#hintusername').text("username tidak boleh kosong");
        }
        else if(pass1Value == 0)
        {
            e.preventDefault();

            $('#pass1').addClass('is-invalid');
            $('#hintpass1').addClass('text-danger');
            $('#hintpass1').text("password tidak boleh kosong");
        }
        else
        {
            return true;

        }
    });
    

});