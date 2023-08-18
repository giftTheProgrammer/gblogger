<?php
	session_start();
	if ( !$_SESSION['uEmail'] ) {
		header("Location: login.php");
		exit();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>User profile</title>
	<link rel="stylesheet" type="text/css" href="css/blogger.css" />
</head>
<body>
	<?php
		include("dbConn.php");
		$sql = "SELECT * FROM profiles WHERE user_id=" . $_SESSION['uId'] . " LIMIT 1";
		if ( $conn->connect_error ) {
			die("Error " . $sql . " " . $conn->connect_error);
		}
		$result = $conn->query( $sql );

		if ($result->num_rows == 1) {
			while( $row = $result->fetch_assoc() ){
				$_SESSION['proId'] = $row['profileId'];
				
				$_SESSION['lastName'] = $row['last_name'];
				
				$_SESSION['firstName'] = $row['first_name'];
				
				$_SESSION['gender'] = $row['sex'];
				
				$_SESSION['occupation'] = $row['occupation'];
				
				$_SESSION['proImage'] = $row['profile_pic'];
				
			}


		} else {
			header("Location: init-profile.php");
			exit();
		}
		
	?>
	<div id="dashboard-layout">
		<aside id="side-nav">
			<ul>
				<li><a href="Welcome.php">Dashboard</a></li>
				<li><a href="articles.php">Articles</a></li>
				<li>Users</li>
			</ul>
		</aside>
		<div id="main-display">
			<div id="top-menu">
				<div id="far-right">
					<div id="right-nav">
						<div class="profile-frame">
							<?php

							if( isset( $_SESSION['pro_pic'] ) && $_SESSION['pro_pic'] != "no_image_yet.jpg"){
								echo "<img src=photos/" . $_SESSION['pro_pic'] . " width='48' height='48' />";
							}else{
								echo "<img src='photos/no_image_yet.jpg' width='48' height='48' />";
							}
							?>
							
						</div>
						
						<button onclick="myFunction()" class="top_right_menu_item" id="dropit">
							<?php echo $_SESSION['uEmail'];	?>
						</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="my-profile.php">Profile</a>
							<a href="deuces.php">Logout</a>
							<a href="#">Link 3</a>
						</div>
					</div>
				</div>
			</div>

			<div id="profile-content">
				<table>
					<tr>
						<td>ID:</td>
						<td><?php echo $_SESSION['proId']; ?></td>
					</tr>
					<tr>
						<td>Last Name:</td>
						<td><?php echo $_SESSION['lastName']; ?></td>
					</tr>
					<tr>
						<td>First Name:</td>
						<td><?php echo $_SESSION['firstName']; ?></td>
					</tr>
					<tr>
						<td>Gender:</td>
						<td><?php echo $_SESSION['gender']; ?></td>
					</tr>
					<tr>
						<td>Occupation:</td>
						<td><?php echo $_SESSION['occupation']; ?></td>
					</tr>

				</table>
			</div>
		</div>
		
	</div>

	<script type="text/javascript">
		function myFunction() {
			document.getElementById("myDropdown").classList.toggle("show");

			// close the dropdown if user clicks anywhere else on the screen
			window.onclick = function(event){
				if (!event.target.matches("top_right_menu_item")) {
					var dropdowns = document.getElementByClassName("dropdown-content");
					var i;
					for (i = 0; i < dropdowns.length; i++){
						var openDropdowns = dropdowns[i];
						if (openDropdowns.classList.contains('show')) {
							openDropdowns.classList.remove('show');
						}
					} // end of for loop
				}
			}

		} // end of myFunction
	</script>
</body>
</html>