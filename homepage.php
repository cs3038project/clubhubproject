<!DOCTYPE HTML>
<html>
<head>
   <title>Club Profile</title>
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
	$dbuser = "";
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
	$userid= $_SESSION['userName']; 
	$query1 = 'SELECT * FROM club where cname like  ?';


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
<header id="header" class="alt">
				<h1><strong><a href="index.html"></a></strong> </h1>
				<nav id="nav">
					
					<ul>
						
						<li><form action = "clubprofile.php" method = "GET"></li>
						<table>
					  <li><tr><td></td><td><input type= "text"  id = "clubname"name = "clubname" placeholder="search for a club" required /></td></tr></li>
	  				<li><tr><td><input type = "submit" id = "submit" name = "submit" value = "Find Club" ></td></tr></li>
					</table>
						<!--<li><a href="signuppage.php">Sign up for an event</a></li>
						<li><a href="logout.php">logout</a></li>
						<li><a href="profileindex.php">search for a club profile</a>search</li>
						<li><a href="cosponsorpage.php">Add a co-sponsor for an event</a></li> -->
					</ul>
				</nav>
			</header>
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
