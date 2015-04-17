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
	$dbpass = "rasengan";
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
	$c_name2 = "";
	$eventid2 ="";
if(!($stmt = $mysqli->prepare("SELECT clubid FROM club WHERE clubid = ?"))){
 echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
	}
   if(!$stmt->bind_param('s', $clubname)){
	echo "Bind failed: (" . $stmt->errno . ")" . $stmt->error;
	}
   /*$stmt->bind_param('ss',$uname,$pword);
    execute query */
   $stmt->execute();

   /* Store the result (to get properties) */
   $stmt->store_result();

   /* Get the number of rows */
   $num_of_rows = $stmt->num_rows;

   /* Bind the result to variables */
   $stmt->bind_result($c_name2 );
   while ($stmt->fetch()) {}

if(!($stmt = $mysqli->prepare("SELECT eid FROM event WHERE eid = ?"))){
 echo "Prepare failed: (" . $mysqli->errno . ")" . $mysqli->error;
	}
   if(!$stmt->bind_param('s', $eventid)){
	echo "Bind failed: (" . $stmt->errno . ")" . $stmt->error;
	}
    /*execute query */
   $stmt->execute();

   /* Store the result (to get properties) */
   $stmt->store_result();

   /* Get the number of rows */
   $num_of_rows = $stmt->num_rows;

   /* Bind the result to variables */
   $stmt->bind_result($eventid2 );
   while ($stmt->fetch()) {}



	    if ($stmt) {
			if ($c_name2 == $clubname && $eventid == $eventid2) {
				
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
					echo "sponsor added!";
			}
			else {
				echo "Club/Event doesn't exist!";
				
			}
			
		}
		else {
			$errorMessage = "Error ";
		}
/* free results */
	   $stmt->free_result();

	   /* close statement */
	   $stmt->close();

}
	
		    







	   
	  
	   

	//if ($_SERVER['REQUEST_METHOD'] == 'POST')



	?>
	<html>
	<head>
	<title>Add a co-sponsor for an event</title>
	<link rel="stylesheet" type="text/css" href="font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="skel.css">
	</head>
	<body>

	<FORM NAME ="form1" METHOD ="POST" ACTION ="cosponsorpage.php">

	Club Name: <INPUT TYPE = 'TEXT' Name ='clubname'  value="<?PHP print "";?>" maxlength="20">
	Event Name: <INPUT TYPE = 'TEXT' Name ='eventname'  value="<?PHP print "";?>" maxlength="20">

	<P align = center>
	<INPUT TYPE = "Submit" Name = "Submit1"  VALUE = "Add club">
	</P>



	<?PHP //print $errorMessage;?>

	 <a href="logout.php">logout</a>  <br>
	</body>
	</html>











