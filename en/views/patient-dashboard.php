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
	$patient_id = $_SESSION['patient_id']

		?>
	<!DOCTYPE html>
	<html lang="en">

	<head>

		<title>Patient - Dashboard</title>
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

						<div class="row">
							<div class="col-md-6 col-sm-6">
								<div class="widget stats-widget">
									<div class="widget-body clearfix">
										<?php
										$get_pending_count = getPatientAppointments($connection, 0, $patient_id);

										?>
										<div class="pull-left">
											<h3 class="widget-title text-warning"><span class="counter"
													data-plugin="counterUp">
													<?php echo htmlentities(count($get_pending_count)); ?>
												</span></h3>
											<small class="text-color">Pending Appointments</small>
										</div>
										<span class="pull-right big-icon watermark"><i class="fa fa-paperclip"></i></span>
									</div>
									<footer class="widget-footer bg-warning">
										<a href="patient-pending-appointment.php"><small> View Detail</small></a>
										<span class="small-chart pull-right" data-plugin="sparkline"
											data-options="[4,3,5,2,1], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
									</footer>
								</div><!-- .widget -->
							</div>
							<div class="col-md-6 col-sm-6">
								<div class="widget stats-widget">
									<div class="widget-body clearfix">
										<?php
										$get_approved_count = getPatientAppointments($connection, 1, $patient_id);
										?>
										<div class="pull-left">
											<h3 class="widget-title text-success"><span class="counter"
													data-plugin="counterUp">
													<?php echo htmlentities(count($get_approved_count)); ?>
												</span></h3>
											<small class="text-color">Approved Appointments</small>
										</div>
										<span class="pull-right big-icon watermark"><i class="fa fa-ban"></i></span>
									</div>
									<footer class="widget-footer bg-success">
										<a href="patient-approved-appointment.php"><small> View Detail</small></a>
										<span class="small-chart pull-right" data-plugin="sparkline"
											data-options="[1,2,3,5,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
									</footer>
								</div><!-- .widget -->
							</div>

							<div class="col-md-6 col-sm-6">
								<div class="widget stats-widget">
									<div class="widget-body clearfix">
										<?php
										$get_history = getPatientHistoryAppointments($connection, $patient_id);
										?>
										<div class="pull-left">
											<h3 class="widget-title text-primary"><span class="counter"
													data-plugin="counterUp">
													<?php echo htmlentities(count($get_history)); ?>
												</span></h3>
											<small class="text-color">History Appointments</small>
										</div>
										<span class="pull-right big-icon watermark"><i class="fa fa-file-text-o"></i></span>
									</div>
									<footer class="widget-footer bg-primary">
										<a href="patient-history-appointment.php"><small> View Detail</small></a>
										<span class="small-chart pull-right" data-plugin="sparkline"
											data-options="[1,2,3,5,4], { type: 'bar', barColor: '#ffffff', barWidth: 5, barSpacing: 2 }"></span>
									</footer>
								</div><!-- .widget -->
							</div>







							<div class="row">

				</section><!-- #dash-content -->
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