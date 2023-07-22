<?php
require_once('../includes/database.php');
require_once('../../models/registerUserModel.php');

session_start();
?>
<?php

// form validation register 
if (isset($_POST['submit'])) {
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $city = mysqli_real_escape_string($connection, $_POST['city']);
        $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $level = mysqli_real_escape_string($connection, $_POST['level']);
        $errors['eFirst'] = '';
        $errors['eLast'] = '';
        $errors['eAddress'] = '';
        $errors['eCity'] = '';
        $errors['ePhone'] = '';
        $errors['eEmail'] = '';
        $errors['state'] = 'unsucess';
        if (!isset($first_name) || strlen(trim($first_name)) < 1) //check if the username and password has been entered
        {
                $errors['eFirst'] = '*Jméno je povinné pole';
        } elseif (!preg_match(("/^[\p{L}\'\-\s]+$/u"), $first_name)) { // preg_match -> check regular expression
                $errors['eFirst'] = '*Neplatné křestní jméno';
        }
        if (!isset($last_name) || strlen(trim($last_name)) < 1) {
                $errors['eLast'] = '*Příjmení je povinné pole';
        } elseif (!preg_match(("/^[\p{L}\'\-\s]+$/u"), $last_name)) { // preg_match -> check regular expression
                $errors['eLast'] = '*Neplatné příjmení';
        }

        if (!isset($address) || strlen(trim($address)) < 1) {
                $errors['eAddress'] = '*Adresa je povinné pole';
        }

        if (!isset($city) || strlen(trim($city)) < 1) {
                $errors['eCity'] = '*Město je povinné pole';
        }
        // elseif (!preg_match(("/^([a-zA-Z']+)$/"), $address)) { // preg_match -> check regular expression
        //         $errors['eAddress'] = '*Invalid Address ';
        // }

        if (!isset($phone_number) || strlen(trim($phone_number)) < 1) {
                $errors['ePhone'] = '*Číslo je povinné pole';
        } else {
                if (strlen(trim($phone_number)) == 12 || (strlen(trim($phone_number)) == 10)) {
                        //         $result=registerUserModel::checkNic($nic,$connection);
                        //         if($result->num_rows)
                        //         {
                        //                 $errors['eNic']="NIC already used";
                        //         }
                        //         if(strlen(trim($nic))==10)
                        //         {
                        //                 $intPart=substr($nic,0,8);
                        //                 if(!is_numeric($intPart))
                        //                 {
                        //                         $errors['eNic']="*NIC number is invalid";
                        //                 }
                        //         }
                        //        elseif(strlen(trim($nic))==12)
                        //        {
                        //                 $intPart=substr($nic,0,11);
                        //                 if(!is_numeric($intPart))
                        //                 {
                        //                         $errors['eNic']="*NIC number is invalid";
                        //                 }  
                        //        }
                } else {
                        //   $errors['eNic']="*NIC number is invalid";
                }
        }


        if (!isset($email) || strlen(trim($email)) < 1) {
                $errors['eEmail'] = '*Emailová adresa je povinná';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['eEmail'] = '*Neplatná emailová adresa ';
        }
        // finally check email is already used     
        else {
                $user_email = registerUserModel::checkUser($email, $connection);
                $email_arr = mysqli_fetch_assoc($user_email);
                if (!empty($email_arr)) {
                        $errors['eEmail'] = '*Email, který jste zadali už je používán.';
                }
        }
        
        if ($errors['eFirst'] == "" && $errors['eLast'] == "" && $errors['ePhone'] == "" && $errors['eEmail'] == "" && $errors['eAddress'] == "" && $errors['eCity'] == ""  ){
                $errors['state'] = 'sucess';
                $errors['first_name'] = $first_name;
                $errors['last_name'] = $last_name;
                $errors['phone_number'] = $phone_number;
                $errors['email'] = $email;
                $errors['address'] = $address;
                $errors['city'] = $city;
                $errors['level'] = $level;
        }

        echo json_encode($errors);
}


if (isset($_POST['savePatient'])) {
        try {
         $errors = array();
        $errors['pass'] = '';
        $errors['state'] = 'unsucess';
        $email = mysqli_real_escape_string($connection, $_POST['email']);
        $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
        $address = mysqli_real_escape_string($connection, $_POST['address']);
        $city = mysqli_real_escape_string($connection, $_POST['city']);
        $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
        $level = 'patient';
        $password = mysqli_real_escape_string($connection, $_POST['password']);
        $confirmPassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
        if (empty($password || $confirmPassword)) // validation of new password
        {
                $errors['pass'] = "*Heslo je povinné";
        } elseif ((strlen(trim($password)) < 8)) {
                $errors['pass'] = "*Heslo musí mít minimálně 8 znaků";
        } elseif ($password != $confirmPassword) {
                $errors['pass'] = "*Heslo se neshoduje";
        } elseif (!preg_match('/[A-Z]/', $password)) {
                $errors['pass'] = "*Heslo musí obsahovat alespoň 1 velké písmeno";
        } elseif (!preg_match('/[a-z]/', $password)) {
                $errors['pass'] = "*Heslo musí obsahovat alespoň 1 malé písmeno";
        } elseif (!preg_match('/[0-9]/', $password)) {
                $errors['pass'] = "*Heslo musí obsahovat alespoň 1 číslo";
        }
        if ($errors['pass'] == "") {
                $token = bin2hex(random_bytes(50));
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $result = registerUserModel::patientReg($email, $first_name, $last_name, $address, $city, $phone_number, $hash, $connection);
               
                $errors['state'] = 'sucess';

                        if ($result) {
                                echo '<script>alert("Úspěšně jste se zaregistrovali!")</script>';
                                header('Location:../views/register-success-patient.php');
                        } else {
                                header('Location:../views/patient-registration.php?email=' . $email . '&first_name=' . $first_name . '&last_name=' . $last_name . '&address=' . $address . '&phone_number=' . $phone_number . '&city=' . $city  . '&errPass=' . $errors["pass"]);
                        }
                } else {
                        header('Location:../views/patient-registration.php?email=' . $email . '&first_name=' . $first_name . '&last_name=' . $last_name . '&address=' . $address . '&phone_number=' . $phone_number . '&city=' . $city . '&errPass=' . $errors["pass"]);
                }
        } catch (Exception $e) {
                // Display the error message
                echo 'Error: ' . $e->getMessage();
                }
        }
