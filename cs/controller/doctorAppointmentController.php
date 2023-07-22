<?php

require_once('../includes/database.php');
require_once('../../models/appointmentModel.php');
require_once('../../models/doctorModel.php');
require_once('../includes/email.php');


session_start();
?>

<?php


//get appointement details (filter by appointment status)
function getAppointmentCount($connection, $status, $doctor_id)
{
  $result = appointmentModel::getCountOfAppointment($status, $doctor_id, $connection);
  return $result;
}

//retrieve doctor all appointments
function getDoctorAllAppointment($connection, $doctor_id)
{
  $result = appointmentModel::getDoctorAllAppointment($doctor_id, $connection);
  return $result;
}

//retrieve  a specific appointment
function getSpecificAppointment($connection, $appointment_id)
{
  $result = appointmentModel::getSpecificAppointment($appointment_id, $connection);
  return $result;
}

function getADoctorDetails($connection, $email)
{
  $result = doctorModel::getADoctorDetails($email, $connection);
  return $result;
}

function getAPatientDetailsUsingId($connection, $patient_id)
{
  $result = doctorModel::getAPatientDetailsUsingId($patient_id, $connection);
  return $result;
}

//update status a specific appointment by doctor
if (isset($_POST['submit_action'])) {

  echo '<br/>' . $status = $_POST['status'];
  echo '<br/>' . $remark = $_POST['remark'];
  echo '<br/>' . $appointment_id = $_POST['appointment_id'];
  echo '<br/>' . $doctor_id = $_POST['doctor_id'];
  echo '<br/>' . $appointment_date = $_POST['appointment_date'];
  echo '<br/>' . $appointment_time = $_POST['appointment_time'];
  echo '<br/>' . $full_name = $_POST['full_name'];
  echo '<br/>' . $p_email = $_POST['p_email'];
  echo '<br/>' . $phone = $_POST['phone'];

  $originalTimeZone = new DateTimeZone('Europe/Amsterdam');

  $result = '';

  if ($status == 1) {



    //combine appointement date & appointment time as choose_appointment_date
    $dateTimeString = $appointment_date . '' . $appointment_time;
    $dateTime = new DateTime($dateTimeString);
    //  echo  $dateTime_approve.'<br/>';
    $combineDateTime = $dateTime->format('Y-m-d H:i:s'); //we can use as a choose_appointment_date


    //reduce 9 hours for send notification
    $dateTime_sub = new DateTime($combineDateTime);

    $interval = new DateInterval('PT9H'); // Duration to subtract (9 hours)
    $dateTime_sub->sub($interval);

    $notification_time = $dateTime_sub->format('Y-m-d H:i:s');
    echo '<br/>' . $notification_time;


    $originalTimeZone = new DateTimeZone('Europe/Amsterdam');
    // // Create a DateTime object with the current time and time zone
    $dateTime = new DateTime($notification_time, $originalTimeZone);

    // // Format the DateTime object in the desired format
    $notification_time = $dateTime->format('Y-m-d\TH:i:sO');

    echo '<br/>' . $notification_time;

    $result_approve = appointmentModel::updateSpecificAppointmentByDoctor($appointment_id, $doctor_id, $status, $remark, $combineDateTime, $connection);
    if ($result_approve) {
      sentAppointmentApproveRequest($p_email, $full_name, $combineDateTime, $remark);
      //send sms
      sendSMS($combineDateTime, $notification_time, $phone);
      header('Location:../views/all-appointment.php');
    } else {
      header('Location:../views/view-appointment-detail.php');
    }





    // //calculate appointment time
    // $getApprovedA = appointmentModel::getDoctorApprovedAppointments(1, $doctor_id, $appointment_date, $connection);

    // if (count($getApprovedA) == 0) {
    //   $week_date = date('l', strtotime($appointment_date));

    //   $filter_results = doctorModel::filterDoctorAvailableDates($doctor_id, $week_date, $connection);
    //   if (count($filter_results) == 0) {
    //     echo "Not available time slot found";
    //     header("Location:../views/view-appointment-detail.php?error-available-slot&&aptid={$appointment_id}&&full_name={$full_name}&&p_email={$p_email}&&phone={$phone}");
    //     //need to handle notification

    //   } else {

    //     $row = $filter_results[0];
    //     $old_appointment_time_doc_available = $row['available_time'];

    //     //add 15mins
    //     $new_appointment_time_doc_availa = date('h:i A', strtotime($old_appointment_time_doc_available . ' +15 minutes'));

    //     //combine appointement date & appointment time as choose_appointment_date
    //     $dateTimeString_availa = $appointment_date . '' . $new_appointment_time_doc_availa;

    //     $dateTime_availa = new DateTime($dateTimeString_availa);
    //     $combineDateTime_availa = $dateTime_availa->format('Y-m-d h:i:s'); //we can use as a choose_appointment_date


    //     //reduce 9 hours for send notification
    //     $dateTime_sub_availa = new DateTime($combineDateTime_availa);
    //     $interval = new DateInterval('PT9H'); // Duration to subtract (9 hours)
    //     $dateTime_sub_availa->sub($interval);
    //     $notification_time_avail = $dateTime_sub_availa->format('Y-m-d H:i:s');

    //     $originalTimeZone = new DateTimeZone('Europe/Amsterdam');
    //     // Create a DateTime object with the current time and time zone
    //     $dateTime = new DateTime($notification_time_avail, $originalTimeZone);

    //     // Format the DateTime object in the desired format
    //     $notification_time = $dateTime->format('Y-m-d\TH:i:sO');
    //     echo $notification_time;

    //     $result_doc_availa = appointmentModel::updateSpecificAppointmentByDoctor($appointment_id, $doctor_id, $status, $remark, $new_appointment_time_doc_availa, $combineDateTime_availa, $connection);
    //     if ($result_doc_availa) {
    //       sentAppointmentApproveRequest($p_email, $full_name, $combineDateTime_availa, $remark);
    //       //send sms
    //         sendSMS($combineDateTime_availa,$notification_time,$phone);
    //       header('Location:../views/all-appointment.php?doc-available');
    //     } else {
    //       header('Location:../views/view-appointment-detail.php?doc-available');
    //     }
    //   }

    // } else {
    //   $row_desc_date = $getApprovedA[0];
    //   $old_appointment_time_already_approve = $row_desc_date['appointment_time'];

    //   //add 15mins
    //   $new_appointment_time_already_approve = date('H:i A', strtotime($old_appointment_time_already_approve . ' +15 minutes'));


    //   //combine appointement date & appointment time as choose_appointment_date
    //   $dateTimeString_approve = $appointment_date . '' . $new_appointment_time_already_approve;
    //   $dateTime_approve = new DateTime($dateTimeString_approve);
    //   //  echo  $dateTime_approve.'<br/>';
    //   $combineDateTime_approve = $dateTime_approve->format('Y-m-d h:i:s'); //we can use as a choose_appointment_date


    //   //reduce 9 hours for send notification
    //   $dateTime_sub = new DateTime($combineDateTime_approve);

    //   $interval = new DateInterval('PT9H'); // Duration to subtract (9 hours)
    //   $dateTime_sub->sub($interval);

    //   $notification_time = $dateTime_sub->format('Y-m-d h:i:s');


    //   $originalTimeZone = new DateTimeZone('Europe/Amsterdam');
    //   // // Create a DateTime object with the current time and time zone
    //   $dateTime = new DateTime($notification_time, $originalTimeZone);

    //   // // Format the DateTime object in the desired format
    //   $notification_time = $dateTime->format('Y-m-d\TH:i:sO');



    //   $result_already_approve = appointmentModel::updateSpecificAppointmentByDoctor($appointment_id, $doctor_id, $status, $remark, $new_appointment_time_already_approve, $combineDateTime_approve, $connection);
    //   if ($result_already_approve) {
    //     sentAppointmentApproveRequest($p_email, $full_name, $combineDateTime_approve, $remark);
    //     //send sms
    //      sendSMS($combineDateTime_approve,$notification_time,$phone);
    //     header('Location:../views/all-appointment.php?already_approve');
    //   } else {
    //     header('Location:../views/view-appointment-detail.php?already_approve');
    //   }

    // }


  } else {
    $result = appointmentModel::updateSpecificAppointmentByDoctor($appointment_id, $doctor_id, $status, $remark, '', $connection);
    if ($result) {
      //then set this time slot as an avilable
      $result_update_available = doctorModel::updateDoctorAvailableTime($doctor_id, $appointment_time, $appointment_date, $connection);
      sentAppointmentRejectedRequest($p_email, $full_name, $remark);
      header('Location:../views/all-appointment.php');
    } else {
      header('Location:../views/view-appointment-detail.php');
    }
  }

}

