<?php
/***
Thorne PHP Framework
Main entry point for class loading
Optimized to know available code without loading it into memory
***/
class ThornePHP {
	
	//Fields
	
	var $classes; //array to store list of available classes in framework
	var $function_libs; //array that lists the available function libraries
	var $debug; //debugging variable - set to true to see error output
	
	//Methods
	
	/* The constructor learns about its own environment.
	It will generate a list of known classes and function
	libraries and store them in a class property field.	*/
	function ThornePHP() {
		$this->debug=true;
		//Load our 'available' class names into the classes variable
		if($handle = opendir(getcwd()."/thornephp/lib/classes")) {
			$x=0;
			while (false !== ($entry = readdir($handle))) {
				//exclude current and parent directory symbols
				if($entry!="." && $entry!="..") {
					$this->classes[$x]=$entry;
					$x++;
				}
			}
		} 
		//No classes were found, give some error information
		else {
			if($debug) {
				echo "Either the directory for ThornePHP Framework is missing, or there are incorrect permissions set for file reading/writing.";	
			}
		}
			
	}
}
?>