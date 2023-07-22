    // form submission with ajax [register 1st page]
    $('#doctorReg').on('submit',function(){
        var first=$('#first_name').val();
        var last=$('#last_name').val();
        var address=$('#address').val();
        var city=$('#city').val();
        var phone=$('#phone_number').val();
        var email=$('#email').val();
        var level ='doctor';
        var password=$('#password').val();
        var confirmpassword=$('#confirmpassword').val();
        var specialization=$('#specialization').val();
        console.log();
        var license=$('#license').val();
        var diploma=$('#diploma').val();
        $.ajax({
            url:"../controller/registerController.php",
            method:"POST",
            data:{saveDoctor:"saveDoctor",first_name:first,last_name:last,address:address,city:city,phone_number:phone,email:email,level:level,password:password,confirmpassword:confirmpassword ,specialization: specialization,license:license,diploma:diploma},
            dataType:"json",
            success:function(data)
            {
                console.log(data);
                if(data.state=='unsucess'){
                    if(data.pass!=""){
                        $('#passError').html(data.pass);
                        $('#password').css("background-color", "rgb(255, 224, 224)");
                        $('#confirmpassword').css("background-color", "rgb(255, 224, 224)");
                    }else{
                        $('#passError').html('');
                        $('#password').css("background-color", "#b8bcc4");
                        $('#confirmpassword').css("background-color", "#b8bcc4");
                    }

                    if(data.specialization!=""){
                        $('#specError').html(data.specialization);
                        $('#specialization').css("background-color", "rgb(255, 224, 224)");
                    }else{
                        $('#specError').html("");
                        $('#specialization').css("background-color", "#b8bcc4");            
                    }

                    if(data.license!=""){
                        $('#licenseError').html(data.license);
                        $('#license').css("background-color", "rgb(255, 224, 224)");
                    }else{
                        $('#licenseError').html('');
                        $('#license').css("background-color", "#b8bcc4");             
                    }

                    if(data.diploma!=""){
                        $('#diplomaError').html(data.diploma);
                        $('#diploma').css("background-color", "rgb(255, 224, 224)");
                    }else{
                        $('#diplomaError').html('');
                        $('#diploma').css("background-color", "#b8bcc4");             
                    }

                }else if(data.state=='sucess'){
                    console.log("successfully created")
                    window.location='../views/login.php';
                }
            
            }
        });
        return false;
    });

