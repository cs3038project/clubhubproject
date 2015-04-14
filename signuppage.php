<!DOCTYPE HTML>
<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
//1. Create a database connection
//include "connectdb.php";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "Clubhub";
$mysqli = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
 // Test if connection succeeded
  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
         mysqli_connect_error() . 
         " (" . mysqli_connect_errno() . ")"
    );
  }
?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
$userid= $_SESSION['userName']; 
$eventid = $_POST['eventid'];
$query1 = 'INSERT INTO sign_up (`pid`, `eid`) VALUES  (?,?)';

if($stmt = $mysqli->prepare($query1)){
   
   $stmt->bind_param('ss',$userid,$eventid);
   /* execute query */
   $stmt->execute();

   /* Store the result (to get properties) */
   //$stmt->store_result();

   /* Get the number of rows */
  // $num_of_rows = $stmt->num_rows;

   /* Bind the result to variables */
  // $stmt->bind_result($cname, $descr);

  // while ($stmt->fetch()) {
	// echo ''.$cname.' ' .$descr.' ' .'<br>';
   //}
  //echo "You have signed up for event: " . 
   /* free results */
   $stmt->free_result();

   /* close statement */
   $stmt->close();
}

}



?>
<html>
<head>
<title>Sign up for an event</title>
<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="skel.css">
</head>
<body>

<FORM NAME ="form1" METHOD ="POST" ACTION ="signuppage.php">

Event ID: <INPUT TYPE = 'TEXT' Name ='eventid'  value="<?PHP print "";?>" maxlength="20">


<P align = center>
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Sign up">
</P>

</FORM>

<P>
<?PHP //print $errorMessage;?>

 <a href="logout.php">logout</a>  <br>
</body>
</html>











