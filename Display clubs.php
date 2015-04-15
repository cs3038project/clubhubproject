<?php
//connect to database
	$connection=mysqli_connect("localhost","root", "", "Clubhub");
	if(mysqli_connect_errno()){
		die("Database connection fail: ".mysqli_connect_error(). " (" .mysqli_connect_errno().")");
	}
?>
<?php
//create query
	$stmt = $connection->prepare("SELECT distinct cname, descr FROM club natural join club_topics WHERE topic=?");
	$stmt->bind_param("s", $_GET['topic']);
	$stmt->execute();
	$stmt->bind_result($cname, $descr);
?>
<html lang="en">
	<head>
		<title>Display Clubs</title>
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
		
   
	
	</head>
	<body>
		<div>
			<h1> Clubs with topic: <?php echo $_GET['topic'];?> </h1>
		</div>
		<?php
		//give all the clubs that relates to the topic that was passed by $_GET
			while($stmt->fetch()){
		?>
			
			<?php
				echo "Club name: " . $cname . "</br>";
				echo "Description: " . $descr;
				echo "<hr />";
			?>
			
		<?php
			};
			$stmt->close();
		?>
	</body>
</html>

<?php
	mysqli_close($connection);
?>
