<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/custome/login.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	<title>Přihlášení</title>
	<meta charset="utf-8">
</head>

<body>

	<?php if (isset($_GET['login'])) { ?>
		<div class="resend">
			<div class="right"><i class="fas fa-exclamation-circle fa-2x"></i></div>
			<div class="letter">
				<h4>Prosím přihlašte se. Pokud u nás ještě nemáte účet, zaregistrujte se.</h4>
			</div>
		</div>
	<?php } ?>


	<div class="big-box">
		<div class="discrip">
			<div style="width: 650px;height:480px;"><img style="width:650px;height:480px;" src="assets/images/Login.jpg"></div>
		</div>

		<div class="login">
			<h1 style="text-align:center">Přihlášení</h1>
			<form action="../controller/logingController.php" name="login" method="post">
				<?php
				if (isset(($_GET['errors']))) {
					echo "<p class='error'>Špatný email nebo heslo.</p>";
				}
				?>

				<p>Email</p>
                <input type="text" name="username" placeholder="Zadejte emailovou adresu">
                <p>Heslo</p>
                <input type="password" name="password" placeholder="Zadejte heslo">

				<input type="submit" name="login" value="Login">

				<p style="font-weight: bolder; font-size:15px;color:#101e5a;">Nemáte u nás založený účet? <a style="color:#5d80b6;" href="register.php">Zaregistrujte se</a></p>
			</br>
			</br>
				<center><p style="font-weight: bolder; font-size:15px;color:#101e5a;">Jít zpět na <a style="color:#5d80b6;" href="../../index.php"> hlavní stránku</a></p></center>

			</form>
		</div>
	</div>

</body>

</html>