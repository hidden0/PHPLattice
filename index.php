<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>PHPLattice Framework</title>
</head>

<body>
<h2>The Framework Testing</h2>
<hr />
<?php
//Testing implementations
require_once("phpLattice.php");
$phpl = new PHPLattice();
//Testing the email class
$phpl->loadResource("email");
$my_email=$phpl->resource['email'];
$my_email->setSendTo("jrthorne@purdue.edu");
$my_email->setFrom("ganc@purdue.edu");
$my_email->setMessage("We made this folder, and it is very useful.");
$my_email->setSubject("Shared Work Folder");
$my_email->setValidation(0);
//echo $my_email->send();
?>
</body>
</html>
