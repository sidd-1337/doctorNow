<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/custome/register.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	<title>Registrace</title>
	<meta charset="utf-8">
</head>

<body>
	<div class="background-img1"><img src="assets/images/doctor.jpg" alt=""></div>
	<div class="container">
		<div class="para">
			<h1><b>R</b>egistrace <b>D</b>oktora</h1>
			<h2 style="text-align: center">Pane/Paní Doktore/Doktorko</h2>
			<p style="text-align: center">Vítejte, děkujeme, že jste si zvolili Lékař Ihned jako svůj objednávkový systém.</br>
			 Registrovaní doktoři mají přístup k velké škále výhod a dokáží tak rychleji zpracovávat a plánovat své návštěvy</br> 
			 Pro registraci prosím vyplňte všechny údaje.</br></p>
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

					<option value="Cardiologist">Kardiolog</option>
					<option value="Orthopedist">Ortoped</option>
					<option value="Internal Medicine">Interní ambulance</option>
					<option value="Dermatologist">Dermatologie</option>
					<option value="Pediatrist">Pediatr</option>
					<option value="ENT">ORL</option>
					<option value="General Practitioner">Praktický lékař</option>
				</select>
				<!-- </div> -->
				<!-- <p>Specialization <span class="error" id="specError"></p>
				<input type="text" id="specialization" name="specialization" placeholder="eg : heart"> -->

				<p>Licence<span class="error" id="licenseError"></p>
				<input type="text" id="license" name="license" placeholder="Číslo licence" required>

				<p>Nahrejte svůj diplom<span class="error" id="diplomaError"></p>
				<!-- <input type="text" id="diploma" name="diploma" placeholder="Enter Diploma"> -->
				<input type="file" name="certificate" id="certificate" required><br>

				<p>Heslo<span class="error" id="passError"></p>
				<input type="password" id="password" name="password" placeholder="Zadejte heslo" required>

				<p>Potvrzení hesla<span class="error"></p>
				<input type="password" id="confirmpassword" name="confirmpassword" placeholder="Potvrďte heslo" required>
				<h6>*Heslo musí obsahovat minimálně 8 znaků, alespoň 1 velké písmeno, 1 malé písmeno a 1 číslo.</h6>

				<input type="hidden" id="email" name="email" value="<?php echo $_GET['email']; ?>">
				<input type="hidden" id="first_name" name="first_name" value="<?php echo $_GET['first_name']; ?>">
				<input type="hidden" id="last_name" name="last_name" value="<?php echo $_GET['last_name']; ?>">
				<input type="hidden" id="address" name="address" value="<?php echo $_GET['address']; ?>">
				<input type="hidden" id="city" name="city" value="<?php echo $_GET['city']; ?>">
				<input type="hidden" id="phone_number" name="phone_number" value="<?php echo $_GET['phone_number']; ?>">
				<input id="saveDoctor" type="submit" name="saveDoctor" value="Zaregistrovat se">
			</form>
		</div>
	</div>
</body>
<script src="../../js/jquery.js"></script>


</html>