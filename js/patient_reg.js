// form submission with ajax [register 1st page]
$('#patientReg').on('submit', function() {
    var first = $('#first_name').val();
    var last = $('#last_name').val();
    var address = $('#address').val();
    var city = $('#city').val();
    var phone = $('#phone_number').val();
    var email = $('#email').val();
    var level = 'patient';
    var password = $('#password').val();
    var confirmPassword = $('#confirmpassword').val();
    $.ajax({
      url: "../controller/registerController.php",
      method: "POST",
      data: {
        savePatient: "savePatient",
        first_name: first,
        last_name: last,
        address: address,
        city: city,
        phone_number: phone,
        email: email,
        level: level,
        password: password,
        confirmpassword: confirmPassword
      },
      dataType: "json",
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
                }else if(data.state=='sucess'){
                    console.log("successfully created")
                    window.location='../views/login.php';
                }
            
            }
        });
        return false;
    });
  