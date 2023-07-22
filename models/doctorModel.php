<?php

class doctorModel
{

    // get doctor details
    public static function getADoctorDetails($email, $connection)
    {
        $query = "SELECT * FROM doctor  WHERE email='{$email}' LIMIT 1";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }

    // get patient details using his id
    public static function getAPatientDetailsUsingId($patient_id, $connection)
    {
        $query = "SELECT * FROM patient  WHERE patient_id='{$patient_id}' LIMIT 1";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }

    // get doctor details using his id
    public static function getADoctorDetailsUsingId($doctor_id, $connection)
    {
        $query = "SELECT * FROM doctor  WHERE doctor_id='{$doctor_id}' LIMIT 1";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }

    //add Available Date For Doctor
    public static function addAvailableDateForDoctor($doctor_id, $available_date, $available_time, $connection)
    {
        $query = "INSERT INTO available_dates (doctor_id,available_date,available_time) VALUES('{$doctor_id}','{$available_date}','{$available_time}')";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }

    // get doctor available dates  using his id
    public static function getADoctorAvailableDates($doctor_id, $connection)
    {
        $query = "SELECT * FROM available_dates  WHERE doctor_id='{$doctor_id}' ORDER BY available_date, available_time";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }

    //delete doctor available dates
    public static function deleteDoctorAvailableDates($dates_id, $doctor_id, $connection)
    {
        $query = "DELETE FROM `available_dates` WHERE doctor_id='{$doctor_id}' AND dates_id='{$dates_id}'";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }

    // filter doctor available dates
    public static function filterDoctorAvailableDates($doctor_id, $available_date, $connection)
    {
        $data = array();
        $query = "SELECT * FROM `available_dates` WHERE  doctor_id=$doctor_id AND available_date='{$available_date}'";
        $result_set = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result_set)) {
            $data[] = $row;
        }
        return $data;
    }

    //update patient profile

    public static function updatePatientProfile($patient_id, $first_name, $last_name, $phone_number, $address, $city, $connection)
    {
        $query = "UPDATE 
       patient 
       SET  
       first_name='{$first_name}',
       last_name='{$last_name}',
       phone_number='{$phone_number}',
       address='{$address}',
       city='{$city}'
       WHERE 
       patient_id='{$patient_id}'";

        $result = mysqli_query($connection, $query);
        return $result;
    }

    //update doctor profile
    public static function updateDoctorProfile($doctor_id, $first_name, $last_name, $phone_number, $specialization, $address, $city, $connection)
    {
        $query = "UPDATE 
             doctor 
             SET  
             first_name='{$first_name}',
             last_name='{$last_name}',
             phone_number='{$phone_number}',
             specialization='{$specialization}',
             address='{$address}',
             city='{$city}'
             WHERE 
             doctor_id='{$doctor_id}'";

        $result = mysqli_query($connection, $query);
        return $result;
    }

    //update doctor available time slot
    public static function updateDoctorAvailableTime($doctor_id, $available_time, $available_date, $connection)
    {
        $query = "UPDATE `available_dates` SET is_booking=0 WHERE doctor_id='{$doctor_id}' AND available_time='{$available_time}' AND available_date='{$available_date}'";
        $result_set = mysqli_query($connection, $query);
        return $result_set;
    }


}


?>