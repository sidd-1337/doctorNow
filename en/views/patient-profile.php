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
  $email = $_SESSION['email'];
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>

    <title>Patient Profile</title>
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

            <div class="col-md-12">
              <div class="widget">
                <header class="widget-header">
                  <h3 class="widget-title">Patient Profile</h3>
                </header><!-- .widget-header -->
                <hr class="widget-separator">
                <div class="widget-body">

                  <form class="form-horizontal" method="post" action="../controller/doctorAppointmentController.php" name="update-patient-profile">
                    <?php 
                    $result=getAPatientDetailsUsingId($connection,$patient_id);
                    $record = mysqli_fetch_assoc($result);
                    ?>
                    <div class="form-group">
                      <label for="exampleTextInput1" class="col-sm-3 control-label">Full Name : </label>
                      <div class="col-sm-4">
                        <input id="fname" type="text" class="form-control" placeholder="First Name" name="first_name"
                          required="true" value="<?php echo $record['first_name']; ?>" >
                      </div>

                      <div class="col-sm-5">
                        <input id="fname" type="text" class="form-control" placeholder="Last Name" name="last_name"
                          required="true" value="<?php echo $record['last_name']; ?>" >
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="email2" class="col-sm-3 control-label">Contact Number:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $record['phone_number']; ?>"
                          required='true' maxlength='10' >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="email2" class="col-sm-3 control-label">Email:</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $record['email']; ?>"
                          required='true' maxlength='10' readonly=true >
                      </div>
                    </div>
                    <div class="form-group">
                    <label for="email2" class="col-sm-3 control-label">Address:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="address" name="address" value="<?php echo $record['address']; ?>" >
                    </div>
                  </div>

                  <input type="hidden" class="form-control" id="patient_id" name="patient_id" value="<?php echo $patient_id; ?>" >
                  

                  <!-- <div class="form-group">
                    <label for="email2" class="col-sm-3 control-label">Regsitration Date:</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="email2" name="" value="<?php //echo $record['reg_date']; ?>" >
                    </div>
                  </div> -->

                  <div class="row">
                    <div class="col-sm-9 col-sm-offset-3">
                      <button type="submit" class="btn btn-success" name="update-patient-profile">Update</button>

                    </div>
                  </div>
                </form>
              
               
              
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