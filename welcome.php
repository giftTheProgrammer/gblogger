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
	<link rel="stylesheet" type="text/css" href="css/blogger.css" />
	<title>G Blogger</title>
</head>
<body>
	<div id="dashboard-layout">
		<aside id="side-nav">
			<ul>
				<li>Dashboard</li>
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
							if($_SESSION['pro_pic'] != "no_image_yet.jpg"){
								echo "<img src=photos/" . $_SESSION['pro_pic'] . " width='48' height='48' />";
							}else{
								echo "<img src='photos/no_image_yet.jpg' width='48' height='48' />";
							}
							?>
							
						</div>
						
						<button onclick="myFunction()" class="top_right_menu_item" id="dropit">
							<?php
							if (isset($_SESSION['uEmail'])) {
							  	echo $_SESSION['uEmail'];
							  }  
							?>
						</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="my-profile.php">Profile</a>
							<a href="deuces.php">Logout</a>
							<a href="#">Link 3</a>
						</div>
					</div>
				</div>
			</div>
			
			<div class="main-view">
				<div class="directory-header">
					<h2>This is your dashboard.</h2>
				</div>
				<div class="main-content">
					<div class="main-stat"></div>
					<div class="main-stat"></div>
					<div class="main-stat"></div>
					<div class="main-stat"></div>
				</div>
				
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
