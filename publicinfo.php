<?php

//connect to database
	$connection=mysqli_connect("localhost","root", "", "Clubhub");
	$connection2=mysqli_connect("localhost","root", "", "Clubhub");
	if(mysqli_connect_errno()){
		die("Database connection fail: ".mysqli_connect_error(). " (" .mysqli_connect_errno().")");
	}
?>
<?php
//create query
	$topicList = $connection->prepare("SELECT topic FROM club_topics ORDER BY topic");
	
	$topicList->execute();
	$topicList->bind_result($topic);

	$queryPublicEvent = "SELECT distinct ename FROM event WHERE is_public_e=1 and ";
	$queryPublicEvent.= "edatetime BETWEEN curdate() and (Curdate() + interval 3 day)";
	$publicEvent = $connection2->prepare($queryPublicEvent);
	$publicEvent->bind_result($pEname);
?>
<html lang="en">
	<head>
		<title>View Public Info</title>
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
		<div>
			<h1>  </h1>
		</div>
		
		<!-- Header -->
			<header id="header" class="alt">
				<h1><strong><a href="index.html"></a></strong> </h1>
				<nav id="nav">
					<ul>
						<li><a href="login.php">login</a></li>
						<li><a href="homepage.php">Home</a></li>
						<li><form action = "clubprofile.php" method = "GET"></li>
						<table>
					  <li><tr><td><input type= "text" id = "clubname"name = "clubname" placeholder="search for a club " required/></td></tr></li>
	  				<li><tr><td><input type = "submit" id = "submit" name = "submit" value = "Find Club" ></td></tr></li>
					</table>
					</ul>
				</nav>
			</header>

		<!-- Banner -->
			<section id="banner">
				<br><br>
				<h2>Clubhub</h2>
				<p>The club/event management website </p>
				<ul class="actions">
					<li><a href="#" class="button special big">Get Started</a></li>
				</ul>
			</section>

			<!-- One -->
				<section id="one" class="wrapper style1">
					<div class="container 75%">
						<div class="row 200%">
							<div class="6u 12u$(medium)">
								<header class="major">
									
									
<h3> Upcoming Public Event(s): </h3>
		<?php
			$publicEvent->execute();
			while($publicEvent->fetch()){
				echo $pEname;
			}
		?>
								</header>
							</div>
							<div class="6u$ 12u$(medium)">
								<h3>Club Topics</h3></br>
								<?php
		//give each topic a link to a page with all the clubs relating to that topic
			while($topicList->fetch()){
		?>
			<ul>
			<li><a href="displayclubs.php?topic=<?php echo $topic;?>"><?php echo $topic; ?></a></li>
			</ul>

			
			<?php
				echo "<hr />";
			?>
		<?php
			};
			$topicList->close();
		?>
		
							</div>
						</div>
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
	</body>
</html>

<?php
	mysqli_close($connection);
?>
