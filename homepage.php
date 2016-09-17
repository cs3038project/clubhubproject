<!DOCTYPE HTML>
<?php
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {
	header ("Location: login.php");
}
//1. Create a database connection
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

?>
<?php
$userid= $_SESSION['userName'];

           $query1 = 'SELECT cname,descr FROM club natural join member_of where pid = (?)';

if($stmt = $mysqli->prepare($query1)){
   
   $stmt->bind_param('s',$userid);
   /* execute query */
   $stmt->execute();

   /* Store the result (to get properties) */
   $stmt->store_result();

   /* Get the number of rows */
   $num_of_rows = $stmt->num_rows;

   /* Bind the result to variables */
   $stmt->bind_result($clubname, $descr);

   

?>
<html>
<head>
<title>User Homepage</title>
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

	<body class="landing">
		<!-- Header -->
			<header id="header" class="alt">
				<h1><strong><a href="index.html"></a></strong> </h1>
				<nav id="nav">
					<ul>
						<li><a href="publicinfo.php">Public Info</a></li>
						<li><form action = "clubprofile.php" method = "GET"></li>
						<table>
					  <li><tr><td></td><td><input type= "text"  id = "clubname"name = "clubname" placeholder="search for a club" required /></td></tr></li>
	  				<li><tr><td><input type = "submit" id = "submit" name = "submit" value = "Find Club" ></td></tr></li>
					</table>
						
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
					<br><br><br><br>
				<h2>Welcome to your Clubhub homepage</h2>
				<ul class="actions">
				</ul>
			</section>

			<!-- One -->
				<section id="one" class="wrapper style1">
					<div class="container 75%">
						<div class="row 200%">
							<div class="6u 12u$(medium)">
								<header class="major">
									<h2>Your Clubs</h2>
							<?php
									while ($stmt->fetch()) { ?>
										<li><a href="clubprofile.php?clubname=<?php echo $clubname ?>"><?php  echo ' '.$clubname  ?></a></li>
									  <?php }

									   /* free results */
									   $stmt->free_result();
									  
									}
									}


										 ?>

								</header>
							</div>
						</div>
					</div>
				</section>
					
			
				<section id="two" class="wrapper style2 special">
					<div class="container">
						<header class="major">
							<h2></h2>
							<p>Get involved with club events</p>
						</header>
						<div class="row 150%">
						<ul class="actions">
							<li><a href="signuppage.php" class="button special big">Sign up for an event</a></li>
							<li><a href="viewmyevents.php" class="button special big">View My Events</a></li><br>
							<br><li><a href="postevent.php" class="button special big">Post New Event</a></li></br>
							<br><li><a href="postcomment.php" class="button special big">Post Comment</a></li>
							<li><a href="checkclubevent.php" class="button special big">Check Club events</a></li><br>
							<br><li><a href="logout.php" class="button big">logout</a></li>
						</ul>
					</div>
				</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						
					</ul>
					<ul class="copyright">
					</ul>
				</div>
			</footer>
</head>
<body>

   <br>
</body>
</html>
 
