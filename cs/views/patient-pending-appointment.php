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
	<html lang="cs">

	<head>

		<title>Lékař Ihned - nevyřízené návštěvy</title>
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
									<h4 class="widget-title">Nevyřízené návštěvy</h4>
								</header><!-- .widget-header -->
								<hr class="widget-separator">
								<div class="widget-body">
									<div class="table-responsive">
										<table
											class="table table-bordered table-hover js-basic-example dataTable table-custom">
											<thead>
												<tr>
													<th>Číslo návštěvy</th>
                                                	<th>Jméno doktora</th>
                                                	<th>Specializace</th>
													<th>Datum a čas návštěvy</th>
													<th>Status</th>
                                                	<th>Akce</th>

												</tr>
											</thead>

											<tbody>
												<?php

												$get_pending_appointment = getPatientAppointments($connection, 0, $patient_id);


												foreach ($get_pending_appointment as $row) {
													$doctor_id = $row['doctor_id'];
													$result = getADoctorDetailsUsingId($connection, $doctor_id);
													$record = mysqli_fetch_assoc($result);
													$full_name = $record['first_name'] . ' ' . $record['last_name'];
													$specialization = $record['specialization'];
													$doc_email = $record['email'];
													$doc_phone = $record['phone_number'];
													$city = $record['city'];
													$address = $record['address'];
													?>
													<tr>
														<td>
															<?php echo htmlentities($row['appointment_id']); ?>
														</td>
														<td>
															<?php echo htmlentities($full_name); ?>
														</td>
														<td>
															<?php echo htmlentities($specialization); ?>
														</td>
														<td>
															<?php echo htmlentities($row['appointment_date']); ?>
														</td>
														<?php if ($row['status'] == 0) { ?>

															<td>
																<?php echo "Návštěva ještě nebyla vyřízena."; ?>
															</td>
														<?php } else { ?>
															<td>
																<?php echo htmlentities($row['status']); ?>
															</td>
														<?php } ?>

														<td><a href="patient-view-appointment-detail.php?aptid=<?php echo htmlentities($row['appointment_id']);
														 ?>&&full_name=<?php echo htmlentities($full_name); 
														 ?>&&specialization=<?php echo htmlentities($specialization); 
														 ?>&&doc_phone=<?php echo htmlentities($doc_phone); 
														 ?>&&doc_email=<?php echo htmlentities($doc_email); 
														 ?>&&address=<?php echo htmlentities($address); 
														 ?>&&doctor_id=<?php echo htmlentities($doctor_id);
														 ?>&&city=<?php echo urlencode($city); ?>"
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