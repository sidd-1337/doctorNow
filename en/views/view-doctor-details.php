<?php
session_start();
error_reporting(0);

require_once('../includes/database.php');
require_once('../controller/doctorAppointmentController.php');

if (!isset($_SESSION['email'])) {
  header('location:logout.php');
} else {
  if ($_SESSION['type'] !== 'admin') {
    header('location:logout.php');
  }
  // $doctor_id = $_SESSION['doctor_id'];

  $first_name = $_GET['first_name'];
  $last_name = $_GET['last_name'];
  $email = $_GET['email'];
  $phone_number = $_GET['phone_number'];
  $region = $_GET['region'];
  $specialization = $_GET['specialization'];
  $license = $_GET['license'];
  $certificate = $_GET['certificate'];
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>

    <title>View Appointment Detail</title>
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
                  <h4 class="widget-title" style="color: blue">Appointment Details</h4>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">
                  <div class="table-responsive">
                    <?php

                    $result = getSpecificAppointment($connection, $appointment_id);
                    $record = mysqli_fetch_assoc($result);

                    ?>

                    <br>
                    <div class="row">
                      <div class="col-sm-12 col-md-6" >
                      <table border="1" class="table table-bordered mg-b-0">

                      <tr>
                        <th>Full name</th>
                        <td>
                          <?php
                            echo $first_name ." ". $last_name;
                           ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Phone number</th>
                        <td>
                          <?php
                            echo $phone_number;
                           ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Region</th>
                        <td>
                          <?php
                            echo $region;
                           ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Specialization</th>
                        <td>
                          <?php
                            echo $specialization;
                           ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Licence</th>
                        <td>
                          <?php
                            echo $license;
                           ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Email</th>
                        <td>
                          <?php
                            echo $email;
                           ?>
                        </td>
                      </tr>



                      </table>
                      </div>
                      <div class="col-sm-12 col-md-6" >
                      <?php 
                      
                      $path = str_replace(strstr($certificate, ' ®_date='), '', $certificate);
                      $fName = basename($path); // Get only the filename with extension
                      $targetPath = '../images/uploads/' . $fName; 
                      ?>
                      <img  class="img-fluid" alt="" src="<?php echo $targetPath; ?>">
                     
                      <!-- <img src="../images/uploads/3.jpg" class="img-fluid" alt=""> -->
                      </div>
                    </div>


                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Take Action</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <table class="table table-bordered table-hover data-tables">

                              <form method="post" name="submit_action" action="../controller/doctorAppointmentController.php">



                                <tr>
                                  <th>Remark</th>
                                  <td>
                                    <textarea name="remark" placeholder="Remark" rows="12" cols="14" class="form-control wd-450" required="true"></textarea>
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
                                <input type="hidden" class="form-control" placeholder="appointment_id" name="appointment_id" value="<?php echo $appointment_id; ?>">
                                <input type="hidden" class="form-control" placeholder="doctor_id" name="doctor_id" value="<?php echo $doctor_id; ?>">
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="submit_action" class="btn btn-primary">Update</button>

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