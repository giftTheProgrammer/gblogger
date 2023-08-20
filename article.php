<?php
  session_start();
  if ( !$_SESSION['uEmail'] ) {
    header("Location: login.php");
    exit();
  }
?>

<!DOCTYPE html>
<html>
<head>
<title>G Blogger</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway" />
<link rel="stylesheet" type="text/css" href="css/blogger.css" />
<link rel="stylesheet" type="text/css" href="fontawesome-free-5.15.4-web/css/all.css" />
<style>
  body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
</head>
<body>
<div id="dashboard-layout">
    <aside id="side-nav">
      <ul>
        <li><a href="welcome.php">Dashboard</a></li>
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
        <!-- Header -->
        <header class="w3-container w3-center w3-padding-32"> 
          <h1><b>MY BLOG</b></h1>
          <p>Welcome to the blog of <span class="w3-tag">Gifted</span></p>
          <div><a href="create-article.php"><i class="fas fa-plus fa-lg" style="color: green;"></i></a></div>
        </header>
        <div class="w3-container w3-light-grey">
          
              <?php
                include "dbConn.php";
                $sql = "SELECT * FROM articles WHERE articleId=" . $_GET['id'];

                if( $conn->connect_error ){
                  die( "Error: " . $sql . " ==> " . $conn->connect_error );
                }
                $result = $conn->query( $sql );

                if ( $result->num_rows > 0 ) {
                  $row = $result->fetch_assoc();
                    
                  echo "<h1>" . $row["title"] . "</h1>";
                  echo "<p>" . $row["body"] . "</p>";
                  ?>
                  <form action="makeComment.php?articleId=<?= $_GET['id'] ?>" method="POST">
                    <input type="text" name="comment" placeholder="Write your comment here" />
                    <input type="submit" value="POST COMMENT" />
                  </form>
                <?php }else {
                    echo "<tr>There are no articles just yet. Create one</tr>";
                  }
              ?>
              
            
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