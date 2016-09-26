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

 ?>
	<div class="logo"><img src="images/logo_plain.png" alt="logo"></div>
	 <div id="slides">
    <div class="slides-container">
      <?php 
				$data = Leaderboard::getData();
				echo <<<EOT
      <div class="single-slide">
	      <h1>{$data['description']}</h1>
	    

				<div class="player_list">
					<ol>
						<li>{$data['first']}</li>
						<li>{$data['second']}</li>
						<li>{$data['third']}</li>
					</ol>
				</div>



      </div>
      <div class="single-slide"><h1>{$data['description']}</h1></div>
     </div>

EOT;
 			?>

    <nav class="slides-navigation">
      <a href="#" class="next">Next</a>
      <a href="#" class="prev">Previous</a>
    </nav>
  </div>

</body>
</html>