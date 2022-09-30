$(document).ready(function(){

    $("#nama").keyup(function(){
        var validasiHuruf = /^[a-zA-Z ]+$/;
        var nama = $('#nama').val();
        if(nama == 0)
        {
            $('#nama').removeClass('is-valid');
            $('#nama').addClass('is-invalid');

            $('#hintnama').removeClass('text-muted');
            $('#hintnama').removeClass('text-success');
            $('#hintnama').addClass('text-danger');

            $('#hintnama').text("nama tidak boleh kosong");
        } 
               
        else
        {
            if(nama.match(validasiHuruf))
            {
                $('#nama').removeClass('is-invalid');
                $('#nama').removeClass('is-valid');

                $('#hintnama').removeClass('text-danger');
                $('#hintnama').removeClass('text-success');
                $('#hintnama').addClass('text-muted');
        
                $('#hintnama').text("*nama max 20 karakter."); 
            } 
            else
            {
                $('#nama').removeClass('is-valid');
                $('#nama').addClass('is-invalid');

                $('#hintnama').removeClass('text-muted');
                $('#hintnama').removeClass('text-success');
                $('#hintnama').addClass('text-danger');
        
                $('#hintnama').text("*hanya diperbolehkan huruf"); 
            }           
        }
    });

    $("#nama").focusout(function(){
        var validasiHuruf = /^[a-zA-Z ]+$/;
        var nama = $('#nama').val();
        if(nama == 0)
        {
            $('#nama').removeClass('is-valid');
            $('#nama').addClass('is-invalid');

            $('#hintnama').removeClass('text-muted');
            $('#hintnama').removeClass('text-success');
            $('#hintnama').addClass('text-danger');

            $('#hintnama').text("nama tidak boleh kosong");
        } 
               
        else
        {
            if(nama.match(validasiHuruf))
            {
                $('#nama').removeClass('is-invalid');
                $('#nama').addClass('is-valid');

                $('#hintnama').removeClass('text-danger');
                $('#hintnama').removeClass('text-muted');
                $('#hintnama').addClass('text-success');
        
                $('#hintnama').text("*nama terkonfirmasi."); 
            } 
            else
            {
                $('#nama').removeClass('is-valid');
                $('#nama').addClass('is-invalid');

                $('#hintnama').removeClass('text-muted');
                $('#hintnama').removeClass('text-success');
                $('#hintnama').addClass('text-danger');
        
                $('#hintnama').text("*hanya diperbolehkan huruf"); 
            }           
        }
    });

    $("#username").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var username = $('#username').val();
        var hitung = $('#username').val().length;
        var validasi = /^[a-zA-Z0-9]*$/;
        if(username == 0)
        {
            $('#username').removeClass('is-valid');
            $('#username').addClass('is-invalid');

            $('#hintusername').removeClass('text-muted');
            $('#hintusername').removeClass('text-success');
            $('#hintusername').addClass('text-danger');

            $('#hintusername').text("username tidak boleh kosong");
        }  
        else if(hitung <= 7)
        {
            $('#username').removeClass('is-valid');
            $('#username').addClass('is-invalid');

            $('#hintusername').removeClass('text-muted');
            $('#hintusername').removeClass('text-success');
            $('#hintusername').addClass('text-danger');

            $('#hintusername').text("username minimal 8 karakter.");
        }       
        else
        {
            if(username.match(validasi))
            {
                $('#username').removeClass('is-invalid');
                $('#username').removeClass('is-valid');

                $('#hintusername').removeClass('text-danger');
                $('#hintusername').removeClass('text-success');
                $('#hintusername').addClass('text-muted');
        
                $('#hintusername').text("*username max 20 karakter.");  
            } 
            else
            {
                $('#username').removeClass('is-valid');
                $('#username').addClass('is-invalid');

                $('#hintusername').removeClass('text-muted');
                $('#hintusername').removeClass('text-success');
                $('#hintusername').addClass('text-danger');
        
                $('#hintusername').text("*tidak boleh mengandung simbol."); 
            }    

                      
        }
    });

    $("#username").focusout(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var username = $('#username').val();
        var hitung = $('#username').val().length;
        var validasi = /^[a-zA-Z0-9]*$/;

        if(username == 0)
        {
            $('#username').removeClass('is-valid');
            $('#username').addClass('is-invalid');

            $('#hintusername').removeClass('text-muted');
            $('#hintusername').removeClass('text-success');
            $('#hintusername').addClass('text-danger');

            $('#hintusername').text("username tidak boleh kosong");
        }   
        else if(hitung <= 7)
        {
            $('#username').removeClass('is-valid');
            $('#username').addClass('is-invalid');

            $('#hintusername').removeClass('text-muted');
            $('#hintusername').removeClass('text-success');
            $('#hintusername').addClass('text-danger');

            $('#hintusername').text("username minimal 8 karakter.");
        }      
        else
        {
            if(username.match(validasi))
            {
                $.ajax({
                    type: "POST",
                    url: "cek_username",
                    data: $(this).serialize(),
                    success: function (data){
                        // console.log(data);
                        if(data=="username")
                        {
                            $('#username').removeClass('is-valid');
                            $('#username').addClass('is-invalid');
    
                            $('#hintusername').removeClass('text-muted');
                            $('#hintusername').removeClass('text-success');
                            $('#hintusername').addClass('text-danger');
    
                            $('#hintusername').text("username tidak tersedia.");  
                        } 
                        else 
                        {
                            $('#username').removeClass('is-invalid');
                            $('#username').addClass('is-valid');
    
                            $('#hintusername').removeClass('text-muted');
                            $('#hintusername').removeClass('text-danger');
                            $('#hintusername').addClass('text-success');
    
                            $('#hintusername').text("username tersedia.");  
                        }
                    }
                 });
            } 
            else
            {
                $('#username').removeClass('is-valid');
                $('#username').addClass('is-invalid');

                $('#hintusername').removeClass('text-muted');
                $('#hintusername').removeClass('text-success');
                $('#hintusername').addClass('text-danger');
        
                $('#hintusername').text("*tidak boleh mengandung simbol."); 
            }    
                    
        }
    });

    $("#akses").focusout(function(){
        var akses = $('#akses').val();
        if(akses == "Pilih")
        {
            $('#akses').removeClass('is-valid');
            $('#akses').addClass('is-invalid');

            $('#hintakses').removeClass('text-muted');
            $('#hintakses').removeClass('text-success');
            $('#hintakses').addClass('text-danger');

            $('#hintakses').text("akses belum dipilih");
        }        
        else
        {
            $('#akses').removeClass('is-invalid');
            $('#akses').addClass('is-valid');

            $('#hintakses').removeClass('text-danger');
            $('#hintakses').addClass('text-success');
    
            $('#hintakses').text("*akses sudah dipilih");         
        }
    });

    $("#pass1").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var pass1 = $('#pass1').val();
        var hitung = $('#pass1').val().length;
        var validasi1 = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        var validasi2 = /^[a-zA-Z0-9]*$/;
        if(pass1 == 0)
        {
            $('#pass1').removeClass('is-valid');
            $('#pass1').addClass('is-invalid');

            $('#hintpass1').removeClass('text-muted');
            $('#hintpass1').removeClass('text-success');
            $('#hintpass1').addClass('text-danger');

            $('#hintpass1').text("password tidak boleh kosong");
        }  
        else if(hitung <= 7)
        {
            $('#pass1').removeClass('is-valid');
            $('#pass1').addClass('is-invalid');

            $('#hintpass1').removeClass('text-muted');
            $('#hintpass1').removeClass('text-success');
            $('#hintpass1').addClass('text-danger');

            $('#hintpass1').text("password minimal 8 karakter.");
        }       
        else
        {
            if(pass1.match(validasi1))
            {
                if(pass1.match(validasi2))
                {
                    $('#pass1').removeClass('is-invalid');
                    $('#pass1').addClass('is-valid');

                    $('#hintpass1').removeClass('text-danger');
                    $('#hintpass1').removeClass('text-muted');
                    $('#hintpass1').addClass('text-success');
            
                    $('#hintpass1').text("*password sudah terisi.");  
                }
                else
                {
                    $('#pass1').removeClass('is-valid');
                    $('#pass1').addClass('is-invalid');
    
                    $('#hintpass1').removeClass('text-muted');
                    $('#hintpass1').removeClass('text-success');
                    $('#hintpass1').addClass('text-danger');
            
                    $('#hintpass1').text("*tidak mengandung karakter simbol."); 
                }
                
            } 
            else
            {
                $('#pass1').removeClass('is-valid');
                $('#pass1').addClass('is-invalid');

                $('#hintpass1').removeClass('text-muted');
                $('#hintpass1').removeClass('text-success');
                $('#hintpass1').addClass('text-danger');
        
                $('#hintpass1').text("*harus memiliki angka, huruf besar, dan huruf kecil"); 
            }    

                      
        }
    });

    $("#pass1").focusin(function(){
        $('#pass2').val("");
        $('#pass2').removeClass('is-valid');
        $('#pass2').removeClass('is-invalid');

        $('#hintpass2').removeClass('text-danger');
        $('#hintpass2').removeClass('text-success');
        $('#hintpass2').addClass('text-muted');

        $('#hintpass2').text("*masukan kembali password anda.");
    });

    $("#pass2").keyup(function(){
        this.value = this.value.replace(/\s/g, ""); //untuk mencegah spasi
        var pass1 = $('#pass1').val();
        var pass2 = $('#pass2').val();
        var validasi = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
        if(pass2 == 0)
        {
            $('#pass2').removeClass('is-valid');
            $('#pass2').addClass('is-invalid');

            $('#hintpass2').removeClass('text-muted');
            $('#hintpass2').removeClass('text-success');
            $('#hintpass2').addClass('text-danger');

            $('#hintpass2').text("Password konfirmasi tidak boleh kosong.");
        }        
        else
        {
            if(pass2.match(validasi))
            {
                if(pass1 == pass2)
                {
                    $('#pass2').removeClass('is-invalid');
                    $('#pass2').addClass('is-valid');

                    $('#hintpass2').removeClass('text-danger');
                    $('#hintpass2').removeClass('text-muted');
                    $('#hintpass2').addClass('text-success');
            
                    $('#hintpass2').text("*password dikonfirmasi.");  
                }
                else
                {
                    $('#pass2').removeClass('is-valid');
                    $('#pass2').addClass('is-invalid');

                    $('#hintpass2').removeClass('text-success');
                    $('#hintpass2').removeClass('text-muted');
                    $('#hintpass2').addClass('text-danger');
            
                    $('#hintpass2').text("*password tidak sama.");
                }
                
            } 
            else
            {
                $('#pass2').removeClass('is-valid');
                $('#pass2').addClass('is-invalid');

                $('#hintpass2').removeClass('text-muted');
                $('#hintpass2').removeClass('text-success');
                $('#hintpass2').addClass('text-danger');
        
                $('#hintpass2').text("*harus memiliki angka, huruf besar, dan huruf kecil."); 
            }    

                      
        }
    });

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

    $('#tg_pwd2').click(function(){
       
        if($(this).hasClass('fa-eye-slash'))
        {           
          $(this).removeClass('fa-eye-slash');
          
          $(this).addClass('fa-eye');
          
          $('#pass2').attr('type','text');
            
        }
        else
        {         
          $(this).removeClass('fa-eye');
          
          $(this).addClass('fa-eye-slash');  
          
          $('#pass2').attr('type','password');
        }
    });

    $('#btnDaftar').click(function(e){
        
        var nama = $("#nama").hasClass("is-valid");
        var username = $("#username").hasClass("is-valid");
        var akses = $("#akses").hasClass("is-valid");
        var pass1 = $("#pass1").hasClass("is-valid");
        var pass2 = $("#pass2").hasClass("is-valid");

        if(nama && username && akses && pass1 && pass2)
        {
            return true;
        }
        else if(nama || username || akses || pass1 || pass2)
        {
            e.preventDefault();
        }
        else
        {
            e.preventDefault();

            $('#nama').addClass('is-invalid');
            $('#hintnama').addClass('text-danger');
            $('#hintnama').text("nama tidak boleh kosong");

            $('#username').addClass('is-invalid');
            $('#hintusername').addClass('text-danger');
            $('#hintusername').text("username tidak boleh kosong");

            $('#akses').addClass('is-invalid');
            $('#hintakses').addClass('text-danger');
            $('#hintakses').text("akses belum dipilih");

            $('#pass1').addClass('is-invalid');
            $('#hintpass1').addClass('text-danger');
            $('#hintpass1').text("password tidak boleh kosong");

            $('#pass2').addClass('is-invalid');
            $('#hintpass2').addClass('text-danger');
            $('#hintpass2').text("password konfirmasi tidak boleh kosong");

        }
    });

    
  
  });