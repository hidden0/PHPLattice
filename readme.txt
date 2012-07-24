PHPLattice Framework Version TBD
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
1) Download the latest version of PHPLattice Framework at
https://github.com/hidden0/PHPLattice (zip file)
2) Extract the zip file to your www, public_html, or specified "web" directory.
3) In your PHP code, include the phpLattice.php file at the top of your document
===============================================================
				USAGE
===============================================================
Using the PHPLattice Framework is easy!  You can start right away
by adding the phpLattice.php file to your php documents to access all of
the code.

Example:
	//include the PHPLattice framework
	include("path/to/framework/phpLattice.php");
	$phpl = new PHPLattice();
	
	//do stuff...
	$db = $phpl->loadResource("database"); //loads database class
	$db->setup("localhost", "user", "pass", "database"); //connects to data source
	$result = $db->sqlQuery("SELECT * FROM table"); //does SQL query
	
Now you have access to all classes and functions in the framework.
Consult the documentation or API reference for more information on how
to use this data more effectively.  A quick example of using the database class
and other classes can be seen below.
===============================================================
				EXAMPLES
===============================================================
Using the framework:

	//include the PHPLattice framework
	include("path/to/framework/phpLattice.php");
	$phpl = new PHPLattice();
	
The rest of the examples assume you have included the framework.

Using the database class:
	
	//setup a new database object
	$db = $phpl->loadResource("database"); //loads database.class.php file
	$db->setup("localhost", "user", "pass", "database"); //connects to data source
	$result = $db->sqlQuery("SHOW TABLES"); //does SQL query

Using the mailer class:

	//setup a new email object
	$email = $phpl->loadResource("email"); //loads email.class.php file
	$email->send("thornethegreat@gmail.com", "Subject", "From", "Headers");
	
More to be added