<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/custome/register.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	<title>Registration Form</title>
	<meta charset="utf-8">
</head>

<body>
	<div class="background-img1"><img src="assets/images/proffesionals.jpg" alt="" ></div>
	<div class="container">
		<div class="para">
			<h1><b>U</b>ser <b>R</b>egistration</h1>
			<h2 style="text-align: center">Patient</h2>
			<p style="text-align: center">Revolutionize the way you access healthcare</br> by <span>registering</span> with <span>e-channeling!</span> </br>Say goodbye to long waits and hello to seamless booking and</br> personalized care with <span>just a few clicks</span>.</br> <span>Sign up now</span> to find best <span>proffesionals</span> !</p>
		</div>
		<div class="register">
		<form method="post" id="patientReg" action="../controller/registerController.php" enctype="multipart/form-data">
				<?php
				if (isset($_GET['errPass'])) {
					echo "<span class='error' style='font-size:x-small'>" . $_GET['errPass'] . "</span>";
				}
				?>
				<p>Password <span class="error" id="passError"></span></p>
				<input type="password" id="password" name="password" placeholder="Enter Password">
				<p>Confirm Password <span class="error" id="cpassError"></span></p>
				<input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password">
				<h6>*Password must contain least one uppercase lowercase and number</h6>
				
				<input type="hidden" id="email" name="email" value="<?php echo $_GET['email']; ?>">
				<input type="hidden" id="first_name" name="first_name" value="<?php echo $_GET['first_name']; ?>">
				<input type="hidden" id="last_name" name="last_name" value="<?php echo $_GET['last_name']; ?>">
				<input type="hidden" id="address" name="address" value="<?php echo $_GET['address']; ?>">
				<input type="hidden" id="city" name="city" value="<?php echo $_GET['city']; ?>">
				<input type="hidden" id="phone_number" name="phone_number" value="<?php echo $_GET['phone_number']; ?>">
				<input id="savePatient" type="submit" name="savePatient" value="Register">
		</div>
	</div>

</body>
<script src="../js/jquery.js"></script>



</html>