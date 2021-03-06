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
	   $stmt->bind_result($clubid, $club_name,$descr);
	   if(!($num_of_rows > 0)){
		die("That clubname could not be found!");
		}
                 
        while ($stmt->fetch()) {
	       echo "<h2>" . $club_name. "'s profile</h2><br />";
               echo "<tr><td>Clubid: </td></td>". $clubid ." </br></td></tr>"; 
               echo  "<tr><td>Club Name: </td></td>". $clubname. "</br></td></tr>";
               echo  "<tr><td>Club Description: </td></td>" . $descr. "</br></td></tr>";
                                                                                  }
	}

	$query1 = 'SELECT * FROM club natural join role_in where cname =  ?';
	if($stmt = $mysqli->prepare($query1)){
	   $stmt->bind_param('s',$clubname);
	   /* execute query */
	   $stmt->execute();
	   /* Store the result (to get properties) */
	   $stmt->store_result();
	   /* Get the number of rows */
	   $num_of_rows = $stmt->num_rows;
	   /* Bind the result to variables */
	   $stmt->bind_result($clubid, $clubname,$descr,$personid,$role);
	   if(!($num_of_rows > 0)){
		die("That clubname could not be found!");
		}
        while ($stmt->fetch()) {
		;
		 }
	}

$query1 = 'SELECT * FROM person natural join role_in where pid =  ?';
	if($stmt = $mysqli->prepare($query1)){
	   
	   $stmt->bind_param('s',$personid);
	   /* execute query */
	   $stmt->execute();

	   /* Store the result (to get properties) */
	   $stmt->store_result();

	   /* Get the number of rows */
	   $num_of_rows = $stmt->num_rows;

	   /* Bind the result to variables */
	   $stmt->bind_result($pid, $passwd,$fname,$lname,$clubid,$role);
	   if(!($num_of_rows > 0)){
		die("That clubname could not be found!");
		}
                 
        while ($stmt->fetch()) {
               echo  "<tr></td>". $role. ": " . $fname . " ". $lname.  "</br></td></tr>";
		 }
}

$query1 = 'SELECT * FROM club natural join advisor_of natural join person where clubid =  ?';
	if($stmt = $mysqli->prepare($query1)){
	   
	   $stmt->bind_param('s',$clubid);
	   /* execute query */
	   $stmt->execute();

	   /* Store the result (to get properties) */
	   $stmt->store_result();

	   /* Get the number of rows */
	   $num_of_rows = $stmt->num_rows;

	   /* Bind the result to variables */
	   $stmt->bind_result($pid,$clubid,$cname,$descr, $passwd,$fname,$lname);
	   if(!($num_of_rows > 0)){
		die("That clubname could not be found!");
		}
                 
        while ($stmt->fetch()) {
               echo  "<tr></td>".  "Advisor: " . $fname . " ". $lname.  "</br></td></tr>";
		}
	}

   }

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
