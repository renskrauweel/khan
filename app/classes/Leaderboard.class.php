<?php



	Class Leaderboard
	{
		public static function getData()
		{
			//Dates
			$today = date("o-m-d");
			$yesterday = date("o-m-d", strtotime("-1 days"));
			
			$mysqli=DB::get();

			//Today
			$resultToday=$mysqli->query(<<<EOT
			SELECT * FROM leaderboard WHERE date LIKE "%{$today}%"
EOT
			);
			$rowToday=$resultToday->fetch_assoc();

			//Yesterday
			$resultYesterday=$mysqli->query(<<<EOT
			SELECT * FROM leaderboard WHERE date LIKE "%{$yesterday}%"
EOT
			);
			$rowYesterday=$resultYesterday->fetch_assoc();
			
			$data = [
				"today" => $rowToday,
				"yesterday" => $rowYesterday
			];

			return $data;
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
	        VALUES ("engels", "Alle leerlingen", "{$positions[0]}", "{$positions[1]}", "{$positions[2]}")
EOT
	        );
		}

		public static function sortByClass($file)
		{
			$classes = [];
			while(! feof($file))
			{
				$line = fgetcsv($file);

				$line = explode(";", $line[0]);
				$classes[] = $line;
			}

			fclose($file);
			var_dump($classes);
		}
	}

?>