<!DOCTYPE HTML>
<?php
//check if the form has been submitted
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
?>

<html>
<head>
 <link rel="stylesheet" type="text/css" href="font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="skel.css">

</head?
<body>
<head>
  <title> Search for a user:</title>
</head>	
<body>
  <h2>Search for a user below:</h2><br /><br />
<form action = "clubprofile.php" method = "GET">
	<table>
	  <tr><td>Username:</td><td><input type= "text" id = "clubname"name = "clubname"></td></tr>
	  <tr><td><input type = "submit" id = "submit" name = "submit" value = "View Club Profile!" ></td></tr>
	</table>

<a href="logout.php">logout</a>  <br>
</form>
</body>
</html>
