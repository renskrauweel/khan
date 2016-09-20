<?php

	require_once("db.php");

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
	}

?>