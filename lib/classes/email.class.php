<?php
/* 
PHPLattice Framework email.class.php
Description:
E-mail object handler.  Will create and manage details about a single
e-mail and allow it to be sent in any possible way if possible.

Fields:
	$message - The contents of our mail
	$subject - Subject line of the mail
	$headers - Array holding header values for the mail
	$send_to - The TO field, or recipiant of the email.
	$from - The From field, or whom sent the mail.
	
Methods:
*/
class email {
	
	//Fields
	private $message;
	private $subject;
	private $headers;
	private $send_to;
	private $from;
	
	
	//Get Methods
	function getMessage() {
		return $this->message;	
	}
	function getSubject() {
		return $this->subject;	
	}
	function getHeaders() {
		return $this->headers;	
	}
	function getSendTo() {
		return $this->send_to;	
	}
	function getFrom() {
		return $this->from;	
	}
	//Set Methods
	function setMessage($val) {
		$this->message=$val;	
	}
	function setSubject($val) {
		$this->subject=$val;	
	}
	function setHeaders($val) {
		$this->headers=$val;	
	}
	function setSendTo($val) {
		$this->send_to=$val;	
	}
	function setFrom($val) {
		$this->from=$val;	
	}
}
?>