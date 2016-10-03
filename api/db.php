<?php

	mb_internal_encoding("UTF-8");

	define('DB_HOST', 'localhost');
	define('DB_LOGIN', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_DATABASE', 'leaderboard');


	class DB extends mysqli {

		private static $objDB = NULL;

		public static function get() {
			if (empty(self::$objDB)) self::$objDB = new self();
			return(self::$objDB);
		}

		public function __construct() {
			parent::__construct(DB_HOST, DB_LOGIN, DB_PASSWORD, DB_DATABASE);
			if ($this->connect_errno) {
				 throw new Exception('MySQLi connection failed: ' . $this->connect_error);
			}
			// Set UTF-8 for database-connection
			if (!$this->set_charset('utf8')) {
				throw new Exception('MySQLi set charset utf8 failed: '. $this->error);
			}
		}

		public function query($query_string) {
			$result=parent::query($query_string);
			// Error check
			if (!$result) {
				throw new Exception('MySQLi query error: ' . $this->error);
			}
			return($result);
		}

	}

?>
