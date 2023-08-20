<?php
session_start();

if (isset($_SESSION['uEmail']) && isset($_SESSION['uId'])) {
	$comment_content = $_POST['comment'];
	$idOfArticle = $_GET['articleId'];
	echo $comment_content;
	echo "The user id is " . $_SESSION['uId'];
	include "dbConn.php";

	$sql = "INSERT INTO comments (comment, userId, articleId) VALUES('" . $comment_content . "', " . $_SESSION['uId'] . ", " . $idOfArticle . ")";

	if ($conn->query($sql) === TRUE) {
		$conn->close();
		header("Location: article.php?id=". $_GET['articleId']);
		exit();
	}else{
		header("Location: article.php?id=". $_GET['articleId'] . "&error=Comment not submitted");
	}
}else{
	header("Location: login.php");
}



?>