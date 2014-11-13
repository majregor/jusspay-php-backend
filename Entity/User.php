<?php
/**
 * Model User
 * @author Godfrey Majwega
 */
 
class User{
	
	private $firstName, $lastName;
	private $email;
	private $password;
	private $userName;
	private $portrait;
	
	private $id, $apiKey, $dob, $status;
	
	function __construct($userName,
							$email,
							$password,
							$firstName="",
							$lastName=""){
		
		$this->email=$email;
		$this->firstName=$firstName;
		$this->lastName=$lastName;
		$this->userName=$userName;
		$this->password=$password;
	}
	
	public function getFirstName(){
		return $this->firstName;
	}
	public function setFirstName($firstName){
		$this->firstName=$firstName;
	}
	public function getLastName(){
		return $this->lastName;
	}
	public function setLastName($lastName){
		$this->lastName=$lastName;
	}
	public function getEmail(){
		return $this->email;
	}
	/**
	 * Setter Method for email property
	 * @param unknown $email
	 */
	public function setEmail($email){
		$this->email= $email;
	}
	
	public function getUserName(){
		return $this->userName;
	}
	public function setUserName($userName){
		$this->userName=$userName;
	}
	
	public function getPassword(){
		return $this->password;
	}
	public function setPassword($password){
		$this->password = $password;
	}
	
	public function getApiKey(){
		return $this->apiKey;
	}
	public function setApiKey($apiKey){
		$this->apiKey=$apiKey;
	}
	public function getPortrait() {
		return $this->portrait;
	}
	public function setPortrait($portrait) {
		$this->portrait = $portrait;
		return $this;
	}
	
}