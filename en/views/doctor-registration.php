<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/custome/register.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	<title>Registration Form</title>
</head>

<body>
	<div class="background-img1"><img src="assets/images/doctor.jpg" alt=""></div>
	<div class="container">
		<div class="para">
			<h1><b>U</b>ser <b>R</b>egistration</h1>
			<h2 style="text-align: center">Doctor</h2>
			<p style="text-align: center">Hello, we would like to invite you to join our e-channeling system</br> as a
				registered doctor. By signing up, you'll gain access</br> to a wide range of patients seeking medical
				care in your specialization area.</br></br> To register, simply visit our website and enter your
				details,</br> including your specialization area. </br>This will allow us to match you with patients
				seeking care in your area of expertise.</p>
		</div>
		<div class="register">
			<form id="doctorReg" method="post" action="../controller/registerController.php" enctype="multipart/form-data">

				<?php
				// if (isset(($_GET['errSpecialization'] && $_GET['errLicense'] && $_GET['errPass'] ))) {
				// 	echo "<span class='error' style='font-size:small'>".$_GET['errSpecialization']."</span>";
				// }
				?>
				<?php
				if (isset($_GET['errSpecialization']) || isset($_GET['errLicense']) || isset($_GET['errPass'])) {
					echo "<span class='error' style='font-size:x-small'>" . $_GET['errSpecialization']. $_GET['errLicense'] . $_GET['errPass'] . "</span>";
				}
				?>
				<!-- <div> -->
				<p>Specializace <span class="error" id="specError"></p>
				<select class="reg_dropdown" name="specialization" id="specialization" style="border: none;
							border-radius: 5px;
							background: transparent;
							outline: none;
							height: 30px;
							width: 100%;
							color: rgb(52, 52, 52);
							font-size: 14px;
							background: #b8bcc4;
							box-sizing: border-box;" required>

					<option value="Cardiologist">Cardiologist</option>
					<option value="Orthopedist">Orthopedist</option>
					<option value="Internal Medicine">Internal Medicine</option>
					<option value="Dermatologist">Dermatologist</option>
					<option value="Pediatrist">Pediatrist</option>
					<option value="ENT">ENT</option>
					<option value="General Practitioner">General Practitioner</option>
				</select>
				<!-- </div> -->
				<!-- <p>Specialization <span class="error" id="specError"></p>
				<input type="text" id="specialization" name="specialization" placeholder="eg : heart"> -->


				<p>License<span class="error" id="licenseError"></p>
				<input type="text" id="license" name="license" placeholder="Enter License" required>

				<p>Diploma Image upload<span class="error" id="diplomaError"></p>
				<!-- <input type="text" id="diploma" name="diploma" placeholder="Enter Diploma"> -->
				<input type="file" name="certificate" id="certificate" required><br>

				<p>Password <span class="error" id="passError"></p>
				<input type="password" id="password" name="password" placeholder="Enter Password" required>

				<p>Confirm Password <span class="error"></p>
				<input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"
					required>

				<input type="hidden" id="email" name="email" value="<?php echo $_GET['email']; ?>">
				<input type="hidden" id="first_name" name="first_name" value="<?php echo $_GET['first_name']; ?>">
				<input type="hidden" id="last_name" name="last_name" value="<?php echo $_GET['last_name']; ?>">
				<input type="hidden" id="address" name="address" value="<?php echo $_GET['address']; ?>">
				<input type="hidden" id="city" name="city" value="<?php echo $_GET['city']; ?>">
				<input type="hidden" id="phone_number" name="phone_number" value="<?php echo $_GET['phone_number']; ?>">
				<input id="saveDoctor" type="submit" name="saveDoctor" value="Register">
			</form>
		</div>
	</div>
</body>
<script src="../../js/jquery.js"></script>


</html>