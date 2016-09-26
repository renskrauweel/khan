<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" >
	<link href="https://fonts.googleapis.com/css?family=Cabin" rel="stylesheet">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="javascripts/jquery.easing.1.3.js"></script>
	<script src="javascripts/jquery.animate-enhanced.min.js"></script>
	<script src="dist/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
  <script>
    $(function() {
      $('#slides').superslides({
        hashchange: true
      });
    });
  </script>
	<title>Khan Board</title>
</head>
<body>
<?php 
	require_once("autoload.php");
	var_dump(Leaderboard::getData());
 ?>
	<div class="logo"><img src="images/logo_plain.png" alt="logo"></div>
	 <div id="slides">
    <div class="slides-container">
      <div class="single-slide">
	      <h1>I403A</h1>
	      <li></li>
      </div>
      <div class="single-slide"><h1>I403B</h1></div>
     </div>

    <nav class="slides-navigation">
      <a href="#" class="next">Next</a>
      <a href="#" class="prev">Previous</a>
    </nav>
  </div>

</body>
</html>