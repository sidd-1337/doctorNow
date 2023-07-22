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
	$doctor_id = $_SESSION['doctor_id']


		?>
	<!DOCTYPE html>
	<html lang="cs">

	<head>

		<title>Lékař ihned - všechny návštěvy</title>
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
									<h4 class="widget-title">All Appointment</h4>
								</header><!-- .widget-header -->
								<hr class="widget-separator">
								<div class="widget-body">
									<div class="table-responsive">
										<table
											class="table table-bordered table-hover js-basic-example dataTable table-custom">
											<thead>
												<tr>
													<th>Číslo návštěvy</th>
													<th>Jméno pacienta</th>
													<th>Telefonní číslo</th>
													<th>Email</th>
													<th>Status</th>
													<th>Akce</th>


												</tr>
											</thead>

											<tbody>
												<?php
												$get_total_appointments = getDoctorAllAppointment($connection, $doctor_id);

												foreach ($get_total_appointments as $row) {
													$patient_id = $row['patient_id'];
													$result = getAPatientDetailsUsingId($connection, $patient_id);
													$record = mysqli_fetch_assoc($result);
													$full_name = $record['first_name'] . ' ' . $record['last_name'];
													$phone = $record['phone_number'];
													$p_email = $record['email'];
													?>
													<tr>
														<td>
															<?php echo htmlentities($row['appointment_id']); ?>
														</td>
														<td>
															<?php echo htmlentities($full_name); ?>
														</td>
														<td>
															<?php echo htmlentities($phone); ?>
														</td>
														<td>
															<?php echo htmlentities($p_email); ?>
														</td>
														<?php if ($row['status'] == 0) { ?>

															<td>
																<?php echo "Čeká na schválení"; ?>
															</td>
														<?php }else if ($row['status'] == 1) { ?>
															<td>
																<?php echo "Schválená návštěva"; ?>
															</td>
														<?php } else { ?>
															<td>
																<?php echo "Zrušená návštěva"; ?>
															</td>
														<?php } ?>

														<td><a href="view-appointment-detail.php?aptid=<?php echo htmlentities($row['appointment_id']); ?>&&full_name=<?php echo htmlentities($full_name); ?>&&p_email=<?php echo htmlentities($p_email); ?>&&phone=<?php echo htmlentities($phone); ?>"
																class="btn btn-primary">Zobrazit detail</a></td>

													</tr>
													<?php
												} ?>

											</tbody>
											
										</table>
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