// doctor registration
if (isset($_POST['saveDoctor'])) {

        try {
                $errors = array();
                $errors['specialization'] = '';
               // $errors['city'] = '';
                $errors['license'] = '';
                $errors['diploma'] = '';
                $errors['pass'] = '';
                $errors['state'] = 'unsucess';
                $email = mysqli_real_escape_string($connection, $_POST['email']);
                $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
                $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
                $address = mysqli_real_escape_string($connection, $_POST['address']);
                $city = mysqli_real_escape_string($connection, $_POST['city']);
                $phone_number = mysqli_real_escape_string($connection, $_POST['phone_number']);
                $password = mysqli_real_escape_string($connection, $_POST['password']);
                $confirmPassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
                $specialization = mysqli_real_escape_string($connection, $_POST['specialization']);
                $license = mysqli_real_escape_string($connection, $_POST['license']);
                $level = 'doctor';
                $certificate = $_FILES['certificate'];
                $certificate_name = $certificate['name'];
                $certificate_tmp_name = $certificate['tmp_name'];


                $target_directory = '/doctorNow/images/uploads/'; 
                $target_file = $_SERVER['DOCUMENT_ROOT'] . $target_directory . $email . '-' . $certificate_name;
                move_uploaded_file($certificate_tmp_name, $target_file);


                if (!isset($specialization) || strlen(trim($specialization)) < 1) {
                        $errors['specialization'] = '*Specializace je povinná';
                }

                // if (!isset($city) || strlen(trim($city)) < 1) {
                //         $errors['city'] = '*city required';
                // }

                if (!isset($license) || strlen(trim($license)) < 1) {
                        $errors['license'] = '*Číslo licence je povinné';
                }

                if (!isset($target_file) || strlen(trim($target_file)) < 1) {
                        $errors['diploma'] = '*Diplom je povinný';
                }

                if (empty($password || $confirmPassword)) // validation of new password
                {
                        $errors['pass'] = "*Heslo je povinné";
                } elseif ((strlen(trim($password)) < 8)) {
                        $errors['pass'] = "*Heslo musí mít minimálně 8 znaků";
                } elseif ($password != $confirmPassword) {
                        $errors['pass'] = "*Heslo se neshoduje";
                } elseif (!preg_match('/[A-Z]/', $password)) {
                        $errors['pass'] = "*Heslo musí obsahovat alespoň 1 velké písmeno";
                } elseif (!preg_match('/[a-z]/', $password)) {
                        $errors['pass'] = "*Heslo musí obsahovat alespoň 1 malé písmeno*";
                } elseif (!preg_match('/[0-9]/', $password)) {
                        $errors['pass'] = "*Heslo musí obsahovat alespoň 1 číslo*";
                }

                if ($errors['specialization'] == "" && $errors['license'] == "" && $errors['pass'] == "") {
                        $token = bin2hex(random_bytes(50));
                        $hash = password_hash($password, PASSWORD_DEFAULT);
                        $result = registerUserModel::doctorReg($email, $first_name, $last_name, $address, $city, $phone_number, $hash, $specialization, $license, $target_file, $connection);
                        $errors['state'] = 'sucess';

                        if ($result) {
                                echo '<script>alert("Úspěšně jste se zaregistrovali!")</script>';
                                header('Location:../views/register-success-doctor.php');
                        } else {
                                header('Location:../views/doctor-registration.php?email=' . $email . '&first_name=' . $first_name . '&last_name=' . $last_name . '&address=' . $address . '&city=' . $city . '&phone_number=' . $phone_number . '&errSpecialization=' . $errors["specialization"] . '&errLicense=' . $errors["license"] . '&errPass=' . $errors["pass"]);
                        }
                } else {
                        header('Location:../views/doctor-registration.php?email=' . $email . '&first_name=' . $first_name . '&last_name=' . $last_name . '&address=' . $address  . '&city=' . $city . '&phone_number=' . $phone_number . '&errSpecialization=' . $errors["specialization"] . '&errLicense=' . $errors["license"] . '&errPass=' . $errors["pass"]);
                }
        } catch (Exception $e) {
                // Display the error message
                echo 'Error: ' . $e->getMessage();
        }




        // echo json_encode($errors);
}

?>