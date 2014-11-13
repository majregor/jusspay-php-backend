<?php
/**
 * Get Recipients of a user
 * url - /recipients
 * method - GET
 * params - email
 */
$app->get ( '/recipients', function () use($app) {
	
	$request = $app->request ();
	$response = array ();
	
	// Get Request Parameters
	$email = $request->get ( 'user' );
	
	$db = new DbHandler ();
	
	// get the user by email
	$users = $db->getRecipients ( $email );
	if ($users != NULL) {
		foreach ( $users as $key => $user ) {
			
			$response [$key] ["error"] = false;
			$response [$key] ['apiKey'] = $user ['api_key'];
			$response [$key] ['first_name'] = $user ['first_name'];
			$response [$key] ['last_name'] = $user ['last_name'];
			$response [$key] ['email'] = $user ['email'];
			$response [$key] ['user_name'] = $user ['user_name'];
			$response [$key] ['phone'] = $user ['phone'];
			$response [$key] ['dob'] = $user ['dob'];
			$response [$key] ['status'] = $user ['status'];
			$response [$key] ['created'] = $user ['created'];
			$response [$key] ['modified'] = $user ['modified'];
			$response [$key] ['message'] = "Successfull";
		}
	} else {
		// unknown error occurred
		$response ['error'] = true;
		$response ['message'] = "An error occurred. Please try again";
	}
	
	echoRespnse ( 200, $response );
} );