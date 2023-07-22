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


	if (isset($_POST['submit-book'])) {

		$d_first_name = $_POST['d_first_name'];
		$d_last_name = $_POST['d_last_name'];
		$specialization = $_POST['specialization'];
		$city = $_POST['city'];

		$d_doctor = $_POST['email'];
		$doctor_id = $_POST['doctor_id'];
		$booking_date = $_POST['booking_date'];
		$booking_time = $_POST['booking_time'];

	}


	if (isset($_POST['submit'])) {


		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$phone_number = $_POST['phone_number'];
		$specialization = $_POST['specialization'];
		$doctor_id = $_POST['doctor_id'];
		$message = $_POST['message'];

		$patient_id = $_SESSION['patient_id'];


		$appointment_date = $_POST['date'];
		$time = $_POST['time'];
		$cdate = date('Y-m-d');


		if ($appointment_date <= $cdate) {
			echo '<script>alert("Datum návštěvy musí být později než je nyní")</script>';
		} else {


			$query = "INSERT INTO appointment (patient_id,doctor_id,appointment_date,appointment_time,message,status) VALUES('{$patient_id}','{$doctor_id}','{$appointment_date}','{$time}','{$message}',0)";
			$result_set = mysqli_query($connection, $query);


			if ($result_set) {

				$query_update = "UPDATE `available_dates` SET is_booking=1 WHERE doctor_id='{$doctor_id}' AND available_time='{$time}' AND available_date='{$appointment_date}'";
				$result = mysqli_query($connection, $query_update);


				$_POST['first_name'] = "";
				$_POST['last_name'] = "";
				$_POST['email'] = "";
				$_POST['phone_number'] = "";
				$_POST['specialization'] = "";
				$_POST['doctor_id'] = "";
				$_POST['message'] = "";

				echo '<script>alert("Žádost byla odeslána. Doktor Vás brzy kontaktuje.")</script>';
				echo "<script>window.location.href ='./patient-pending-appointment.php'</script>";

			} else {
				echo '<script>alert("Něco se pokazilo. Zkuste to prosím znovu.")</script>';
				echo "<script>window.location.href ='./patient-booking-appointment.php'</script>";
			}
		}
	}

	?>
	<!DOCTYPE html>
	<html lang="cs">

	<head>

		<title>Lékař Ihned - Detail návštěvy</title>
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
		<link rel="stylesheet" href="assets/css/custome/booking.css">
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

				<section class="section-padding" id="booking">
					<div class="container">
						<div class="row">
							<div class="col-lg-8 col-12 mx-auto">
								<div class="booking-form">

									<h2 class="text-center mb-lg-3 mb-2">Objednejte se k lékaři</h2>

									<form role="form" method="post">
										<div class="row">
											<div class="col-lg-6 col-12">
												<?php if (!isset($_SESSION['first_name'])) {
													?>
													<input type="text" name="first_name" id="first_name"
														class="form-control appform" placeholder="First name" required='true'>
												<?php } else { ?>
													<input type="text" name="first_name" id="first_name"
														class="form-control appform" placeholder="First name" required='true'
														value=<?php echo $_SESSION['first_name']; ?> readonly=true>
												<?php } ?>
											</div>
											<div class="col-lg-6 col-12">
												<?php if (!isset($_SESSION['last_name'])) {
													?>
													<input type="text" name="last_name" id="last_name"
														class="form-control appform" placeholder="Last name" required='true'>
												<?php } else { ?>
													<input type="text" name="last_name" id="last_name"
														class="form-control appform" placeholder="Last name" required='true'
														value=<?php echo $_SESSION['last_name']; ?> readonly=true>
												<?php } ?>
											</div>

											<div class="col-lg-6 col-12">
												<?php if (!isset($_SESSION['email'])) {
													?>
													<input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*"
														class="form-control appform" placeholder="Email address"
														required='true'>
												<?php } else { ?>
													<input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*"
														class="form-control appform" placeholder="Email address" required='true'
														value=<?php echo $_SESSION['email']; ?> readonly=true>
												<?php } ?>
											</div>

											<div class="col-lg-6 col-12">

												<?php if (!isset($_SESSION['phone_number'])) {
													?>
													<input type="text" name="phone_number" id="phone_number"
														class="form-control appform" placeholder="Enter Phone Number">
												<?php } else { ?>
													<input type="text" name="phone_number" id="phone_number"
														class="form-control appform" placeholder="Enter Phone Number"
														value=<?php echo $_SESSION['phone_number']; ?> readonly=true>

												<?php } ?>
											</div>
											<br />
											<div class="sample"></div>

											<div class="col-12">
												<?php if (isset($_POST['submit-book'])) { ?>

													<select onchange="this.form.submit()" name="specialization"
														id="specialization" class="form-control appform-select" required readonly=true>
														<option value="<?php echo $specialization ?>"><?php echo $specialization ?></option>
													</select>


												<?php } else { ?>

											

												<?php } ?>
											</div>

											<div class="col-12">

												<?php if (isset($_POST['submit-book'])) { ?>


													<select name="doctor_id" id="doctor_id" class="form-control appform-select">
														<option value="<?php echo $doctor_id; ?>">
															<?php echo $d_first_name . ' ' . $d_last_name . ' - ' . htmlentities($city); ?>
														</option>

													</select>

												<?php } else { ?> <?php } ?>
											</div>




											<div class="col-lg-6 col-12">
												<?php if (isset($_POST['submit-book'])) { ?>
													<input type="text" name="date" id="date" value="<?php echo $booking_date ?>"
														class="form-control appform" readonly=true>
												<?php } else { ?> <?php } ?>

											</div>

											<div class="col-lg-6 col-12">
												<?php if (isset($_POST['submit-book'])) { ?>
													<input type="text" name="time" id="time" value="<?php echo $booking_time ?>"
														class="form-control appform" readonly=true>
												<?php } else { ?> <?php } ?>

											</div>

											<div class="col-12">
												<textarea class="form-control appform" rows="5" id="message" name="message"
													placeholder="Přidat zprávu pro lékaře"></textarea>
											</div>

											<div class="patient-b-dev">
												<div class="col-lg-3 col-md-4 col-6 mx-auto">
												<?php if (isset($_POST['submit-book'])) { ?>

													<button type="submit" class="form-control appform" name="submit" id="submit-button-booking">Odeslat</button>
													<?php } else { ?>
														<center><p>Upps, něco se nepovedlo. Jít zpět na <a href="../../index.php">hlavní stránku</a></p></center>
														 <?php } ?>

												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</section>
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