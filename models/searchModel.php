<?php

class searchModel
{

    //get all active doctors
    public static function Alldoctors($connection){
        $query="SELECT * FROM doctor WHERE user_accepted=1";
        $result=mysqli_query($connection,$query);
        return $result;
    }

    
}


?>