<?php
session_start();
error_reporting(0);
require_once('../includes/database.php');
require_once('../controller/doctorAppointmentController.php');
require_once('../controller/adminController.php');

if (!isset($_SESSION['email'])) {
	header('location:logout.php');
} else {
	if ($_SESSION['type'] !== 'admin') {
		header('location:logout.php');
	}
	$admin_id = $_SESSION['admin_id']

		?>
	<!DOCTYPE html>
	<html lang="en">

	<head>

		<title>Doctor Registrations Requests</title>
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
									<h4 class="widget-title">Doctors' Registrations Requests</h4>
								</header><!-- .widget-header -->
								<hr class="widget-separator">
								<div class="widget-body">
									<div class="table-responsive">
										<table
											class="table table-bordered table-hover js-basic-example dataTable table-custom">
											<thead>
												<tr>
													<th>No</td>
													<th>First Name</td>
													<th>Last Name</td>
													<th>Email</td>
													<th>Phone Number</th>
													<th>Other Details</th>
													<th>Actions</th>
												</tr>
											</thead>

											<tbody>
												<?php
												$cnt = 1;
												$get_doctor = userDetails($connection, 'doctor', 0);//0 means user_accepted=0.


												foreach ($get_doctor as $row) {

													?>
													<tr>
														<td>
															<?php echo htmlentities($cnt); ?>
														</td>

														<td>
															<?php echo htmlentities($row['first_name']); ?>
														</td>
														<td>
															<?php echo htmlentities($row['last_name']); ?>
														</td>
														<td>
															<?php echo htmlentities($row['email']); ?>
														</td>
														<td>
															<?php echo htmlentities($row['phone_number']); ?>
														</td>

														<td><a type="button"
																href="view-doctor-details.php?first_name=<?php echo $row['first_name']; ?> &last_name=<?php echo $row['last_name']; ?> &email= <?php echo $row['email']; ?> &phone_number=<?php echo $row['phone_number']; ?> &region=<?php echo $row['region']; ?> &specialization=<?php echo $row['specialization']; ?> &license=<?php echo $row['license']; ?> &certificate=<?php echo $row['diploma']; ?> &reg_date=<?php echo $row['reg_date']; ?> "
																; class="btn btn-primary">View</a></td>

														<td><button type="button"
														onclick=' if(confirm("Are you want to reject this doctor registration ?"))
                                    window.location="../controller/adminController.php?doctorRequestCancel_id=<?php echo $row['doctor_id']; ?>&&doctor_email=<?php echo $row['email']; ?>&&doctor_name=<?php echo $row['first_name']; ?>"'
																; class="btn btn-danger">Deny</button>
															<button type="button"
															onclick=' if(confirm("Are you want to add this doctor to the system ?"))
                                    window.location="../controller/adminController.php?doctorRequestAccept_id=<?php echo $row['doctor_id']; ?>&&doctor_email=<?php echo $row['email']; ?>&&doctor_name=<?php echo $row['first_name']; ?>"'
																; class="btn btn-success">Approve</button>
														</td>



													</tr>
													<?php $cnt = $cnt + 1;
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