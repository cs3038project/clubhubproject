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
						
						<li><a href="homepage.php">Home</a></li>
						<li><form action = "clubprofile.php" method = "GET"></li>
						<table>
					  <li><tr><td></td><td><input type= "text" id = "clubname"name = "clubname" placeholder="search for a club " required/></td></tr></li>
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
					<li><a href="login.php" class="button special big">Get Started</a></li>
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
			<li><a href="Display clubs.php?topic=<?php echo $topic;?>"><?php echo $topic; ?></a></li>
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

			<!-- Two 
				<section id="two" class="wrapper style2 special">
					<div class="container">
						<header class="major">
							<h2>Fusce ultrices fringilla</h2>
							<p>Club Topics</p>
						</header>
						<div class="row 150%">
							<div class="6u 12u$(xsmall)">
								<div class="image fit captioned">
									<img src="images/pic02.jpg" alt="" />
									<h3>Lorem ipsum dolor sit amet.</h3>
									
								</div>
							</div>
							<div class="6u$ 12u$(xsmall)">
								<div class="image fit captioned">
									<img src="images/pic03.jpg" alt="" />
									<h3>Illum, maiores tempora cupid?</h3>
								</div>
							</div>
						</div>
						<ul class="actions">
							<li><a href="#" class="button special big">Nulla luctus</a></li>
							<li><a href="#" class="button big">Sed vulputate</a></li>
						</ul>
					</div>
				</section> -->

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

			!-- Four 
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

		 Footer -->
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
