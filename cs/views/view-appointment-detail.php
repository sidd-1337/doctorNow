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
  $appointment_id = $_GET['aptid'];
  $full_name = $_GET['full_name'];
  $p_email = $_GET['p_email'];
  $phone = $_GET['phone'];

  ?>
  <!DOCTYPE html>
  <html lang="cs">

  <head>

    <title>Lékař Ihned - Detail návštěv</title>
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
                <?php if (isset($_GET['error-available-slot'])) {
                 echo '<div class="alert alert-danger" style="margin:20px" role="alert">
                 No available time slot found. So you cannot approve this appointment.
               </div>';
                }?>
                <hr class="widget-separator">
                <div class="widget-body">
                  <div class="table-responsive">
                    <?php

                    $result = getSpecificAppointment($connection, $appointment_id);
                    $record = mysqli_fetch_assoc($result);
                    $appointment_date=$record['appointment_date'];
                    $appointment_time=$record['appointment_time'];

                    ?>
                    <table border="1" class="table table-bordered mg-b-0">
                      <tr>
                        <th>Číslo návštěvy</th>
                        <td>
                          <?php echo $appointment_id; ?>
                        </td>
                        <th>Jméno pacienta</th>
                        <td>
                          <?php echo $full_name; ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Telefonní číslo</th>
                        <td>
                          <?php echo htmlentities($phone); ?>
                        </td>
                        <th>Email</th>
                        <td>
                          <?php echo $p_email; ?>
                        </td>
                      </tr>

                      <tr>
                        <th>Datum návštěvy</th>
                        <td>
                          <?php echo $appointment_date ; ?>
                        </td>
                        <th>Čas návštěvy</th>
                        <td>
                          <?php echo $appointment_time; ?>
                        </td>
                      </tr>
                      

                      <tr>
                        <!-- <th>Apply Date</th>
                        <td>
                          <?php //echo $record['choose_appointment_date']; ?>
                        </td> -->
                        <th>Status</th>

                        <td colspan="4">
                          <?php $status = $record['status'];

                          if ($status == 0) {
                            echo "Čeká se na schválení";
                          }

                          if ($status == 1) {
                            echo "Schválená návštěva";
                          }


                          if ($status == 2) {
                            echo "Návštěva byla zrušena";
                          }



                          ; ?>
                        </td>
                      </tr>
                      <tr>

                        <th>Zpráva</th>
                        <?php if ($record['message'] == "") { ?>

                          <td colspan="3">
                            <?php echo "Není k dispozici"; ?>
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
                        <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal"
                          data-target="#myModal">Vyřídit návštěvu</button>
                      </p>

                    <?php } ?>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                      aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Vyřídit návštěvu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <table class="table table-bordered table-hover data-tables">

                              <form method="post" name="submit_action" action="../controller/doctorAppointmentController.php">



                                <tr>
                                  <th>Poznámka<th>
                                  <td>
                                    <textarea name="remark" placeholder="Remark" rows="12" cols="14"
                                      class="form-control wd-450" required="true"></textarea>
                                  </td>
                                </tr>

                                <tr>
                                  <th>Status</th>
                                  <td>

                                    <select name="status" class="form-control wd-450" required="true">
                                      <option value="1" selected="true">Approved</option>
                                      <option value="2">Cancelled</option>

                                    </select>
                                  </td>
                                </tr>
                                <input type="hidden" class="form-control" placeholder="appointment_id" name="appointment_id" value="<?php echo $appointment_id;?>">
                                <input type="hidden" class="form-control" placeholder="doctor_id" name="doctor_id" value="<?php echo $doctor_id;?>">
                                <input type="hidden" class="form-control" placeholder="appointment_date" name="appointment_date" value="<?php echo $appointment_date;?>">
                                <input type="hidden" class="form-control" placeholder="appointment_time" name="appointment_time" value="<?php echo $appointment_time;?>">

                                <input type="hidden" class="form-control" placeholder="full_name" name="full_name" value="<?php echo $full_name;?>">
                                <input type="hidden" class="form-control" placeholder="p_email" name="p_email" value="<?php echo $p_email;?>">
                                <input type="hidden" class="form-control" placeholder="phone" name="phone" value="<?php echo $phone;?>">
                              
                                
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušit</button>
                            <button type="submit" name="submit_action" class="btn btn-primary">Potvrdit</button>

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