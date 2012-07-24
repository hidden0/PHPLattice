<?php
/*
PHPLattice Framework main.php
Description:
Creates the entry point and manipulation of the framework itself.
Resources such as function libraries or class files are not loaded
initially (this would load a lot of crap eventually), but are instead
specified by the user. 

How it works: First the constructor enumerates the files in the library
folder.  First creating a list of class files, then a list of function library
files, and stores them for later reference.  At the point the user needs
a specific resource, they can load it with this list.
*/
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
		if($handle = opendir(getcwd()."/PHPLattice/lib/classes")) { 
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