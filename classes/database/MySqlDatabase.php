<?php

namespace database\MySql;

	class MySqlDatabase
	{

		private static $db_instance;
		private $con;

        private $db_name = DB_NAME;
		private $db_host = DB_HOST;
		private $db_username = DB_USERNAME;
		private $db_password = DB_PASSWORD;

		public static function getInstance()
		{
			if (!self::$db_instance) {
				self::$db_instance = new self();
			}
			return self::$db_instance;
		}

		private function __construct()
		{
			$this->con = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);

			if(mysqli_connect_error()) {
				trigger_error("Failed to connect to to MySQL: " . mysql_connect_error(), E_USER_ERROR);
			}
		}

		private function __clone() {}

		public function getConnection()
		{
			return $this->con;
		}

	}

?>
