<?php
/**
 * User Registration
 * url - /register
 * method - POST
 * params - username, email, password
 */
$app->post ( '/register', function () use($app) {
	
	$response = array ();
	
	try{
		
		// get and decode JSON request body
		$request = $app->request();
		$body = $request->getBody();
		$input = json_decode($body);
		
		
		// check for required params
		/* verifyRequiredParams ( array (
			'username',
			'email',
			'password'
				) ); */
		
		
		// validating email address
		validateEmail ( $input->email );
		
		// Create a user object
		$user = new User ( $input->username, $input->email, $input->password );
		$user->setFirstName($input->first_name);
		$user->setLastName($input->last_name);		
		
		$db = new DbHandler ();
		$res = $db->createUser ( $user );
		
		if ($res == USER_CREATED_SUCCESSFULLY) {
			
			$email = new Email(
					$user->getEmail(), 
					REGISTRAR_EMAIL, 
					"Welcome to Jusspay", 
					generateWelcomeMessage($user),
					$user->getFirstName() . " ". $user->getLastName(),
					"Registrar Department" );
			
			if($email->send()){
				$response ["error"] = false;
				$response ["message"] = "You are successfully registered";
				echoRespnse ( 201, $response );
			}
			else{
				$response ["error"] = true;
				$response ["message"] = "Confirmation Email Sending Failed";
				echoRespnse ( 200, $response );
			}
			
			
		} else if ($res == USER_CREATE_FAILED) {
			$response ["error"] = true;
			$response ["message"] = "Oops! An error occurred while registereing";
			echoRespnse ( 200, $response );
		} else if ($res == USER_ALREADY_EXISTED) {
			$response ["error"] = true;
			$response ["message"] = "Sorry, this email already existed";
			echoRespnse ( 200, $response );
		}
		
	}
	catch (Exception $e) {
    	$app->response()->status(400);
    	$app->response()->header('X-Status-Reason', $e->getMessage());
  }
	
} );