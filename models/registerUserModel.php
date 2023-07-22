<?php

class registerUserModel
{
    // patient registration 
    public static function patientReg($email, $first_name, $last_name, $address, $city, $phone_number, $password, $connection)
    {
        $query = "INSERT INTO patient (email,first_name,last_name,address,city,phone_number,password,type,user_accepted) VALUES('{$email}','{$first_name}','{$last_name}','{$address}','{$city}','{$phone_number}','{$password}','patient',1)";
        $result_set = mysqli_query($connection, $query);
        
        if (!$result_set) {
            $error_message = mysqli_error($connection);
            throw new Exception("Query execution failed: " . $error_message);
        }
        
        return $result_set;
    }

    // doctor registration 
    public static function doctorReg($email, $first_name, $last_name, $address, $city, $phone_number, $password, $specialization, $license, $diploma, $connection)
    {
        $query = "INSERT INTO doctor (email,first_name,last_name,address,city,phone_number,password,type,specialization,license,diploma) VALUES('{$email}','{$first_name}','{$last_name}','{$address}','{$city}','{$phone_number}','{$password}','doctor','{$specialization}','{$license}','{$diploma}')";
        $result_set = mysqli_query($connection, $query);
        
        if (!$result_set) {
            $error_message = mysqli_error($connection);
            throw new Exception("Query execution failed: " . $error_message);
        }
        
        return $result_set;
    }
    // check the email email already used
    public static function checkUser($email, $connection)
    {
        $query = "SELECT email FROM patient  WHERE email='{$email}'
         UNION SELECT email FROM doctor  WHERE email='{$email}'
         UNION SELECT email FROM admin  WHERE email='{$email}' LIMIT 1";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }

    // user login
    public static function loging($email, $password, $connection)
    {
        $query = "SELECT type,email,first_name,last_name,address,phone_number FROM  patient WHERE email='$email' AND password='$password' AND user_accepted=1
        UNION SELECT type,email,first_name,last_name,address,phone_number FROM  doctor WHERE email='$email' AND password='$password' AND user_accepted=1
        UNION SELECT type,email,first_name,last_name,address,phone_number FROM admin  WHERE email='$email' AND password='$password'  AND user_accepted=1
        LIMIT 1 ";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }
    public static function getUserByEmail($email, $connection) {
        $email = mysqli_real_escape_string($connection, $email);
    
        // Dotaz pro tabulku patient
        $queryPatient = "SELECT * FROM patient WHERE email = '$email'";
        $resultPatient = mysqli_query($connection, $queryPatient);
        
        if ($resultPatient && mysqli_num_rows($resultPatient) == 1) {
            return $resultPatient;
        }
        
        // Dotaz pro tabulku doctor
        $queryDoctor = "SELECT * FROM doctor WHERE email = '$email'";
        $resultDoctor = mysqli_query($connection, $queryDoctor);
        
        if ($resultDoctor && mysqli_num_rows($resultDoctor) == 1) {
            return $resultDoctor;
        }
        
        // Dotaz pro tabulku admin
        $queryAdmin = "SELECT * FROM admin WHERE email = '$email'";
        $resultAdmin = mysqli_query($connection, $queryAdmin);
        
        if ($resultAdmin && mysqli_num_rows($resultAdmin) == 1) {
            return $resultAdmin;
        }
        
        return false;
    }

    

    //  get the id 
    public static function getId($type, $email,$connection)
    {
      $query="SELECT * FROM $type WHERE email='{$email}'";
      $result_set=mysqli_query($connection,$query);
      return  $result_set;
    }

}


?>