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
$userid= $_SESSION['userName']; 
$query1 = 'SELECT ename,description,edatetime,location FROM event natural join sign_up where pid = (?)';
$id = 5;

if($stmt = $mysqli->prepare($query1)){
   
   $stmt->bind_param('s',$userid);
   /* execute query */
   $stmt->execute();

   /* Store the result (to get properties) */
   $stmt->store_result();

   /* Get the number of rows */
   $num_of_rows = $stmt->num_rows;

   /* Bind the result to variables */
   $stmt->bind_result($ename, $description,$edatetime,$location);

  

        
   
   /* free results 
   $stmt->free_result();*/
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
   $stmt->bind_result($cname, $descr);

   

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







	<body class="landing">
		<!-- Header -->
			<header id="header" class="alt">
				<h1><strong><a href="index.html"></a></strong> </h1>
				<nav id="nav">
					<ul>
						<li><h2>Search for a club:</h2></li>
						<li><form action = "clubprofile.php" method = "GET"></li>
						<table>
					  <li><tr><td>Club:</td><td><input type= "text" id = "clubname"name = "clubname"></td></tr></li>
	  				<li><tr><td><input type = "submit" id = "submit" name = "submit" value = "Find Club" ></td></tr></li>
					</table>
						<!--<li><a href="signuppage.php">Sign up for an event</a></li>
						<li><a href="logout.php">logout</a></li>
						<li><a href="profileindex.php">search for a club profile</a>search</li>
						<li><a href="cosponsorpage.php">Add a co-sponsor for an event</a></li> -->
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
					<br><br>
				<h2>Welcome to your Clubhub homepage</h2>
				<!--<p>Lorem ipsum dolor sit amet nullam consequat <br /> interdum vivamus donce sed libero.</p>-->
				<ul class="actions">
					<!--<li><a href="#" class="button special big">Get Started</a></li> -->
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
									<ul>
									<li><a ><?php  echo ' '.$cname.' ' .$descr  ?></a></li>
									</ul>
									  <?php }

									   /* free results */
									   $stmt->free_result();

									   
									}
									}


										 ?>


									<li>             </li>
								</header>
							</div>
							<div class="6u$ 12u$(medium)">
								<h1>Your Upcoming Events</h1>
								<?php while ($stmt->fetch()) {
	 ?>
									<ul>
									<li><a ><?php  echo ' '.$ename.' ' .$description.' ' . $edatetime.' '.$location  ?></a></li>
									</ul>
								<?php } 
							/* close statement */
									   $stmt->close();
							/* close connection */
									$mysqli->close();
											?>
								
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
							

							<!--<div class="6u 12u$(xsmall)">
								<div  href= ""class="image fit captioned">
									<img src="images/pic02.jpg" alt="" />
									<h3>View My Events.</h3>
								</div> 
							</div>
							<div href= ".php" class="6u$ 12u$(xsmall)">
								<div class="image fit captioned">
									<img src="images/pic03.jpg" alt="" />
									<h3>Post New Event</h3>
								</div>
							</div>
							<div href= ".php" class="6u$ 12u$(xsmall)">
								<div class="image fit captioned">
									<img src="images/pic03.jpg" alt="" />
									<h3>Post Comment </h3>
								</div>
							</div>
							<div href= ".php" class="6u$ 12u$(xsmall)">
								<div class="image fit captioned">
									<img src="images/pic03.jpg" alt="" />
									<h3>Check Club events</h3>
								</div>
							</div>
						</div> -->
							
						
						<ul class="actions">
						<li><a href="signuppage.php" class="button special big">Sign up for an event</a></li>
						
							<li><a href="viewmyevents.php" class="button special big">View My Events</a></li><br>
							<br><li><a href="postevent.php" class="button special big">Post New Event</a></li></br>
							<br><li><a href="postcomment.php" class="button special big">Post Comment</a></li>
							<li><a href="checkclubevent.php" class="button special big">Check Club events</a></li>
							<li><a href="logout.php" class="button big"><h3>logout</h3></a></li>
						<!-- <li><a href="profileindex.php">search for a club profile</a>search</li>
						<li><a href="cosponsorpage.php">Add a co-sponsor for an event</a></li> -->
						</ul>
					</div>
				</section>

			<!-- Three 
				<section id="three" class="wrapper style1">
					<div class="container">
						<header class="major special">
							<h2>Mauris vulputate dolor</h2>
							<p>Feugiat sed lorem ipsum magna</p>
						</header>
						<div class="feature-grid">
							<div class="feature">
								<div class="image rounded"><img src="images/pic04.jpg" alt="" /></div>
								<div class="content">
									<header>
										<h4>Lorem ipsum</h4>
										<p>Lorem ipsum dolor sit</p>
									</header>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore esse tenetur accusantium porro omnis, unde mollitia totam sit nesciunt consectetur.</p>
								</div>
							</div>
							<div class="feature">
								<div class="image rounded"><img src="images/pic05.jpg" alt="" /></div>
								<div class="content">
									<header>
										<h4>Recusandae nemo</h4>
										<p>Ratione maiores a, commodi</p>
									</header>
									<p>Animi mollitia optio culpa expedita. Dolorem alias minima culpa repellat. Dolores, fuga maiores ut obcaecati blanditiis, at aperiam doloremque.</p>
								</div>
							</div>
							<div class="feature">
								<div class="image rounded"><img src="images/pic06.jpg" alt="" /></div>
								<div class="content">
									<header>
										<h4>Laudantium fugit</h4>
										<p>Possimus ex reprehenderit eaque</p>
									</header>
									<p>Maiores iusto inventore.</p>
								</div>
							</div>
							<div class="feature">
								<div class="image rounded"><img src="images/pic07.jpg" alt="" /></div>
								<div class="content">
									<header>
										<h4>Porro aliquam</h4>
										<p>Quaerat, excepturi eveniet laboriosam</p>
									</header>
									<p>Vitae earum unde, .</p>
								</div>
							</div>
						</div>
					</div>
				</section>

			<!-- Four 
				<section id="four" class="wrapper style3 special">
					<div class="container">
						<header class="major">
							<h2>Aenean elementum ligula</h2>
							<p>Feugiat sed lorem ipsum magna</p>
						</header>
						<ul class="actions">
							<li><a href="#" class="button special big">Get in touch</a></li>
						</ul>
					</div>
				</section>

		<!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						
					</ul>
					<ul class="copyright">
						<!--<a href="logout.php">logout</a>-->
					
					</ul>
				</div>
			</footer>
</head>
<body>




<?PHP //print $errorMessage;?>

   <br>
</body>
</html>
 
