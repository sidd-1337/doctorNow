<?php

function sentDoctorRegApproveRequest($email, $doctor_name)
{

    $subject = "DoctorNow/Lékař-Ihned";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from = "companychannelcare@gmail.com";
    // Create email headers
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $message = '
        
<html lang="cs">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	
    <style>
		*{
			padding: 0;
			margin: 0;
			font-family: "Poppins",sans-serif;
        }
        body{
            background-color: #8EE48f;
        }
    .container{
        width: 70%;
        margin: 0 auto;
        background-color:#5cdb95;
    }

    

     
  


.header{
    padding: 30px;
}
.wrapper{
    background-color: #379683;
}
.header h2{
    color: white;
}

.header h3{
    text-align: center;
    font-size: 32px;
    border-bottom: 2px solid black;

}
.content{
    padding:0 100px ;
    text-align: center;
    margin: 0 auto;
}
p{
    margin: 0 auto;
}
.footer{
    background-color: black;
    color: white;
    text-align: center;
    padding: 20px 0;
    margin: 0 auto;
   
}




	</style>
</head>
<body>
<div class="container">
<div class="wrapper">
<div class="header">
    <h2>Doctor-Now </h2>
    <h4>Hi ' . $doctor_name . '</h4>
    <h3>Your Registration request has been accepted </h3>
</div>
</div>
<div class="content">
   <div class="para"> <p>.
     <h4><b style="color: red">Congralulations!!</b>Your Registration request has been accepted. Now you can use the Doctor-Now web site.</h4></p></div>
  

    
<div class="footer">
<h4>Doctor-Now @2023 all right received </h4>
</div>
</div>

    <div class="container">
        <div class="wrapper">
        <div class="header">
            <h2>Lékař-Ihned</h2>
            <h4>Dobrý den Paní/Pane' . $doctor_name . '</h4>
            <h3>Vaše registrace byla schválená</h3>
        </div>
        </div>
        <div class="content">
           <div class="para">
                <p>Gratulujeme!</b>Vaše registrace byla schválená. Nyní můžete začít využívat naších služeb.</p>
                <br>
                <p>Děkujeme, že jste si zvolili Lékař-Ihned pro online objednávní k lékaři.</p>
            </div>
        <div class="footer">
        <h4>Lékař-Ihned @2023 Všechna práva vyhrazena</h4>
    </div>
    </div>
    
</body>
</html>';

    $result_mail = mail($email, $subject, $message, $headers);
    if ($result_mail) {
        echo "Email byl úspěšně odeslán<br/>";
    } else {
        echo "Email nebyl odeslán<br/>";
    }
}



function sentDoctorRegRejectedRequest($email, $doctor_name)
{

    $subject = "DoctorNow/Lékař-Ihned";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from = "companychannelcare@gmail.com";
    // Create email headers
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $message = '

<html lang="cs">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">

    <style>
    *{
      padding: 0;
      margin: 0;
      font-family: "Poppins",sans-serif;
        }
        body{
            background-color: #8EE48f;
        }
    .container{
        width: 70%;
        margin: 0 auto;
        background-color:#5cdb95;
    }







.header{
    padding: 30px;
}
.wrapper{
    background-color: #db5c60;
}
.header h2{
    color: white;
}

.header h3{
    text-align: center;
    font-size: 32px;
    border-bottom: 2px solid black;

}
.content{
    padding:0 100px ;
    text-align: center;
    margin: 0 auto;
}
p{
    margin: 0 auto;
}
.footer{
    background-color: black;
    color: white;
    text-align: center;
    margin-left:0;
    margin-right:0;
    margin-bottom:0;
    padding: 20px 0;


}

  </style>
</head>
<body>
<div class="container">
<div class="wrapper">
<div class="header">
    <h2>Doctor-Now </h2>
    <h4>Hi ' . $doctor_name . '</h4>
    <h3>Your Registration Request has been Rejected </h3>
</div>
</div>
<div class="content">
   <div class="para"> <p> Your Reqgistration Request has been Rejected. There is some issue with your send documents. Thanks! </p></div>

<div class="footer">
<h4>Doctor-Now @2023 all right received </h4>
</div>
</div>
    <div class="container">
        <div class="wrapper">
        <div class="header">
            <h2>Lékař-Ihned </h2>
            <h4>Dobrý den Paní/Pane' . $doctor_name . '</h4>
            <h3>Vaše registrace byla odmítnutá</h3>
        </div>
        </div>
        <div class="content">
           <div class="para"> 
                <p>Vaše registrace byla odmítnutá. Jsou zde problémy s vašími dokumenty, prosím, zkuste registraci znova.</p>
                <br>
                <p>Děkujeme, že jste si zvolili Lékař-Ihned pro online objednávní k lékaři.</p>
           </div>
        <div class="footer">
        <h4>Lékař-Ihned @2023 Všechna práva vyhrazena</h4>
        </div>
    </div>

</body>
</html>';

    mail($email, $subject, $message, $headers);
}

