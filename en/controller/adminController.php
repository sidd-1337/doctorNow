<?php

require_once('../includes/database.php');
require_once('../includes/email.php');
require_once('../../models/appointmentModel.php');
require_once('../../models/adminModel.php');


session_start();
?>

<?php

// admin student page details
function userDetails($connection, $type, $id)
{
  $data = array();
  $result = adminModel::userDetails($type, $id, $connection);
  while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
  }

  return $data;
}

//doctor registration accept by admin
if (isset($_GET['doctorRequestAccept_id'])) {
  $request_id = $_GET['doctorRequestAccept_id'];
  $email = $_GET['doctor_email'];
  $doctor_name = $_GET['doctor_name'];

  $result = adminModel::confirmOrDenyDoctorRegistration($request_id, 1, $connection);
  if ($result) {

    sentDoctorRegApproveRequest($email, $doctor_name);
    header('Location:../views/all-doctors.php');
  }

}

//doctor registration deny by admin
if (isset($_GET['doctorRequestCancel_id'])) {
  $request_id = $_GET['doctorRequestCancel_id'];
  $email = $_GET['doctor_email'];
  $doctor_name = $_GET['doctor_name'];

  $result = adminModel::confirmOrDenyDoctorRegistration($request_id, 2, $connection);
  if ($result) {
    sentDoctorRegRejectedRequest($email, $doctor_name);
    header('Location:../views/doctor-registration-deny.php');
  }

}


?>