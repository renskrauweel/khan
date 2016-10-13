<?php



	Class Leaderboard
	{
		public static function getData()
		{
			//Dates
			$today = date("o-m-d");
			$yesterday = date("o-m-d", strtotime("-1 days"));
			
			$mysqli=DB::get();
			$yx = 0;
			$tx = 0;
			//Today
			$resultToday=$mysqli->query(<<<EOT
			SELECT * FROM leaderboard WHERE date LIKE "%{$today}%"
EOT
			);
			while ($rowToday=$resultToday->fetch_assoc()){
				$data['today'][$tx] = $rowToday;
				$tx++;

			}
			
			//Yesterday
			$resultYesterday=$mysqli->query(<<<EOT
			SELECT * FROM leaderboard WHERE date LIKE "%{$yesterday}%"
EOT
			);
			while ($rowYesterday=$resultYesterday->fetch_assoc()){
				$data['yesterday'][$yx] = $rowYesterday;
				$yx++;
			}

			return ($data);
		}
 


		public static function getStudentsAlltime($resultObject)
		{
			//students
	        $students = [];
	        foreach ($resultObject as $student) {
	            $badgeCount = 0;
	            for ($i=0; $i <=5 ; $i++) { 
	                $badgeCount += $student->badge_counts->$i;
	            }
	            $students[$student->student_summary->nickname] = $badgeCount;
	        }
	        arsort($students);
	        return $students;
		}

		public static function insertStudents($students)
		{
	        //insert to DB
	        $positions = [];
	        foreach ($students as $nickname => $badgeCount) {
	            $positions[] = $nickname;
	        }

	        $mysqli=DB::get();

	        $result=$mysqli->query(<<<EOT
	        INSERT INTO leaderboard (course, description, first, second, third)
	        VALUES ("Rekenen", "Alle leerlingen", "{$positions[0]}", "{$positions[1]}", "{$positions[2]}")
EOT
	        );
		}

		public static function insertStudentsByClass($studentsByClass) {
			foreach ($studentsByClass as $class => $students) {
                arsort($students);
                $description = $class;
                $counter = 1;
                $first = "";
                $second = "";
                $third = "";
                foreach ($students as $student => $badgeCount) {
                    switch ($counter) {
                        case 1:
                            if (!empty($student)) {
                                $first = $student;
                            }
                            break;
                        case 2:
                            if (!empty($student)) {
                                $second = $student;
                            }
                            break;
                        case 3:
                            if (!empty($student)) {
                                $third = $student;
                            }
                            break;
                        
                        default:
                            break;
                    }
                    $counter++;
                }
                /*
                    echo "<b>Description: {$description}</b><br>";
                    echo "First: {$first}<br>";
                    echo "Second: {$second}<br>";
                    echo "Third: {$third}<br>";
                    */
                    //Query
                    $mysqli=DB::get();
                    $result=$mysqli->query(<<<EOT
                    INSERT INTO leaderboard (course, description, first, second, third)
                    VALUES ("Rekenen", "{$description}", "{$first}", "{$second}", "{$third}")
EOT
                    );
            }
           
		}

		public static function sortByClass($file)
		{
			$students = [];
			while(! feof($file))
			{
				$line = fgetcsv($file);
				if (!empty($line)) {
					$line = explode(";", $line[0]);
					$students[] = $line;
				}
			}

			fclose($file);

			$classes = [];

			//Setting up classes
			foreach ($students as $student) {
				if(in_array($student[0], $student)) {
					$classes[$student[0]] = [];
				}
			}
					// Eric aproves "Gewoon goed pik" -Eric 2k16
			//Filling classes
			foreach ($classes as $class) {
				foreach ($students as $student) {
					//Adding students to classes
					if ($student[0] == array_key_exists($student[0], $classes)) {
						if (!in_array($student[1], $classes[$student[0]])) {
							$classes[$student[0]][] = $student[1];
						}
					}
				}
			}
			return $classes;
		}
		public static function getSession()
		{
			$mysqli=DB::get();
			$result=$mysqli->query(<<<EOT
			SELECT session FROM session LIMIT 1
EOT
			);
			$session=$result->fetch_assoc();
			$session_return = $session["session"];
			$session_return = str_ireplace("//", "", $session_return);
			$session_return = str_ireplace("dit teken kan er niet in", "//", $session_return);
			return($session_return);
		}
		public static function setSession($session_json)
		{
			$link = mysqli_connect("localhost", "root", "usbw", "leaderboard");
			$mysqli=DB::get();
			$session_json = str_replace("//","dit teken kan er niet in", $session_json);
	        $session_json = mysqli_real_escape_string ($link, $session_json );
	        $result=$mysqli->query(<<<EOT
	        INSERT INTO session (session)
	        VALUES ("{$session_json}")
EOT
	        );
		}

		public static function repairLeaderboardArray($data)
		{
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
			}

			return $data;
		}
	}

?>