<?php
session_start();
?>

<!DOCTYPE html>
<html>
<body>
<?php
$serverName = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "giftedblog";

$conn = new mysqli( $serverName, $dbUser, $dbPass, $dbName );

$mailingAddr = $_POST['email_addr'];
$passes = $_POST["passPhrase"];


$sql = "SELECT * FROM users WHERE email_addr='" . $mailingAddr . "' LIMIT 1";

if ( $conn->connect_error ) {
	die("Error " . $sql . " " . $conn->connect_error);
	
} 
$result = $conn->query( $sql );


if ($result->num_rows == 1) {


	$row = $result->fetch_assoc();
	echo "<p>id: " . $row['id'] . " - Email: " . $row['email_addr'] . " - Pass: " . $row['passcode'] . "</p>";

	if ( password_verify($passes, $row["passcode"]) ) {
		$_SESSION['uEmail'] = $row["email_addr"];
		$_SESSION['uId'] = $row['id'];
		$_SESSION['uPassCode'] = $row['passcode'];

		$sql2 = "SELECT * FROM profiles WHERE user_id=" . $_SESSION['uId'] . " LIMIT 1";
		$result2 = $conn->query( $sql2 );

		if ( $result2->num_rows > 0 ) {
			$row2 = $result2->fetch_assoc();
			$_SESSION['pro_id'] = $row2['profileId'];
			$_SESSION['lastName'] = $row2['last_name'];
			$_SESSION['firstName'] = $row2['first_name'];
			$_SESSION['gender'] = $row2['sex'];
			$_SESSION['occupation'] = $row2['occupation'];
			$_SESSION['pro_pic'] = $row2['profile_pic'];
		}
	}
	
	$conn->close();
	
	if ( isset( $_SESSION['uEmail'] ) ) {
		header("Location: Welcome.php");
		exit();
	} else {
		header("Location: login.php?error=Incorrect username or password!");
		exit();
	}
	

} else {
	header("Location: login.php?error=Incorrect username or password!");
	exit();
}

?>
</body>
</html>