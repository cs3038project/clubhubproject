
<?php
 
$uname = "";
$pword ="";
$errorMessage = "";
$num_rows = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	//1. Create a database connection
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

$query1 = 'SELECT * FROM person WHERE pid = (?)';

if(!($stmt = $mysqli->prepare("SELECT pid, passwd FROM person WHERE pid = ? and passwd = ?"))){
 echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
	}
   if(!$stmt->bind_param('ss', $uname, $pword)){
	echo "Bind failed: (" . $stmt->errno . ")" . $stmt->error;
	}
    execute query */
   $stmt->execute();

   /* Store the result (to get properties) */
   $stmt->store_result();

   /* Get the number of rows */
   $num_of_rows = $stmt->num_rows;

   /* Bind the result to variables */
   $stmt->bind_result($user_name, $pass_word);
   while ($stmt->fetch()) {

}
	    if ($stmt) {
			if ($user_name ==$uname && $pword == $pass_word && $uname != "" && $pword != "") {
				session_start();
				$_SESSION['login'] = "1";
				$_SESSION['userName'] = $uname;
				header ("Location: homepage.php");
				exit();
			}
			else {
				
				$errorMessage = "Error logging on";
			}
			
		}
		else {
			$errorMessage = "Error logging on";
		}
	        $stmt->close();
		$mysqli->close();
}
?>
<html>
<head>
<title>Login To Clubhub</title>
<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="skel.css">
<link rel="stylesheet" type="text/css" href="style-xlarge.css">
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
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

<FORM NAME ="form1" METHOD ="POST" ACTION ="login.php">

Username: <INPUT TYPE = 'TEXT' Name ='username'  value="<?PHP print $uname;?>" maxlength="100" required>
Password: <INPUT TYPE = 'Password' Name ='password'  value="<?PHP print $pword;?>" maxlength="100" required>

<P align = center>
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Login">
</P>

</FORM>

<P>
<?PHP print $errorMessage;?>

<section id="three" class="wrapper style1">
					<div class="container">
						<header class="major special">

							<a href="publicinfo.php">Public Info</a></br>
						</header>
						
					</div>
				</section>
</body>
</html>

