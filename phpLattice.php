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
class PHPLattice {
	
	//Fields
	
	var $classes; //array to store list of available classes in framework
	var $function_libs; //array that lists the available function libraries
	var $debug; //debugging variable - set to true to see error output
	
	//Methods
	
	/* The constructor learns about its own environment.
	It will generate a list of known classes and function
	libraries and store them in a class property field.	*/
	function PHPLattice() {
		$this->debug=true;
		//Load our 'available' class names into the classes variable
		if($handle = opendir(getcwd()."/lib/classes")) { 
			while (false !== ($entry = readdir($handle))) {
				//exclude current and parent directory symbols
				if($entry!="." && $entry!="..") {
					$this->classes[$entry]=getcwd()."/lib/classes/".$entry;
				}
			}
		} 
		//No classes were found, give some error information
		else {
			if($debug) {
				echo "Either the directory for PHPLattice Framework is missing, or there are incorrect permissions set for file reading/writing.";	
			}
		}
			
	}
	
	/* Loads a specified resource into the frameworks active set
	of classes or functions.  This is the name of the file (without the .php)*/
	function loadResource($name) {
		//Hard coding the resources for security purposes - ALWAYS UPDATE THIS
		$tmp_name=explode("/", $name);
		$name=$tmp_name[(sizeof($tmp_name)-1)];
		unset($tmp_name);
		$tmp = false;
		switch ($name) {
			case "database.class.php":
				include($this->classes[$name]);
				$tmp = new dbconn();
				break;
		}
		return $tmp;
	}
}
?>