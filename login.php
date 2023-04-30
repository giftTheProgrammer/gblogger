<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/blogger.css" />
	<link rel="stylesheet" type="text/css" href="css/gAuthForm.css" />
</head>
<body>
	<div class="body-wrapper">
		
		<div id="top-menu">
			<div id="center-nav">
				<a class="top_menu_item" href="#">Home</a>	
				<a class="top_menu_item" href="#">What We Do</a>
				<a class="top_menu_item" href="#">About Us</a>
				<a class="top_menu_item" href="#">Contact</a>
			</div>
		</div>

		<div id="auth_form">
			<form id="signin_form" method="POST" action="getInside.php">
				<?php
					if( isset($_GET['error']) ){
						echo "<p class='error'>" . $_GET['error'] . "</p>";
					}
				?>
				<div class="inLabel">
					<label for="emailAddr">Email Address:</label>
				</div>
				<div class="inData">
					<input type="email" name="email_addr" id="emailAddr" />
				</div>
				<div class="inLabel">
					<label for="passCode">Password:</label>
				</div>
				<div class="inData">
					<input type="password" name="passPhrase" id="passCode" />
				</div>
				<div class="saving">
					<input type="submit" value="Login" />
				</div>
				<p>Don't have an account? <a href="signup.php">SignUp</a></p>
			</form>
		</div>
	</div>
</body>
</html>