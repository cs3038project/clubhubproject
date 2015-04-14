<?php
//connect to database
	$connection=mysqli_connect("localhost","root", "", "clubhub");
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
