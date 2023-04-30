<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Create Article</title>
	<link rel="stylesheet" type="text/css" href="css/blogger.css" />
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
						<button onclick="myFunction()" class="top_right_menu_item" id="dropit">
							<?php
							if (isset($_SESSION['uEmail'])) {
							  	echo $_SESSION['uEmail'];
							  }  
							?>
						</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="deuces.php">Logout</a>
							<a href="#">Link 2</a>
							<a href="#">Link 3</a>
						</div>
					</div>
				</div>
			</div>
			<div class="main-view">
				<form id="signup_form" method="POST" action="register.php">
					<?php
						if( isset($_GET['error']) ){
							echo "<p class='error'>" . $_GET['error'] . "</p>";
						}
					?>
					<div class="inLabel">
						<label for="titleLabel">Title</label>
					</div>
					<div class="inData">
						<input type="text" name="title" id="titleLabel" />
					</div>
					<div class="inLabel">
						<label for="article-body">Body</label>
					</div>
					<div class="inData">
						<textarea type="text" name="article-content" id="article-body"></textarea>
					</div>
					<div class="saving">
						<input type="submit" value="Register" />
					</div>
					
				</form>
			</div>
			
		</div>
	</div>
</body>
</html>