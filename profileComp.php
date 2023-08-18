<?php
session_start();
include("dbConn.php");

if ( isset( $_POST['lastName'] ) ) {
	$surname = $_POST['lastName'];
}else{
	header("Location: init-profile.php?error=Last name is required");
	exit();
}

if ( $_POST['firstName'] ) {
	$firstName = $_POST['firstName'];
}else{
	header("Location: init-profile.php?error=First name is required");
	exit();
}

if ( $_POST['sex'] ) {
	$sex = $_POST['sex'];
}else{
	header("Location: init-profile.php?error=Gender is required");
	exit();
}

if ( $_POST['occupation'] ) {
	$profession = $_POST['occupation'];


	if ( file_exists( $_FILES['pro_image']['tmp_name'] ) ) {
		$target_dir = "photos/";
		$target_file = $target_dir . basename( $_FILES['pro_image']["name"] );
		$pro_pic = basename( $_FILES['pro_image']["name"] );
		$uploadOk = 1;
		$imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION) );

		// Check if the image is fake or not
		if ( isset( $_POST['submit'] ) ) {
			$check = getimagesize( $_FILES['pro_image']["tmp_name"]);
			if ( $check == FALSE ) {
				echo "File is an image " . $check["mime"];
				$uploadOk = 1;
			} else{
				echo "";
				header("Location: init-profile.php?error=File is not an image.");
		  		exit();
				$uploadOk = 0;
			}
			
		}

		// Check if file already exists
		if ( file_exists($target_file) ) {
		  header("Location: init-profile.php?error=Sorry, file already exists.");
		  exit();
		  $uploadOk = 0;
		}

		// Check file size
		if ( $_FILES["pro_image"]["size"] > 1024000 ) {
		  header("Location: init-profile.php?error=Sorry, your file is too large [1MB].");
		  exit();
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			header("Location: init-profile.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
		    exit();
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ( $uploadOk == 0 ) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["pro_image"]["tmp_name"], $target_file)) {
		    echo "The file ". htmlspecialchars( basename( $_FILES["pro_image"]["name"])). " has been uploaded.";

		  } else {
		  	header("Location: init-profile.php?error=Sorry, there was an error uploading your file.");
		    exit();
		  }
		}

	} else{
		$pro_pic = "no_image_yet.jpg";
	}

	$sql = "INSERT INTO profiles (user_id, last_name, first_name, sex, occupation, profile_pic)" .
		    " VALUES (".$_SESSION['uId'].",'".$_POST['lastName']."','".$_POST['firstName'].
		    	"','".$_POST['sex']."','".$_POST['occupation']."','".$pro_pic."')";

    if ( $conn->query($sql) === TRUE ) {
    	$conn->close();

    	$conn2 = new mysqli( $serverName, $dbUser, $dbPass, $dbName );

    	// Check connection
    	if ($conn2 -> connect_errno) {
		  echo "Failed to connect to MySQL: " . $conn2 -> connect_error;
		  exit();
		}
		
    	$sql2 = "SELECT * FROM profiles WHERE user_id=" . $_SESSION['uId'] . " LIMIT 1";
		$result2 = $conn2->query( $sql2 );
		$row2 = $result2->fetch_assoc();
    	$_SESSION['pro_id'] = $row2['profileId'];
		$_SESSION['lastName'] = $row2['last_name'];
		$_SESSION['firstName'] = $row2['first_name'];
		$_SESSION['gender'] = $row2['sex'];
		$_SESSION['occupation'] = $row2['occupation'];
		$_SESSION['pro_pic'] = $row2['profile_pic'];

		echo "ProfileId = " . $_SESSION['pro_id'];
		echo "Last Name = " . $_SESSION['lastName'];
		echo "First Name = " . $_SESSION['firstName'];
		echo "Gender = " . $_SESSION['gender'];
		echo "Occupation = " . $_SESSION['occupation'];
		echo "Profile Picture = " . $_SESSION['pro_pic'];
		
		$conn2->close();
		header("Location: my-profile.php");
		exit();
	} else {
		header("Location: init-profile.php?error=Profile not created successfully!1");
		exit();
	}
	

}else{
	if ( file_exists( $_FILES['pro_image']["tmp_name"] ) ) {
		$target_dir = "photos/";
		$target_file = $target_dir . basename( $_FILES['pro_image']["name"] );
		$pro_pic = basename( $_FILES['pro_image']["name"] );
		$uploadOk = 1;
		$imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION) );

		// Check if the image is fake or not
		if ( isset( $_POST['submit'] ) ) {
			$check = getimagesize( $_FILES['pro_image']["tmp_name"]);
			if ( $check == FALSE ) {
				echo "File is an image " . $check["mime"];
				$uploadOk = 1;
			} else{
				echo "";
				header("Location: init-profile.php?error=File is not an image.");
		  		exit();
				$uploadOk = 0;
			}
			
		}

		// Check if file already exists
		if ( file_exists($target_file) ) {
		  header("Location: init-profile.php?error=Sorry, file already exists.");
		  exit();
		  $uploadOk = 0;
		}

		// Check file size
		if ( $_FILES["pro_image"]["size"] > 1024000 ) {
		  header("Location: init-profile.php?error=Sorry, your file is too large [1MB].");
		  exit();
		  $uploadOk = 0;
		}

		// Allow certain file formats
		if( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			header("Location: init-profile.php?error=Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
		    exit();
		  $uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ( $uploadOk == 0 ) {
		  echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES["pro_image"]["tmp_name"], $target_file)) {
		    echo "The file ". htmlspecialchars( basename( $_FILES["pro_image"]["name"])). " has been uploaded.";

		  } else {
		  	header("Location: init-profile.php?error=Sorry, there was an error uploading your file.");
		    exit();
		  }
		}

	} else{
		$pro_pic = "no_image_yet.jpg";
	}

	$sql = "INSERT INTO profiles (user_id, last_name, first_name, sex, profile_pic)" .
		    " VALUES (".$_SESSION['uId'].",'".$_POST['lastName']."','".$_POST['firstName'].
		    	"','".$_POST['sex']."','".$pro_pic."')";

    if ( $conn->query($sql) === TRUE ) {
		header("Location: my-profile.php");
		exit();
	} else {
		header("Location: init-profile.php?error=Profile not created successfully!2");
		exit();
	}

	
}



?>