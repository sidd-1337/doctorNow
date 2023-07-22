<?php
session_start();
error_reporting(0);
require_once('../includes/database.php');
require_once('../controller/doctorAppointmentController.php');

if (!isset($_SESSION['email'])) {
  header('location:logout.php');
} else {
  if ($_SESSION['type'] !== 'doctor') {
    header('location:logout.php');
  }
  $doctor_id = $_SESSION['doctor_id'];
  $email = $_SESSION['email'];

  $specializations = ["Kardiolog", "Ortoped", "Interní ambulance", "Dermatology", "Dermatologie", "Pediatr", "URL", "Praktický lékař"];
  $citys = ["Hlavní město Praha", "Středočeský kraj", "Jihočeský kraj", "Plzeňský kraj", "Karlovarský kraj", "Ústecký kraj", "Liberecký kraj", 
  "Královéhradecký kraj", "Pardubický kraj", "Kraj Vysočina", "Olomoucký kraj", "Zlínský kraj", "Moravskoslezský kraj"];
?>
  <!DOCTYPE html>
  <html lang="cs">

  <head>

    <title>Lékař Ihned - Lékařův profil</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/custome/calendar.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
    <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
    <script>
      Breakpoints();
    </script>
  </head>

  <body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->

    <?php include_once('includes/header.php'); ?>

    <?php include_once('includes/sidebar.php'); ?>

    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
      <div class="wrap">
        <section class="app-content">
          <div class="row">

            <div class="col-md-12">
              <div class="widget">
                <header class="widget-header">
                  <h3 class="widget-title">Lékařův profil</h3>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">

                  <form class="form-horizontal" method="post" action="../controller/doctorAppointmentController.php">
                    <?php
                    $result = getADoctorDetails($connection, $email);
                    $record = mysqli_fetch_assoc($result);
                    ?>
                    <div class="form-group">
                      <label for="exampleTextInput1" class="col-sm-3 control-label">Celé jméno:</label>
                      <div class="col-sm-4">
                        <input id="fname" type="text" class="form-control" placeholder="First Name" name="first_name" required="true" value="<?php echo $record['first_name']; ?>">
                      </div>

                      <div class="col-sm-5">
                        <input id="fname" type="text" class="form-control" placeholder="Last Name" name="last_name" required="true" value="<?php echo $record['last_name']; ?>">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email2" class="col-sm-3 control-label">Telefonní číslo:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $record['phone_number']; ?>" required='true' maxlength='10'>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email2" class="col-sm-3 control-label">Specializace:</label>
                      <div class="col-sm-9">
                        <select onChange="" name="specialization" id="specialization" class="form-control" required>

                          <?php foreach ($specializations as $specializationOption) : ?>
                            <option value="<?php echo $specializationOption; ?>" <?php if ($record['specialization'] === $specializationOption)
                                                                                    echo 'selected'; ?>>
                              <?php echo $specializationOption; ?>
                            </option>
                          <?php endforeach; ?>

                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email2" class="col-sm-3 control-label">Kraj:</label>
                      <div class="col-sm-9">
                        <select onChange="" name="city" id="city" class="form-control" required>

                          <?php foreach ($citys as $cityOption) : ?>
                            <option value="<?php echo $cityOption; ?>" <?php if ($record['city'] === $cityOption)
                                                                            echo 'selected'; ?>>
                              <?php echo $cityOption . ' city'; ?>
                            </option>
                          <?php endforeach; ?>

                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email2" class="col-sm-3 control-label">Email:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="email" name="" value="<?php echo $record['email']; ?>" readonly=true>
                      </div>
                    </div>
                    <input type="hidden" class="form-control" id="doctor_id" name="doctor_id" value="<?php echo $doctor_id; ?>">

                    <div class="row">
                      <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-success" name="update-doctor-profile">Update</button>

                      </div>
                    </div>
                  </form>
                  <hr />
                  <div>
                    <h3 class="widget-title">Dostupné termíny</h3>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 col-md-3">
                      <form class="form-horizontal" method="post" name="AddAvailableDates" action="../controller/doctorAppointmentController.php">


                        <input type="date" name="date" id="date" value="" class="form-control">
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <input type="time" name="time" id="time" value="" class="form-control" placeholder="Start Time" required>
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <input type="hidden" name="doctor_id" value="<?php echo $doctor_id; ?>" class="form-control">
                    </div>
                    <div class="col-sm-6 col-md-3">
                      <button type="submit" onclick="" class="btn btn-info" name="AddAvailableDates">Přidat dostupný termín</button>
                    </div>
                  </div>

                  </form>

                  <hr />




                  <?php
                  $currentDate = date('Y-m-d'); // Get the current date
                  $startOfWeek =  $currentDate;
                  $endOfWeek =  date("Y-m-d", strtotime($currentDate . "+6 days"));



                  $query = "SELECT DISTINCT available_date, available_time FROM available_dates WHERE doctor_id='$doctor_id' AND available_date BETWEEN '$startOfWeek' AND '$endOfWeek' ORDER BY available_time ASC";
                  $result = mysqli_query($connection, $query);
                  $timeSlots = array();

                  while ($row = mysqli_fetch_assoc($result)) {
                    $date = $row['available_date'];
                    $timeSlot = $row['available_time'];
                    $timeSlots[$date][] = $timeSlot;
                  }




                  ?>
                  <?php if (isset($_GET['week'])) {
                    $startOfWeek = $_GET['week'];
                    $endOfWeek =  date("Y-m-d", strtotime($startOfWeek . "+6 days"));	
                    // $endOfWeek = date('Y-m-d', strtotime('next Sunday', strtotime($startOfWeek)));
                    $currentDate = date('Y-m-d'); // Get the current date

                    $query = "SELECT DISTINCT available_date, available_time FROM available_dates WHERE doctor_id='$doctor_id' AND available_date BETWEEN '$startOfWeek' AND '$endOfWeek' ORDER BY available_time ASC";
                    $result = mysqli_query($connection, $query);
                    $timeSlots = array();
  
                    while ($row = mysqli_fetch_assoc($result)) {
                      $date = $row['available_date'];
                      $timeSlot = $row['available_time'];
                      $timeSlots[$date][] = $timeSlot;
                    }
                  }
                  ?>

                  <div class="calendar">
                    <div class="header">
                      <a href="?week=<?php echo date('Y-m-d', strtotime('-1 week', strtotime($startOfWeek))); ?>">Minulý týden</a>
                      <h2>
                        <?php echo $startOfWeek . ' to ' . $endOfWeek; ?>
                      </h2>
                      <a href="?week=<?php echo date('Y-m-d', strtotime('+1 week', strtotime($startOfWeek))); ?>">Tento týden</a>
                    </div>
                    <div class="days">
                      <?php
                      $currentDate = $startOfWeek;
                      while ($currentDate <= $endOfWeek) {
                        echo '<div class="day">';
                        echo '<h3>' . date('m-d', strtotime($currentDate)) . '</h3>';
                       // echo $startOfWeek ;
                        echo '<div class="dayinner">';

                        if (isset($timeSlots[$currentDate])) {



                          echo '<ul>';
                          foreach ($timeSlots[$currentDate] as $timeSlot) {
                            $query_booking_available = "SELECT * FROM available_dates WHERE doctor_id=$doctor_id AND available_date='{$currentDate}' AND available_time='{$timeSlot}'";
                            $booking_available = mysqli_query($connection, $query_booking_available);
                            $get_record = mysqli_fetch_assoc($booking_available);

                            if ($get_record['is_booking'] == 1) {
                            echo '<div class="booked_slot_doctor">
                            '.date("H:i", strtotime($timeSlot)).'
                        </div>';
                            }else{
                              echo '<div class="avalable_slot_doctor">
                            '.date("H:i", strtotime($timeSlot)).'
                        </div>';
                            }
                          }
                          echo '</ul>';
                        } else {
                          echo '<div class="no_slots">';
                          echo '<p >Žádné termíny</p>';
                          echo '</div>';
                        }

                        echo '</div>';
                        echo '</div>';
                        $currentDate = date('Y-m-d', strtotime('+1 day', strtotime($currentDate)));
                      }
                      ?>
                    </div>
                  </div>



                  <div>

                    <div class="table-responsive">
                      <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                        <thead>
                          <tr>
                            <th>Číslo</th>
                            <th>Datum</th>
                            <th>Čas</th>
                            <th>Status</th>
                            <th>Akce</th>

                          </tr>
                        </thead>



                        <tbody>
                          <?php
                          $cnt = 1;
                          $get_doctor_dates = getADoctorAvailableDates($connection, $doctor_id);


                          foreach ($get_doctor_dates as $row) {

                          ?>

                            <tr>
                              <td>
                                <?php echo htmlentities($cnt); ?>
                              </td>


                              <td>
                                <?php echo htmlentities($row['available_date']); ?>
                              </td>


                              <td>
                                <?php echo htmlentities($row['available_time']); ?>
                              </td>

                              <td>
                                <?php  if($row['is_booking']==1){
                                  echo "Rezervováno";
                                }else{
                                  echo "Dostupné";
                                }
                                 ?>
                              </td>

                              <td>
                              <?php  if($row['is_booking']==1){
                                  echo "";
                                }else{
                                  ?>
                                  <a href="../controller/doctorAppointmentController.php?deleteDoctorAvailableDates&&dates_id=<?php echo htmlentities($row['dates_id']);
                                   ?>&&doctor_id=<?php echo htmlentities($row['doctor_id']); ?>" class="btn btn-danger">Odstranit</a>
                                  <?php
                                }
                                 ?>
                                
                              </td>

                            </tr>
                          <?php $cnt = $cnt + 1;
                          } ?>
                        </tbody>

                      </table>
                    </div>
                  </div>



                </div><!-- .widget-body -->
              </div><!-- .widget -->
            </div><!-- END column -->

          </div><!-- .row -->
        </section><!-- #dash-content -->
      </div><!-- .wrap -->
      <!-- APP FOOTER -->
      <?php include_once('includes/footer.php'); ?>
      <!-- /#app-footer -->
    </main>


    <!-- SIDE PANEL -->


    <!-- build:js assets/js/core.min.js -->
    <script src="libs/bower/jquery/dist/jquery.js"></script>
    <script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
    <script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
    <script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
    <script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="libs/bower/PACE/pace.min.js"></script>
    <!-- endbuild -->

    <!-- build:js assets/js/app.min.js -->
    <script src="assets/js/library.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/app.js"></script>
    <!-- endbuild -->
    <script src="libs/bower/moment/moment.js"></script>
    <script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
  </body>

  </html>
<?php } ?>