<?php
/* 
PHPLattice Framework database.class.php
Description:
Database connection class
handles all database connectivity
Contains its out error handling class

Fields:
	$host - Destination address of MySQL server
	$username - Username to provide to said server
	$password - Password for the user, must have access
	$database - Specified database to manipulate with this object
	$connection - Database resource link identifier

Methods:
	
	dbconn($host, $user, $pass, $database)
	Type - Constructor
	Description - Used to instantiate the connectio process 
	and maintain a link to the server specified.
	
	open()
	Type - Helper Method
	Description - Opens database connection for querying.
	
	close()
	Type - Helper Method
	Description - Frees up the connection to the server, and unsets the connection link.
	
	sqlQuery()
	Type - Primary Method
	Description - Opens the connection to the database, and then performs the 
	SQL passed to it as an argument.  At the end it closes the connection to the
	database.
	
	showErr($e)
	Type - Helper Method
	Description - Is called during an event that an error happens in execution of
	the script.  It will format the display of the error the screen in a more
	human readable format.
	
TODO List:

	Clean up the code in general.
	Add better documentation/comments where needed.
	Identify possible security weaknesses.
	Identify possible optimization opportunities.
	  Implement a means to use the showErr($e) function to handle the try/catch 
	  blocks as well as a mysql_error() message.  The goal is to never have a break
	  in the code's execution, and the or die() clause is doing just that.

*/
class dbconn {
	private $host;
	private $username;
	private $password;
	private $database;
	private $connection;
	
	function dbconn() {
		$this->host="test";
	}
	//Open a connection
	function open() {
		//Start a connection to the database
		$con=@mysql_connect($this->getHost(),$this->getUsername(),$this->getPassword()) or $this->showErr("***Error*** ".mysql_error());
		@mysql_select_db($this->getDatabase(), $con) or $this->showErr("***Error*** ".mysql_error());
		$this->setConnection($con);
	}
	
	//Close a connection
	function close($connection) {
		//Close an open database connection
		@mysql_close($connection) or $this->showErr("***Error*** ".mysql_error());
		$this->setConnection($connection);
	}
	
	//Perform an SQL query, pure string input
	function sqlQuery($sql) {
		//open the link to the server
		$this->open();
		//Perform quick explode to see type of query
		try {
			$tmp=explode(" ", $sql);
			$com=strtoupper($tmp[0]);
			if($com=="INSERT" || $com == "DELETE" || $com == "UPDATE") {
				if(!$result=mysql_query($sql,$this->getConnection())) {
					throw new Exception("Error #1");
				}
				return true;
			} else {
				if(!$result=mysql_query($sql,$this->getConnection())) {
					throw new Exception("SQL SELECT statement error", 001);
				}
				$x=0;
				while($row=mysql_fetch_array($result)) {
					$arr[$x]=$row;
					$x++;
				}
			}
			//$arr is an array formatted as such:
			//$arr[record#][column_name]
			if(isset($arr)) {
				return $arr;
			} else {
				return false;
			}
		}
		catch (Exception $e) {
			echo $this->showErr($e);
		}
		//close the connection
		$this->close($this->getConnection());
	}
	//Get functions for fields
	function getHost() {
		return $this->host;
	}
	function getUsername() {
		return $this->username;
	}
	function getPassword() {
		return $this->password;
	}
	function getDatabase() {
		return $this->database;
	}
	function getConnection() {
		return $this->connection;
	}
	//Set functions for fields
	function setHost($val) {
		$this->host=$val;
	}
	function setUsername($val) {
		$this->username=$val;
	}
	function setPassword($val) {
		$this->password=$val;
	}
	function setDatabase($val) {
		$this->database=$val;
	}
	function setConnection($val) {
		$this->connection=$val;
	}
	function showErr($e) {
		//Check if the *** delimter is set, indicating that I am passing a mysql_error code
		?>
		<div id="exception">
			<h2>An Error has occured</h2>
			<hr />
			<p>Debugging</p>
			<?php
			if(substr($e,0,3)=="***") {
				$html_out = "MySQL has encountered an error. Here it is: ".$e;
			}
			else {
				$html_out = "<ul>";
				$html_out = $html_out."<li>Error Message: ".$e->getMessage()."</li>";
				$html_out = $html_out."<li>Error Code: ".$e->getCode()."</li>";
				$html_out = $html_out."<li>Error File: ".$e->getFile()."</li>";
				$html_out = $html_out."<li>Error Line:".$e->getLine()."</li>";
				$html_out = $html_out."<li>Error Stack Trace: <br />";
				$html_out = $html_out."<ul>";
					foreach($e->getTrace() AS $line) {
							print_r($line);
							//$html_out = $html_out."<li>File: ".$line['file']."<br />Function: ".$line['function']."<br />Argument: ".$line['args'][0]."</li>";
					}
					//echo print_r($e->getTrace()); 
					$html_out = $html_out."</ul>";
					$html_out = $html_out."</li>";
					$html_out = $html_out."</ul>";
			}
			echo $html_out;
				?>
		</div>
		<?php
	}
}
?>