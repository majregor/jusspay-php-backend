<?php
class Email {
	
	private $message="";
	private $senderAddress;
	private $receipientAddress;
	private $senderName;
	private $receipientName;
	private $contentType 		= "text/plain; charset=UTF-8";
	private $mimeType 			= "1.0";
	private $subject;
	
	public function __construct($to, $from=REGISTRAR_EMAIL, $subject, $message, $receipientName="", $senderName=""){
		$this->receipientAddress 	= $to;
		$this->senderAddress 		= $from;
		$this->message 				= $message;
		$this->senderName			= $senderName;
		$this->receipientName		= $receipientName;
	}
	
	public function generateHeader(){
		
		$headers   = array();
		
		$headers[] = "MIME-Version: " . $this->mimeType;
		$headers[] = "Content-type: " . $this->contentType;
		$headers[] = "From: " . $this->senderName . "<" . $this->senderAddress . ">";
		//$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
		$headers[] = "Reply-To: " . $this->senderName . " <" . $this->senderAddress . ">";
		$headers[] = "Subject: {$this->subject}";
		$headers[] = "X-Mailer: PHP/".phpversion();
		
		return implode("\r\n", $headers);
	}
	
	/*
	public function send(){
		if(mail($this->receipientName . "<" . $this->receipientAddress . ">", 
				$this->subject, 
				$this->message,
				$this->generateHeader() 
				)){
			
			return true;
		}
		else{
			return false;
		}
	}
	*/
	/**DUMMY SEND **/
	public function send(){
		return true;
	}
	
	
	/****
	 * Getters and Setters for the different properties
	 */
	public function getSubject() {
		return $this->subject;
	}
	public function setSubject($subject) {
		$this->subject = $subject;
		return $this;
	}
	public function getMessage() {
		return $this->message;
	}
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}
	public function getSenderAddress() {
		return $this->senderAddress;
	}
	public function setSenderAddress($senderAddress) {
		$this->senderAddress = $senderAddress;
		return $this;
	}
	public function getReceipientAddress() {
		return $this->receipientAddress;
	}
	public function setReceipientAddress($receipientAddress) {
		$this->receipientAddress = $receipientAddress;
		return $this;
	}
	public function getSenderName() {
		return $this->senderName;
	}
	public function setSenderName($senderName) {
		$this->senderName = $senderName;
		return $this;
	}
	public function getReceipientName() {
		return $this->receipientName;
	}
	public function setReceipientName($receipientName) {
		$this->receipientName = $receipientName;
		return $this;
	}
	public function getContentType() {
		return $this->contentType;
	}
	public function setContentType($contentType) {
		$this->contentType = $contentType;
		return $this;
	}
	public function getMimeType() {
		return $this->mimeType;
	}
	public function setMimeType($mimeType) {
		$this->mimeType = $mimeType;
		return $this;
	}
	
	
	
}