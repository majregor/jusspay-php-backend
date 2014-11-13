<?php
/**
 * Handling MySql database connection
 * @author Godfrey Majwega
 * @copyright Glydenet-Solutions
 * 
 */

class DbConnect{
	
	
	private $conn;
	private $PDOconn;
	
	function __construct(){
		require_once(dirname(dirname(__FILE__)) . '/include/Config.php');
		
	}
	
	/**
	 * Establishing database connection
	 * Return database connetion handler
	 */
	
	function PDOConnect(){
		
		$this->PDOconn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USERNAME, DB_PASSWORD, array(PDO::ATTR_EMULATE_PREPARES => false,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
		
		return $this->PDOconn;
	}
	
	function connect() {
		
		
		//Connecting to mysql database
		$this->conn= new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME, DB_PORT);
		
		// Check for database connection error
		if (mysqli_connect_errno()) {
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		
		// returing connection resource
		return $this->conn;
	}
}