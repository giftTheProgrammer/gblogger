<?php
  session_start();
  if ( !$_SESSION['uEmail'] ) {
    header("Location: login.php");
    exit();
  }


include "dbConn.php";

if ( $conn->connect_error ){
  die( "Could not connect to DB: " . $conn->connect_error );
}

if( isset($_SESSION['pro_id']) ){
  $proId = $_SESSION['pro_id'];
  echo "This is the profile ID: " . $proId;
  echo "<br />";
  $article_heading = $_POST['title'];
  $article_body = $_POST['article-content'];

  $sql = "INSERT INTO articles (profileId, title, body) VALUES( $proId,'".$article_heading ."','".$article_body ."')";

  if ( $conn->query($sql) === TRUE ) {
    echo "<p>Record created successfully!</p>";
    header("Location: create-article.php");
    exit();
  } else {
    echo "<br />Error:" . $sql . "<br />" . $conn->error;
    // header("Location: create-article.php?error=Record not created successfully!");
    exit();
  }
} else {
  echo "<p>User profile unknown.</p>";
}

?>