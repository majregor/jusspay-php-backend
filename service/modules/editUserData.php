<?php
/**
 * User Registration
 * url - /user
 * method - PUT
 * params - username, email, password
 */
$app->put ( '/user', function () use($app) {
	
	$response = array ();
	
	try{
		
		// get and decode JSON request body
		$request = $app->request();
		$body = $request->getBody();
		$input = json_decode($body);
			
		
		$db = new DbHandler ();
		$res = $db->updateUser($input->email, $input->first_name, $input->last_name, 
				$input->username, $input->phone, $input->portrait);
		
		if ($res) {
			
			$response ["error"] = false;
			$response ["message"] = "Profile Updated Successfully";
			echoRespnse ( 201, $response );
			
		} else {
			$response ["error"] = true;
			$response ["message"] = "Oops! An error occurred during the update";
			echoRespnse ( 200, $response );
		} 
		
	}
	catch (Exception $e) {
		
		echoRespnse ( 200, array("error"=>true, "message"=>$e->getMessage()) );
    	$app->response()->status(400);
    	$app->response()->header('X-Status-Reason', $e->getMessage());
  }
	
} );