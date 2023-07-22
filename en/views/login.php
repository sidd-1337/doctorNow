<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" type="text/css" href="assets/css/custome/login.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap">
	<title>Login form</title>
</head>

<body>

	<?php if (isset($_GET['login'])) { ?>
		<div class="resend">
			<div class="right"><i class="fas fa-exclamation-circle fa-2x"></i></div>
			<div class="letter">
				<h4>Please login first to access this feature</h4>
			</div>
		</div>
	<?php } ?>


	<div class="big-box">
		<div class="discrip">
			<div style="width: 650px;height:480px;"><img style="width:650px;height:480px;" src="assets/images/Login.jpg"></div>
		</div>

		<div class="login">
			<h1 style="text-align:center">User Login!</h1>
			<form action="../controller/logingController.php" name="login" method="post">
				<?php
				if (isset(($_GET['errors']))) {
					echo "<p class='error'>Invalid Username / Password</p>";
				}
				?>

				<p>Username</p>
				<input type="text" name="username" placeholder="Enter Email Address">
				<p>Password</p>
				<input type="password" name="password" placeholder="Enter Password">

				<input type="submit" name="login" value="Login">

				<p style="font-weight: bolder; font-size:15px;color:#101e5a;">Don't have an account ? <a style="color:#5d80b6;" href="register.php"> Sign Up</a></p>
			</br>
			</br>
				<center><p style="font-weight: bolder; font-size:15px;color:#101e5a;">Go to <a style="color:#5d80b6;" href="../../index_en.php"> home page</a></p></center>

			</form>
		</div>
	</div>

</body>

</html>