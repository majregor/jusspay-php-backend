<?php
/**
 * User Login
 * url - /login
 * method - POST
 * params - email, password
 */
$app->post ( '/login', function () use($app) {
	// check for required params
	/*verifyRequiredParams ( array (
	'email',
	'password'
			) );
			*/

	// reading post params 
	//$email = $app->request ()->post ( 'email' );
	//$password = $app->request ()->post ( 'password' );
	
	// get and decode JSON request body
	$request = $app->request();
	$body = $request->getBody();
	$input = json_decode($body);
	
	$email = $input->email;
	$password = $input->password;
	
	$response = array ();

	$db = new DbHandler ();
	// check for correct email and password
	if ($db->checkLogin ( $email, $password )) {
		// get the user by email
		
		$user = $db->getUserByEmail ( $email );
		

		if ($user != NULL) {
			$response ["error"] = false;
			$response ['apiKey'] = $user ['api_key'];
			$response ['first_name'] = $user ['first_name'];
			$response ['last_name'] = $user ['last_name'];
			$response ['email'] = $user ['email'];
			$response ['user_name'] = $user ['user_name'];
			$response ['phone'] = $user ['phone'];
			$response ['dob'] = $user ['dob'];
			$response ['status'] = $user ['status'];
			$response ['created'] = $user ['created'];
			$response ['modified'] = $user ['modified'];
			$response ['portrait'] = $user ['portrait'];
			$response ['message'] = "Logged in successfully!";
		} else {
			// unknown error occurred
			$response ['error'] = true;
			$response ['message'] = "An error occurred. Please try again";
		}
	} else {
		// user credentials are wrong
		$response ['error'] = true;
		$response ['message'] = 'Login failed. Incorrect credentials';
	}

	echoRespnse ( 200, $response );
} );