function sendSMS($appointmenttime, $notification_time, $phone)
{

  $message = 'Reminder of Your appointment at: ' . $appointmenttime . ' today.
  Nadchazejici schuzka u lekare v tento čas: ' . $appointmenttime . ' dnes.';

  // $phone = '+420776604496';
  // $notification_time = '2023-05-16T12:10:36+0200';

  $endpoint = 'https://app.gosms.eu/oauth/v2/token';
  $clientID = '25356_1zvk95lcaipwgcgskwgck0s4goswc4gwo8k4ssgck48kko88k';
  $clientSecret = '68mlu2dub5cswcsosoc0w0oo4o44wkc04s88o8g0440wcwc4o4';

  $queryParams = array(
    'client_id' => $clientID,
    'client_secret' => $clientSecret,
    'grant_type' => 'client_credentials'
  );

  $endpointWithParams = $endpoint . '?' . http_build_query($queryParams);

  $curl = curl_init($endpointWithParams);

  $options = array(
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
    )
  );

  curl_setopt_array($curl, $options);

  $response = curl_exec($curl);

  if ($response === false) {
    $error = curl_error($curl);
    echo "cURL Error: $error";
  } else {
    $responseData = json_decode($response, true);
    echo $accessToken = $responseData['access_token'];

    $apiEndpoint = 'https://app.gosms.eu/api/v1/messages';

    $postData = array(
      'message' => $message,
      'recipients' => array($phone),
      'channel' => 385843,
      'expectedSendStart' => $notification_time
    );

    $curl = curl_init($apiEndpoint);

    $options = array(
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $accessToken,
      ),
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => json_encode($postData)
    );

    curl_setopt_array($curl, $options);

    $apiresponse = curl_exec($curl);

    if ($response === false) {
      $error = curl_error($curl);
      echo "cURL Error: $error";
    } else {
      // Handle the response from the API
      var_dump($response);
    }
    curl_close($curl);

  }

  curl_close($curl);
}

