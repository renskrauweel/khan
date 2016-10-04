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
			$link = mysqli_connect("localhost", "root", "root", "leaderboard");
			$mysqli=DB::get();
			$session_json = str_replace("//","dit teken kan er niet in", $session_json);
	        $session_json = mysqli_real_escape_string ($link, $session_json );
	        $result=$mysqli->query(<<<EOT
	        INSERT INTO session (session)
	        VALUES ("{$session_json}")
EOT
	        );
		}