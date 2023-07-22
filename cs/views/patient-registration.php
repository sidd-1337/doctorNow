<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/custome/register.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	<title>Registrace</title>
	<meta charset="utf-8">
</head>

<body>
	<div class="background-img1"><img src="assets/images/proffesionals.jpg" alt="" ></div>
	<div class="container">
		<div class="para">
			<h1><b>R</b>egistrace <b>P</b>acienta</h1>
			<h2 style="text-align: center">Milí pacienti</h2>
			<p style="text-align: center">Objevte revoluci v zdravotnictví díky možnosti online objednání. </br> 
			Zaregistrujte se nyní!</p>
		</div>
		<div class="register">
			<form method="post" id="patientReg" action="../controller/registerController.php" enctype="multipart/form-data">
				<?php
				if (isset($_GET['errPass'])) {
					echo "<span class='error' style='font-size:x-small'>" . $_GET['errPass'] . "</span>";
				}
				?>
				<p>Heslo<span class="error" id="passError"></p>
				<input type="password" id="password" name="password" placeholder="Zadejte heslo" required>

				<p>Potvrzení hesla<span class="error"></p>
				<input type="password" id="confirmpassword" name="confirmpassword" placeholder="Potvrďte heslo" required>
				<h6>*Heslo musí obsahovat minimálně 8 znaků, alespoň 1 velké písmeno, 1 malé písmeno a 1 číslo.</h6>
				<!-- <div class="agreement">
					<div class="term"><b>Term and condition</b></div> 
					<textarea name="aggrement" id="1" cols="10" rows="10">
1. This is a Web platform for finding boarding places.We do not assure you about your sensitive information(ex: creadit card details). Please create a payhere account before you making online payments.
2. We will use your location information to provide you better experience. We do not store any searching information or location information in our platform.
					</textarea>
				</div> -->
				<!-- <div class="check">
					 <input id="check"  type="checkbox" name="check">
					 <div class="agree"> I am agree with term and condition</div> 
				</div> -->
				<input type="hidden" id="email" name="email" value="<?php echo $_GET['email']; ?>">
				<input type="hidden" id="first_name" name="first_name" value="<?php echo $_GET['first_name']; ?>">
				<input type="hidden" id="last_name" name="last_name" value="<?php echo $_GET['last_name']; ?>">
				<input type="hidden" id="address" name="address" value="<?php echo $_GET['address']; ?>">
				<input type="hidden" id="city" name="city" value="<?php echo $_GET['city']; ?>">
				<input type="hidden" id="phone_number" name="phone_number" value="<?php echo $_GET['phone_number']; ?>">
				<input id="savePatient" type="submit" name="savePatient" value="Zaregistrovat se">
			</form>
		</div>
	</div>

</body>
<script src="../../js/jquery.js"></script>



</html>