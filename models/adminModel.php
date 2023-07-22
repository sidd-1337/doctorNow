<?php

class adminModel
{

      // get all user details separetely
    //   public static function userDetails($level,$connection){
    //     $query="SELECT * FROM $level";
    //     $result=mysqli_query($connection,$query);
    //     return $result;
    // }

    //get active all users
    public static function userDetails($type,$id,$connection){
        $query="SELECT * FROM $type WHERE user_accepted=$id";
        $result=mysqli_query($connection,$query);
        return $result;
    }

      ////admin accept or deny the doctor registration request (become user_accepted=1 or 2)
   public static function confirmOrDenyDoctorRegistration($request_id,$accept,$connection)
   {
       $query="UPDATE 
       doctor 
       SET  
       user_accepted=$accept
       WHERE 
       doctor_id='{$request_id}'";

       $result=mysqli_query($connection,$query);
       return $result;
   }

}


?>