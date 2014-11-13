<?php

// require_once '../include/autoload.php';
include_once '../Model/Dbconnect.php';
require_once '../Model/PassHash.php';
require_once '../Model/DbHandler.php';
require_once '../Model/Email.php';
require_once '../Entity/User.php';

require '.././libs/Slim/Slim.php';

\Slim\Slim::registerAutoloader ();

$app = new \Slim\Slim ();

// User id from db - Global Variable
$user_id = NULL;

/**
 * Verifying required params posted or not
 */
function verifyRequiredParams($required_fields) {
	$error = false;
	$error_fields = "";
	$request_params = array ();
	$request_params = $_REQUEST;
	// Handling PUT request params
	if ($_SERVER ['REQUEST_METHOD'] == 'PUT') {
		$app = \Slim\Slim::getInstance ();
		parse_str ( $app->request ()->getBody (), $request_params );
	}
	foreach ( $required_fields as $field ) {
		if (! isset ( $request_params [$field] ) || strlen ( trim ( $request_params [$field] ) ) <= 0) {
			$error = true;
			$error_fields .= $field . ', ';
		}
	}
	
	if ($error) {
		// Required field(s) are missing or empty
		// echo error json and stop the app
		$response = array ();
		$app = \Slim\Slim::getInstance ();
		$response ["error"] = true;
		$response ["message"] = 'Required field(s) ' . substr ( $error_fields, 0, - 2 ) . ' is missing or empty';
		echoRespnse ( 400, $response );
		$app->stop ();
	}
}

/**
 * Validating email address
 */
function validateEmail($email) {
	$app = \Slim\Slim::getInstance ();
	if (! filter_var ( $email, FILTER_VALIDATE_EMAIL )) {
		$response ["error"] = true;
		$response ["message"] = 'Email address is not valid';
		echoRespnse ( 400, $response );
		$app->stop ();
	}
}

/**
 * Echoing json response to client
 * 
 * @param String $status_code
 *        	Http response code
 * @param Int $response
 *        	Json response
 */
function echoRespnse($status_code, $response) {
	$app = \Slim\Slim::getInstance ();
	// Http response code
	$app->status ( $status_code );
	
	// setting response content type to json
	$app->contentType ( 'application/json' );
	
	echo json_encode ( $response );
}

function generateWelcomeMessage($user){
		
	$str = <<<EOD
Hi Godfrey,\n

My name is Andrew Wafula, and I'd like to personally welcome you to JussPay.\n\n


JussPay is a mobile payment and funds transfer system that enables users to transact directly using their mobile devices.\n
			
To activate your free JussPay account go here:\n
http://www.jusspay.com/activate?id={$user->getApiKey()} \n

If there's anything I can help you with, just let me know.\n

Kind Regards,\n

Jamie Heathorn\n
Registration Manager\n
JussPay Mobile Ltd.\n
EOD;
	
	return $str;
}

/****************************************************************
 * *********************  MODULES  ******************************
 * **************************************************************
 */

/**
 * User Registration module
 */
include_once 'modules/register.php';

/**
 * User Registration module
 */
include_once 'modules/login.php';

/**
 * Get user's recipients
 */
include_once 'modules/recipients.php';

/**
 * PUT (edit) user's data
 */
include_once 'modules/editUserData.php';


$app->get ( '/hello/:name', function ($name) {
	echo "Hello, $name";
} );



$app->run ();
?>
