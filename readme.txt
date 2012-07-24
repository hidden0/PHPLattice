ThornePHP Framework Version TBD
===============================================================
				DESCRIPTION
===============================================================
This framework provides quick and easy access to
functions custom tailored for Johnathan Thorne's work environment.
PHP tends to have a messy way of handling problems, errors, and other
trivial data such as database connections.  A lot of times, these said
functions are done poorly, insecurely, or in-efficiently.
In an attempt to make my PHP scripts run more smoothly, I have created
this framework.  I aim on implementing several classes for less future coding.
===============================================================
				INSTALLATION
===============================================================
1) Download the latest version of ThornePHP Framework at
***git hup repo link here*** (zip file)
2) Extract the zip file to your www, public_html, or specified "web" directory.
3) In your PHP code, include the main.php file at the top of your document
===============================================================
				USAGE
===============================================================
Using the ThornePHP Framework is easy!  You can start right away
by adding the main.php file to your php documents to access all of
the code.

Example:
	//include the ThornePHP framework
	include("path/to/framework/main.php");
	$tphp = new ThornePHP();
	
	//do stuff...
	$db = $tphp->loadClass("database"); //loads database class
	$db->setCon("localhost", "user", "pass", "database"); //connects to data source
	$result = $db->doSQL("SELECT * FROM table"); //does SQL query
	
Now you have access to all classes and functions in the framework.
Consult the documentation or API reference for more information on how
to use this data more effectively.  A quick example of using the database class
and other classes can be seen below.
===============================================================
				EXAMPLES
===============================================================
Using the framework:

	//include the ThornePHP framework
	include("path/to/framework/main.php");
	$tphp = new ThornePHP();
	
The rest of the examples assume you have included the framework.

Using the database class:
	
	//setup a new database object
	$db = $tphp->loadClass("database"); //loads database class
	$db->setCon("localhost", "user", "pass", "database"); //connects to data source
	$result = $db->doSQL("SELECT * FROM table"); //does SQL query

Using the mailer class:

	//setup a new email object
	$email = $tphp->loadClass("email"); //loads email class
	$output = $email->send("thornethegreat@gmail.com", "Subject", "From", "Headers");
	
More to be added