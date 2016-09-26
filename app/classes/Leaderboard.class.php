<?php



	Class Leaderboard
	{
		public static function getData()
		{
			$mysqli=DB::get();

			$result=$mysqli->query(<<<EOT
			SELECT * FROM leaderboard
EOT
			);
			$row=$result->fetch_assoc();
			return $row;
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
	        VALUES ("engels", "Leerlingen all time", "{$positions[0]}", "{$positions[1]}", "{$positions[2]}")
EOT
	        );
		}
	}

?>