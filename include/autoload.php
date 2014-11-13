<?php
function __autoload($className){
	switch ($className){
		case "User":
			require_once ('../Entity/User.php');
			break;
		case "Dbconnect":
			require_once ('../Model/User.php');
			break;
		case "DbHandler":
			require_once ('../Model/User.php');
			break;
		case "PassHash":
			require_once ('../Model/User.php');
			break;
	}
}