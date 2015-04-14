<!DOCTYPE HTML>
<html>
<head>
   <title><?php echo $fname; ?> <?php echo $lname; ?>s Profile</title>
   <link rel="stylesheet" type="text/css" href="font-awesome.min.css">
   <link rel="stylesheet" type="text/css" href="style.css">
   <link rel="stylesheet" type="text/css" href="skel.css">
</head>
<body>
<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
if( isset($_GET['clubname'])){
    $clubname = $_GET['clubname'];
	   
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
	$userid= $_SESSION['userName']; 
	$query1 = 'SELECT * FROM club where cname = (?)';
	

	if($stmt = $mysqli->prepare($query1)){
	   
	   $stmt->bind_param('s',$clubname);
	   /* execute query */
	   $stmt->execute();

	   /* Store the result (to get properties) */
	   $stmt->store_result();

	   /* Get the number of rows */
	   $num_of_rows = $stmt->num_rows;

	   /* Bind the result to variables */
	   $stmt->bind_result($clubid, $clubname,$descr);
	   if($num_of_rows != 1){
		die("That clubname could not be found!");
		}
                 
        while ($stmt->fetch()) {
	       //echo 'Clubid: '.$clubid.' Club Name: ' .$clubname.' ' . $descr.'<br>';
	       //echo $clubname. "'s profile</h2><br /><table>";
	       echo "<h2>" . $clubname. "'s profile</h2><br />";
               echo "<tr><td>Clubid: </td></td>". $clubid ." </br></td></tr>"; 
               echo  "<tr><td>Club Name: </td></td>". $clubname. "</br></td></tr>";
	       //echo $descr;
               echo  "<tr><td>Club Description: </td></td>" . $descr. "</br></td></tr>";
                                                                                  }//while ($stmt->fetch())
	//if($clubname != $dbclubname){die("THere has been a fatal error. Please try again.");}
	
	?>



<?php

	}//if($stmt = $mysqli->prepare($query1))

   }//if( isset($_GET['clubname']))

	?>

 <a href="logout.php">logout</a>  <br>
</body>
</html>
