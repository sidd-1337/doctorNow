<?php

require_once('../includes/database.php');
// require_once('../../models/appointmentModel.php');
require_once('../../models/adminModel.php');


session_start();
?>

<?php
// doctor details
function doctorDetaila($connection)
{
    $data = array();
    $result = searchModel::Alldoctors($connection);
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    return $data;
}



?>