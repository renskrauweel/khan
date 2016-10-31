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
	require_once("../modules/rekenen/api/ka_client.php");
  $data = Leaderboard::getData();
  //var_dump($data);


 ?>
	<div class="background">
 		<div id="slides">
			<div class="slides-container">
     			<?php

     			if (count($data['yesterday']) <= count($data['today'])) {
     				$length = count($data['today']);
     			}else{
     				$length = count($data['yesterday']);
     			}

     			$data = Leaderboard::repairLeaderboardArray($data);
				for($i =0; $i<= $length -1; $i++) {

				//var_dump($i);
				echo <<<EOT
	
				<div class="{$data['today'][$i]['course']} single-slide">
					<div class="header"></div>
	     			 	<div class="class-mid">
		     			 
		     				</div>
		     				<div class="content">

		   					<div class="class-left">

							<h2>{$data['today'][$i]['description']}</h2>
							</div>

							<div class="class-right">
							<h2>GISTEREN</h2>
								<ol>
									<li class="gold"><span>{$data['yesterday'][$i]['first']}</span></li>
									<li class="silver"><span>{$data['yesterday'][$i]['second']}</span></li>
									<li class="bronze"><span>{$data['yesterday'][$i]['third']}</span></li>
								</ol>
							<h2>VANDAAG</h2>
								<ol>
									<li class="gold"><span>{$data['today'][$i]['first']}</span></li>
									<li class="silver"><span>{$data['today'][$i]['second']}</span></li>
									<li class="bronze"><span>{$data['today'][$i]['third']}</span></li>
								</ol>
							</div>
						</div>	
						
				</div>
EOT;
				}
     			

 				?>
 			</div>
		</div>
	</div>
</body>
</html>