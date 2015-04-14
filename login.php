



<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
$uname = "";
$pword ="";
$errorMessage = "";
$num_rows = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$uname = $_POST['username'];
	$pword = $_POST['password'];
	//error_reporting(E_ALL);
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
if(!($stmt = $mysqli->prepare("SELECT pid, passwd FROM person WHERE pid = ? and passwd = ?"))){
      	 echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
	    }
	    if(!$stmt->bind_param('ss', $uname, $pword)){
		echo "Bind failed: (" . $stmt->errno . ")" . $stmt->error;
	    }
	    if(!$stmt->execute()){
	     echo "Execute failed: (" . $stmt->errno .")" . $stmt->error;
	    }
	    $stmt->bind_result($user_name,$pass_word);
	    $num_rows = $stmt->num_rows;
	    if ($stmt) {
			if ($user_name = $uname) {
				session_start();
				$_SESSION['login'] = "1";
				$_SESSION['userName'] = $uname;
				
					
				header ("Location: fixedhomepage.php");
				exit();
			}
			else {
				session_start();
				$_SESSION['login'] = "";
				//header ("Location: https://www.google.com");
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





</head>
<body>

<FORM NAME ="form1" METHOD ="POST" ACTION ="login2.php">

Username: <INPUT TYPE = 'TEXT' Name ='username'  value="<?PHP print $uname;?>" maxlength="20">
Password: <INPUT TYPE = 'TEXT' Name ='password'  value="<?PHP print $pword;?>" maxlength="16">

<P align = center>
<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Login">
</P>

</FORM>

<P>
<?PHP print $errorMessage;?>

</body>
</html>








<?php
 