//get patient appointement details
function getPatientAppointments($connection, $status, $patient_id)
{
  $result = appointmentModel::getPatientAppointments($status, $patient_id, $connection);
  return $result;
}

//get patient appointement details
function getPatientHistoryAppointments($connection, $patient_id)
{
  $result = appointmentModel::getPatientHistoryAppointments($patient_id, $connection);
  return $result;
}

function getADoctorDetailsUsingId($connection, $doctor_id)
{
  $result = doctorModel::getADoctorDetailsUsingId($doctor_id, $connection);
  return $result;
}



//delete pending appointment by patient(before accept the doctor)
if (isset($_POST['delete_appointment_action'])) {

  $appointment_id = $_POST['appointment_id'];
  $patient_id = $_POST['patient_id'];
  $doctor_id = $_POST['doctor_id'];
  $appointment_date = $_POST['appointment_date'];
  $appointment_time = $_POST['appointment_time'];

  $result = appointmentModel::deletePatientAppointment($appointment_id, $patient_id, $connection);

  if ($result) {

    $result1=doctorModel::updateDoctorAvailableTime($doctor_id,$appointment_time,$appointment_date,$connection);
    header('Location:../views/patient-dashboard.php');
  } else {
    header('Location:../views/patient-pending-appointment.php');
  }
}

//add doctor available dates
if (isset($_POST['AddAvailableDates'])) {
  $date = $_POST['date'];
  $time = $_POST['time'];
  $doctor_id = $_POST['doctor_id'];
  $result = doctorModel::addAvailableDateForDoctor($doctor_id, $date, $time, $connection);
  header('Location:../views/profile.php');

}

//get doctor available dates  using his id
function getADoctorAvailableDates($connection, $doctor_id)
{
  $result = doctorModel::getADoctorAvailableDates($doctor_id, $connection);
  return $result;
}

//delete doctor available dates
if (isset($_GET['deleteDoctorAvailableDates'])) {

  $dates_id = $_GET['dates_id'];
  $doctor_id = $_GET['doctor_id'];

  $result = doctorModel::deleteDoctorAvailableDates($dates_id, $doctor_id, $connection);
  header('Location:../views/profile.php');
}

//update patient profile
if (isset($_POST['update-patient-profile'])) {

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone_number = $_POST['phone_number'];
  // $email = $_POST['email'];
  $address = $_POST['address'];
  $city= $_POST['city'];
  $patient_id = $_POST['patient_id'];

  $result = doctorModel::updatePatientProfile($patient_id, $first_name, $last_name, $phone_number, $address, $city, $connection);
  if ($result) {
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['address'] = $address;
    $_SESSION['phone_number'] = $phone_number;
    $_SESSION['city'] = $city;
  }
  header('Location:../views/patient-profile.php');

}

//update doctor profile
if (isset($_POST['update-doctor-profile'])) {


  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone_number = $_POST['phone_number'];
  $specialization = $_POST['specialization'];
  $address = $_POST['address'];
  $city = $_POST['city'];
  $doctor_id = $_POST['doctor_id'];

  // echo '<br/>'. $first_name;
  // echo '<br/>'.$last_name;
  // echo '<br/>'.$phone_number;
  // echo '<br/>'.$specialization;
  // echo '<br/>'. $city;
  // echo '<br/>'.$doctor_id;


  $result = doctorModel::updateDoctorProfile($doctor_id, $first_name, $last_name, $phone_number, $specialization,$address, $city, $connection);
  if ($result) {
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    $_SESSION['phone_number'] = $phone_number;
    $_SESSION['address'] = $address;
  }
  header('Location:../views/profile.php');

}




?>