//approve appointment
function sentAppointmentApproveRequest($email,$name,$appointment_date,$remark)
{

    $subject = "DoctorNow/Lékař-Ihned";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from = "companychannelcare@gmail.com";
    // Create email headers
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $message = '
        
<html lang="cs">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	
    <style>
		*{
			padding: 0;
			margin: 0;
			font-family: "Poppins",sans-serif;
        }
        body{
            background-color: #8EE48f;
        }
    .container{
        width: 70%;
        margin: 0 auto;
        background-color:#5cdb95;
    }

    

     
  


.header{
    padding: 30px;
}
.wrapper{
    background-color: #379683;
}
.header h2{
    color: white;
}

.header h3{
    text-align: center;
    font-size: 32px;
    border-bottom: 2px solid black;

}
.content{
    padding:0 100px ;
    text-align: center;
    margin: 0 auto;
}
p{
    margin: 0 auto;
}
.footer{
    background-color: black;
    color: white;
    text-align: center;
    padding: 20px 0;
    margin: 0 auto;
   
}




	</style>
</head>
<body>
<div class="container">
<div class="wrapper">
<div class="header">
    <h2>Doctor-Now </h2>
    <h4>Hi ' . $name . '</h4>
    <h3>Your Appointment request has been accepted </h3>
</div>
</div>
<div class="content">
   <div class="para"> <p>.
     <h4><b style="color: red">Congralulations!!</b>Your Appointment request has been accepted. Your appointment time is ' .$appointment_date. '. more details '.$remark.' . Thank you!</h4></p></div>
  

    
<div class="footer">
<h4>Doctor-Now @2023 all right received </h4>
</div>
</div>


    <div class="container">
        <div class="wrapper">
        <div class="header">
            <h2>Lékař-Ihned </h2>
            <h4>Dobrý den Paní/Pane ' . $name . '</h4>
            <h3>Vaše návštěva byla schválena</h3>
        </div>
        </div>
        <div class="content">
           <div class="para"> 
                <p>Gratulujeme!</b>Vaše návštěva byla schválena.
                Čas vaší návštěvy je ' .$appointment_date. '. Informace od lékaře: '.$remark.' .</p>
                <br>
                <p>Děkujeme, že jste si zvolili Lékař-Ihned pro online objednávní k lékaři.</p>
            </div>
        <div class="footer">
        <h4>Lékař-Ihned @2023 Všechna práva vyhrazena</h4>
    </div>
    </div>
    
</body>
</html>';

    $result_mail=mail($email, $subject, $message, $headers);
    if ($result_mail) {
      echo "Email byl úspěšně odeslán<br/>";
    }else {
        echo "Email nebyl odeslán<br/>";
    }
}

