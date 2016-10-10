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

			// $data = [
			// 	"today" => $rowToday,
			// 	"yesterday" => $rowYesterday
			// ];

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
	        VALUES ("Engels", "Alle leerlingen", "{$positions[0]}", "{$positions[1]}", "{$positions[2]}")
EOT
	        );
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
			$link = mysqli_connect("localhost", "root", "", "leaderboard");
			$mysqli=DB::get();
			$session_json = str_replace("//","dit teken kan er niet in", $session_json);
	        $session_json = mysqli_real_escape_string ($link, $session_json );
	        $result=$mysqli->query(<<<EOT
	        INSERT INTO session (session)
	        VALUES ("{$session_json}")
EOT
	        );
		}
	}

?>