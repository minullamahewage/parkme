<?php
//define('DB_SERVER', 'db4free.net');
//define('DB_USERNAME', 'parkme');
//define('DB_PASSWORD', 'parkme@2019');
//define('DB_DATABASE', 'userdatabase');
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'userdatabase');

class DBConnection{
	private static $dbConnection;
	private function __construct(){
		
	}
	public static function getDBConnection(){
		if (self::$dbConnection==null){
			self::$dbConnection=new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		}
		return self::$dbConnection;
	}
}
?>