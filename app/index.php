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
  //var_dump($data);
  $classes = Leaderboard::sortByClass(fopen("klassen.csv","r"));
 ?>
	<div class="logo">
		<img src="images/logo_plain.png" alt="logo">
	</div>
 		<div id="slides">
			<div class="slides-container">

     			<?php 
     			
     			//foreach ($data as $row => $rows) {
//var_dump(count($data['yesterday']));
     				//var_dump($rows);
//var_dump(count($data['yesterday']));
//var_dump(count($data['today']));
     			if (count($data['yesterday']) <= count($data['today'])) {
     				$length = count($data['today']);
     			}else{
     				$length = count($data['yesterday']);
     			}
				for($i =0; $i<= $length -1; $i++) {
					if($i >= count($data['yesterday']) )
					{
						$data['yesterday'][$i]['first'] = "";
						$data['yesterday'][$i]['second'] = "";
						$data['yesterday'][$i]['third'] = "";
					}
					if ($i >= count($data['today'])) {
						$data['today'][$i]['first'] = "";
						$data['today'][$i]['second'] = "";
						$data['today'][$i]['third'] = "";
						$data['today'][$i]['description'] = $data['yesterday'][$i]['description'];
						$data['today'][$i]['course'] = $data['yesterday'][$i]['course'];
					}
          if (empty($data['today'][$i]['first'])) {
            $data['today'][$i]['first'] = "-";
          }
          if (empty($data['today'][$i]['second'])) {
            $data['today'][$i]['second'] = "-";
          }
          if (empty($data['today'][$i]['third'])) {
            $data['today'][$i]['third'] = "-";
          }
          if (empty($data['yesterday'][$i]['first'])) {
            $data['yesterday'][$i]['first'] = "-";
          }
          if (empty($data['yesterday'][$i]['second'])) {
            $data['yesterday'][$i]['second'] = "-";
          }
          if (empty($data['yesterday'][$i]['third'])) {
            $data['yesterday'][$i]['third'] = "-";
          }

					//var_dump($i);
					echo <<<EOT
					
				<div class="single-slide">
     				<div class="content">

     			 		<div class="class-mid">
	     				 	<h2>{$data['today'][$i]['course']} - {$data['today'][$i]['description']}</h2>
	     				 </div>

	   					<div class="class-left">
						<h2>GISTEREN</h2>
							<ol>
								<li class="gold"><span>{$data['yesterday'][$i]['first']}</span></li>
								<li class="silver"><span>{$data['yesterday'][$i]['second']}</span></li>
								<li class="bronze"><span>{$data['yesterday'][$i]['third']}</span></li>
							</ol>
						</div>

						<div class="class-right">
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
</body>
</html>