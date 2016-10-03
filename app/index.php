<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" type="text/css" >
	<link href="https://fonts.googleapis.com/css?family=PT+Sans|Raleway" rel="stylesheet">
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
  $data = Leaderboard::getData();
  $classes = Leaderboard::sortByClass(fopen("klassen.csv","r"));
 ?>
	<div class="logo">
		<img src="images/logo_plain.png" alt="logo">
	</div>
 		<div id="slides">
			<div class="slides-container">
				 <div class="single-slide">
     			 <?php echo <<<EOT

     				<div class="content">

     				
     			 		<div class="class-mid">
	     				 	<h2>{$data['today']['description']}</h2>
	     				 </div>

	   					<div class="class-left">
						<h2>GISTEREN</h2>
							<ol>
								<li class="gold"><span>{$data['yesterday']['first']}</span></li>
								<li class="silver"><span>{$data['yesterday']['second']}</span></li>
								<li class="bronze"><span>{$data['yesterday']['third']}</span></li>
							</ol>
						</div>

						<div class="class-right">
						<h2>VANDAAG</h2>
							<ol>
								<li class="gold"><span>{$data['today']['first']}</span></li>
								<li class="silver"><span>{$data['today']['second']}</span></li>
								<li class="bronze"><span>{$data['today']['third']}</span></li>
							</ol>
						</div>	
					</div>		
EOT;
 				?>
 			</div>
		</div>
	</div>
</body>
</html>