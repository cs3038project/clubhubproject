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
$eventid = $_GET['eventid'];
$query1 = 'INSERT INTO sign_up (`pid`, `eid`) VALUES  (?,?)';

if($stmt = $mysqli->prepare($query1)){
   
   $stmt->bind_param('ss',$userid,$eventid);
   /* execute query */
   $stmt->execute();

 
   /* free results */
   $stmt->free_result();

   /* close statement */
   $stmt->close();
echo "You have signed up! ";
}

}



?>
<html>
<head>
<title>Sign up for an event</title>
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



<P>
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










