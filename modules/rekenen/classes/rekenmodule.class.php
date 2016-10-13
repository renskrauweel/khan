<?php

	include_once("../../module.class.php");

	Class RekenModule extends Module
	{
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
	}

?>