<?php
session_start();
error_reporting(0);

require_once('../includes/database.php');
require_once('../controller/doctorAppointmentController.php');

if (!isset($_SESSION['email'])) {
  header('location:logout.php');
} else {
  if ($_SESSION['type'] !== 'patient') {
    header('location:logout.php');
  }
  $patient_id = $_SESSION['patient_id'];


  $appointment_id = $_GET['aptid'];
  $full_name = $_GET['full_name'];
  $specialization = $_GET['specialization'];
  $doc_email = $_GET['doc_email'];
  $doc_phone = $_GET['doc_phone'];
  $address = $_GET['address'];
  $city= $_GET['city'];
  $doctor_id = $_GET['doctor_id'];

  

  ?>
  <!DOCTYPE html>
  <html lang="cs">

  <head>

    <title>Lékař ihned - detail návštěv</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
    <!-- build:css assets/css/app.min.css -->
    <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
    <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
    <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/core.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <!-- endbuild -->
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
            <!-- DOM dataTable -->
            <div class="col-md-12">
              <div class="widget">
                <header class="widget-header">
                  <h4 class="widget-title" style="color: blue">Detail návštěvy</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <div class="table-responsive">
                    <?php

                    $result = getSpecificAppointment($connection, $appointment_id);
                    $record = mysqli_fetch_assoc($result);

                    ?>
                    <table border="1" class="table table-bordered mg-b-0">
                      <tr>
                        <th>Číslo návštěvy</th>
                        <td>
                          <?php echo $appointment_id; ?>
                        </td>
                        <th>Jméno lékaře</th>
                        <td>
                          <?php echo $full_name; ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Specializace</th>
                        <td>
                          <?php echo $specialization; ?>
                        </td>
                        <th>Město</th>
                        <td>
                          <?php echo $city; ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Adresa</th>
                        <td colspan="3">
                          <?php echo $address; ?>
                        </td>

                  
                      </tr>

                      <?php if ($record["status"]==0) {?>
                      <tr>
                        <th>Datum návštěvy</th>
                        <td>
                          <?php echo $record['appointment_date']; ?>
                        </td>
                        <th>Čas návštěvy</th>
                        <td>
                          <?php echo $record['appointment_time']; ?>
                        </td>
                      </tr>
                      <?php }else { ?>
                        <tr>
                        <th>Datum návštěvy</th>
                        <td>
                          <?php echo $record['choose_appointment_date']; ?>
                        </td>
                        <th>Poznámka</th>
                        <td>
                          <?php echo $record['remark']; ?>
                        </td>
                      </tr>
                      <?php }?>


                      <tr>
                        <th>Datum vytvoření</th>
                        <td>
                          <?php echo $record['create_date']; ?>
                        </td>
                        <th>Status návštěvy</th>

                        <td colspan="4">
                          <?php $status = $record['status'];

                          if ($status == 0) {
                            echo "Zatím nebyla vyřízena";
                          }

                          if ($status == 1) {
                            echo "Schválená";
                          }


                          if ($status == 2) {
                            echo "Zrušená";
                          }



                          ; ?>
                        </td>
                      </tr>

                      <tr>

                        <th>Zpráva</th>
                        <?php if ($record['message'] == "") { ?>

                          <td colspan="3">
                            <?php echo "Nebyla napsána žádná zpráva"; ?>
                          </td>
                        <?php } else { ?>
                          <td colspan="3">
                            <?php echo htmlentities($record['message']); ?>
                          </td>
                        <?php } ?>

                      </tr>


                    </table>
                    <br>


                    <?php

                    if ($status == 0) {
                      ?>
                      <p align="center" style="padding-top: 20px">
                        <button class="btn btn-danger waves-effect waves-light w-lg" data-toggle="modal"
                          data-target="#myModal">Smazat objednávku</button>
                      </p>

                    <?php } ?>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title text-danger" id="exampleModalLabel">Chceš opravdu smazat objednávku?</h5>
                          </div>


                          <form method="post" name="delete_appointment_action" action="../controller/doctorAppointmentController.php">

                            <input type="hidden" class="form-control" placeholder="appointment_id" name="appointment_id"
                              value="<?php echo $appointment_id; ?>">
                            <input type="hidden" class="form-control" placeholder="patient_id" name="patient_id"
                              value="<?php echo $patient_id; ?>">

                              <input type="hidden" class="form-control" placeholder="doctor_id" name="doctor_id"
                              value="<?php echo $doctor_id; ?>">

                              <input type="hidden" class="form-control" placeholder="appointment_date" name="appointment_date"
                              value="<?php echo $record['appointment_date']; ?>">

                              <input type="hidden" class="form-control" placeholder="appointment_time" name="appointment_time"
                              value="<?php echo $record['appointment_time']; ?>">


                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušit</button>
                              <button type="submit" name="delete_appointment_action" class="btn btn-primary">Potvrdit</button>

                          </form>


                        </div>


                      </div>
                    </div>

                  </div>

                </div><!-- .widget-body -->


              </div><!-- .widget -->
            </div><!-- END column -->


          </div><!-- .row -->
        </section><!-- .app-content -->
      </div><!-- .wrap -->
      <!-- APP FOOTER -->
      <?php include_once('includes/footer.php'); ?>
      <!-- /#app-footer -->
    </main>
    <!--========== END app main -->



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