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
$eventid = $_POST['eventname'];
$clubname = $_POST['clubname'];
$query1 = 'INSERT INTO sponsored_by (`clubid`, `eid`) VALUES  (?,?)';
if(!($stmt = $mysqli->prepare("INSERT INTO sponsored_by (`clubid`, `eid`) VALUES  (?,?)"))){
      	 echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
	    }
	    if(!$stmt->bind_param('ss', $clubname, $eventid)){
		echo "Bind failed: (" . $stmt->errno . ")" . $stmt->error;
	    }
	    if(!$stmt->execute()){
	     echo "Execute failed: (" . $stmt->errno .")" . $stmt->error;
	    }
	    
   
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
?>
<html>
<head>
<title>Add a co-sponsor for an event</title>
<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="skel.css">
<link rel="stylesheet" type="text/css" href="style-xlarge.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>
</head>
<body>

<FORM NAME ="form1" METHOD ="POST" ACTION ="cosponsor.php">

Club ID: <INPUT TYPE = 'TEXT' Name ='clubname'  value="<?PHP print "";?>" maxlength="20">
Even ID: <INPUT TYPE = 'TEXT' Name ='eventname'  value="<?PHP print "";?>" maxlength="20">
<br>
<P align = center>
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Add club">
</P>



<?PHP //print $errorMessage;?>

<section id="three" class="wrapper style1">
					<div class="container">
						<header class="major special">

							<a href="publicinfo.php">Public Info</a></br>
							<a href="homepage.php">Homepage</a></br>
							<a href="logout.php">logout</a>  <br>
						</header>
						
					</div>
				</section>
</body>
</html>
