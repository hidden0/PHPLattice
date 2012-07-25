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
	$parms - additional parameters
	$validation - validation level for email address
		0: No validation
		1: Validates proper format of an email
		2: Tests domain for connectivity as well
Methods:

	validateToAddr()
	Type - Helper method
	Description - Validates the e-mail address
	to send to is real and formatted correctly.
	Accomplished via filter_var() and socks.
	
	portTester($domain)
	Type - Helper method
	Description - Tests ports on the given $domain
	parameter.  Ports are common mail server ports.
	If one is successful we return true immediately.
	
	appendHeader()
	Type - Field Modifier
	Description - ALlows the setting of headers for the email
	such as From and Reply-To or X-Mailer.

TODO List:
	
	Add some debugging features and error reporting.
	Add set/get methods and fields for Bcc and Cc headers.
	It can be done manually right now with appendHeaders, but
	this is easier on the eyes sometimes.
*/
class email {
	
	//Fields
	private $message;
	private $subject;
	private $headers;
	private $send_to;
	private $from;
	private $parms;
	private $validation;
	
	//constructor
	function email() {
		//null state so we know nothing has been put here yet
		$this->setHeaders(" ");
		$this->setParms(" ");
		$this->setValidation(2);
	}
	
	/*This actually sends the e-mail over the web.*/
	function send() {
		if($this->validateToAddr()==true && $this->support()==true) {
			$result=mail($this->getSendTo(), $this->getSubject(), $this->getMessage(), $this->getHeaders(), $this->getParms());
			if(!$result) {
				return "Could not send.";
			} else {
				return $result;
			}
		}
		else {
			return "Could not validate the address.";	
		}
	}
	
	//Helper Methods
	/*Check to see if php can actually send an email.*/
	function support() {
		ob_start();
		phpinfo();
		$phpinfo = ob_get_contents();
		ob_end_clean();
		$answer = false;
		if (strpos($phpinfo, "Path to sendmail") !== FALSE)
		{
			$answer = true;
		}
		return $answer;
	}
	/*This function will validate the email address provided
	to send to is valid.  This will prevent headaches with emails
	not being sent to a real address.  Should prevent sql injection
	and other ecurity flaws as well.*/
	function validateToAddr() {
		if($this->getValidation()!=0) {
			//assuming invalid
			$valid=false;
			$filter_test=false;
			if (filter_var($this->getSendTo(), FILTER_VALIDATE_EMAIL) !== false) {
    			// $email contains a valid email
				$filter_test=true;
				// Validate the mail server provided is alive
				$domain = explode("@", $this->getSendTo());
				$valid=$this->portTester($domain[1]);
			}
			//Did not pass validation
			else {
				$filter_test=false;
			}
			if($valid==true && $filter_test==true && $this->getValidation()==2) {
				//we passed the tests
				return true;
			}
			elseif($filter_test==true && $this->getValidation()==1) {
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return true;
		}
	}
	
	/*Performs fsockopen() on requested port.  Returns a dead or alive status.*/
	function portTester($domain) {
			//list of ports to test
			$ports= array(25, 80, 465, 587, 995);
			//assume not valid domain
			$valid=false;
			//loop through possible ports for mail servers
			foreach($ports AS $port) {
				$fp=@fsockopen($domain, $port, $errnum, $errstr, 5);
				if(!$fp) {
					//invalid domain
					$valid=false;	
				} else {
					//just need one active port, good enough for me
					$valid=true;
					break;
				}
			}
			return $valid;
	}

	/*Appends Headers to $headers array*/
	function appendHeader($val) {
		//Check to see if headers have already been added or not
		if($this->getHeaders()==" ") {
			//just insert it
			$this->setHeaders($val);
		} else {
			//make sure to add the new line and return
			$tmp=$this->getHeaders()."\r\n".$val;
			$this->setHeaders($tmp);
		}
	}
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
	function getParms() {
		return $this->parms;
	}
	function getValidation() {
		return $this->validation;
	}
	//Set Methods
	function setValidation($val) {
		$this->validation=$val;
	}
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
		$this->appendHeader("From: ".$val);
	}
	function setParms($val) {
		$this->parms=$val;
	}
}
?>
