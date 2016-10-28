<?php

	include_once(dirname(__FILE__)."/../../module.class.php");

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
                        $today = date("o-m-d");
                        $resultToday=$mysqli->query(<<<EOT
            SELECT id FROM leaderboard WHERE description = "Alle leerlingen" AND course = "rekenen" AND date LIKE "%{$today}%" 
EOT
            );
                        $x = -1;
                        while ($rowToday=$resultToday->fetch_row()){
                            $data = $rowToday[0];
                            $x = $data;
                        }
                        if($x != -1){
                            $result=$mysqli->query(<<<EOT
                                UPDATE leaderboard SET first = "{$positions[0]}", second = "{$positions[1]}", third = "{$positions[2]}", date = NOW() WHERE id = {$data}
EOT
                            );
                        }else {
                  $result=$mysqli->query(<<<EOT
                    INSERT INTO leaderboard (course, description, first, second, third)
                    VALUES ("Rekenen", "Alle leerlingen", "{$positions[0]}", "{$positions[1]}", "{$positions[2]}")
EOT
                    );
                        }
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
                        $today = date("o-m-d");
                        $resultToday=$mysqli->query(<<<EOT
            SELECT id FROM leaderboard WHERE description = "{$description}" AND course = "Rekenen" AND date LIKE "%{$today}%" 
EOT
            );
                        $x = -1;
                        while ($rowToday=$resultToday->fetch_row()){
                            $data = $rowToday[0];
                            $x = $data;
                        }
                        if($x != -1){
                            $result=$mysqli->query(<<<EOT
                                UPDATE leaderboard SET  first = "{$first}", second = "{$second}", third = "{$third}", date = NOW() WHERE id = {$data}
EOT
                            );
                        }else {
                            $result=$mysqli->query(<<<EOT
                INSERT INTO leaderboard (course, description, first, second, third)
                VALUES ("Rekenen", "{$description}", "{$first}", "{$second}", "{$third}")
EOT
                );
                        }
                        
                    
                
            }
           
		}
	}

?>