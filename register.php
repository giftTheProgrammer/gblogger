<?php
$serverName = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "giftedblog";

$conn = new mysqli( $serverName, $dbUser, $dbPass, $dbName );

if ( $conn->connect_error ){
	die( "Could not connect to DB: " . $conn->connect_error );
}

$mailingAddr = $_POST['email_addr'];
$passes = $_POST["passPhrase"];

$hashedPass = password_hash($passes, PASSWORD_DEFAULT);

echo "<!DOCTYPE html>";
echo "<html>";
echo "<body>";
echo "<p>";
echo "Your email is " . $mailingAddr . " and your password is " . $passes;
echo "</p>";
echo "<p>";
echo "Your email is " . $mailingAddr . " and your password has is " . $hashedPass;
echo "</p>";

$sql = "INSERT INTO users (email_addr, passcode) VALUES ('". $mailingAddr . "', '". $hashedPass . "')";

if ( $conn->query($sql) === TRUE ) {
	echo "<p>Record created successfully!</p>";
	header("Location: login.php");
	exit();
} else {
	header("Location: signup.php?error=Record not created successfully!");
	exit();
}

echo "</body>";
echo "</html>";


?>