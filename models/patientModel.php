<?php

class patientModel
{
  
    // get patient details
    public static function getAPatientDetails($email, $connection)
    {
        $query = "SELECT * FROM patient  WHERE email='{$email}' LIMIT 1";
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
}


?>