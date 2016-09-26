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
	        echo "<h1>Alle studenten</h1>";
	        foreach ($resultObject as $student) {
	            echo "<h3>{$student->student_summary->username}</h3>";

	            echo "<h4>Behaalde badges</h4>";

	            var_dump($student->badge_counts);

	            $badgeCount = 0;
	            for ($i=0; $i <=5 ; $i++) { 
	                $badgeCount += $student->badge_counts->$i;
	            }

	            echo "Badge count:";
	            var_dump($badgeCount);

	            $students[$student->student_summary->nickname] = $badgeCount;
	            //$students[$student->student_summary->username] = $student->student_summary->nickname;
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
	        var_dump($positions);

	        $mysqli=DB::get();

	        $result=$mysqli->query(<<<EOT
	        INSERT INTO leaderboard (course, description, first, second, third)
	        VALUES ("engels", "Leerlingen all time", "{$positions[0]}", "{$positions[1]}", "{$positions[2]}")
EOT
	        );
		}
	}

?>