//reject appointment
function sentAppointmentRejectedRequest($email, $name,$remark)
{

    $subject = "DoctorNow/Lékař-Ihned";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from = "companychannelcare@gmail.com";
    // Create email headers
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $message = '
<html lang="cs">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">

    <style>
    *{
      padding: 0;
      margin: 0;
      font-family: "Poppins",sans-serif;
        }
        body{
            background-color: #8EE48f;
        }
    .container{
        width: 70%;
        margin: 0 auto;
        background-color:#5cdb95;
    }
    .header{
    padding: 30px;
    }
    .wrapper{
        background-color: #db5c60;
    }
    .header h2{
        color: white;
    }

    .header h3{
        text-align: center;
        font-size: 32px;
        border-bottom: 2px solid black;

    }
    .content{
        padding:0 100px ;
        text-align: center;
        margin: 0 auto;
    }
    p{
        margin: 0 auto;
    }
    .footer{
        background-color: black;
        color: white;
        text-align: center;
        margin-left:0;
        margin-right:0;
        margin-bottom:0;
        padding: 20px 0;


    }

    </style>
</head>
<body>

<div class="container">
<div class="wrapper">
<div class="header">
    <h2>Doctor-Now </h2>
    <h4>Hi ' . $name . '</h4>
    <h3>Your Appointment Request has been Rejected </h3>
</div>
</div>
<div class="content">
   <div class="para"> <p> Your Appointment Request has been Rejected. more.. '.$remark.'Thanks! </p></div>

<div class="footer">
<h4>Doctor-Now @2023 all right received </h4>
</div>
</div>

    <div class="container">
        <div class="wrapper">
        <div class="header">
            <h2>Lékař-Ihned </h2>
            <h4>Dobrý den Paní/Pane ' . $name . '</h4>
            <h3>Vaše návštěva byla zamítnuta</h3>
        </div>
        </div>
        <div class="content">
            <div class="para"> 
            <p>Vaše návštěva byla zamítnuta. Informace od lékaře: '.$remark.' .</p>
            <br>
            <p>Děkujeme, že jste si zvolili Lékař-Ihned pro online objednávní k lékaři.</p>
        </div>
        <div class="footer">
        <h4>Lékař-Ihned @2023 Všechna práva vyhrazena</h4>
        </div>
    </div>

</body>
</html>';

$result=mail($email, $subject, $message, $headers);

    if ($result) {
       echo 'Email byl úspěšně odeslán';
    }else {
        echo 'Email nebyl odeslán';
    }
}


//approve appointment
function sentAppointmentNotificationRequest($email,$name,$appointment_date,$doctor_name)
{
        
    $subject = "DoctorNow/Lékař-Ihned";
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $from = "companychannelcare@gmail.com";
    // Create email headers
    $headers .= 'From: ' . $from . "\r\n" .
        'Reply-To: ' . $from . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    $message = '<!DOCTYPE html>
    <html lang="cs">
    
    <head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	
    <style>
		*{
			padding: 0;
			margin: 0;
			font-family: "Poppins",sans-serif;
        }
        body{
            background-color: #8EE48f;
        }
        .container{
            width: 70%;
            margin: 0 auto;
            background-color:#5cdb95;
        }
        .header{
        padding: 30px;
        }
        .wrapper{
            background-color: #379683;
        }
        .header h2{
            color: white;
        }

        .header h3{
            text-align: center;
            font-size: 32px;
            border-bottom: 2px solid black;

        }
        .content{
            padding:0 100px ;
            text-align: center;
            margin: 0 auto;
        }
        p{
            margin: 0 auto;
        }
        .footer{
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin: 0 auto;
        
        }
        </style>
</head>
    
    <body>
      <div class="container">
        <div class="header">
          <h1>Lékař-Ihned - Připomínka o nadcházející návštěvě</h1>
          <p></p>
        </div>
        <br/><br/>
        Dobrý den Paní/Pane '.$name.',<br/>
        <br/>
        <div>
        vaše návštěva u zvoleného lékaře bude za 9 hodin.<br/><br/>
        Detail návštěvy: <br/>
        Datum: '.$appointment_date.'<br/>
        Lékař: '.$doctor_name.'<br/>
        <br/>
        Prosíme, abyste se dostavil ve stanovaný čas pro urychlení celého procesu.<br/>
        <br/>
        <p>Děkujeme, že jste si zvolili Lékař-Ihned pro online objednávní k lékaři.</p>
    <br/>
    <br/>
    <br/>
        
        <br/><br/><br/>
        <div class="footer">
          <p class="footertext">Lékař-Ihned @2023 Všechna práva vyhrazena</p>
        </div>
      </div>
    </body>
    
    </html>';

    $result_mail=mail($email, $subject, $message, $headers);
    if ($result_mail) {
      echo "Email byl úspěšně odeslán<br/>";
    }else {
        echo "Email nebyl odeslán<br/>";
    }
}

?>