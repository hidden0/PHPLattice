<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ThornePHP Framework</title>
</head>

<body>
<h2>The Framework Testing</h2>
<hr />
<?php
//Testing implementations
require_once("phpLattice.php");
$phpl = new PHPLattice();
//Testing the email class
$email = $phpl->loadResource("email");
print_r($email);

?>
</body>
</html>