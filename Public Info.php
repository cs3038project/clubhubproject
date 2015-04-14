<?php
//connect to database
	$connection=mysqli_connect("localhost","root", "", "clubhub");
	$connection2=mysqli_connect("localhost","root", "", "clubhub");
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
	</head>
	<body>
		<div>
			<h1> Club Topics </h1>
		</div>
		<?php
		//give each topic a link to a page with all the clubs relating to that topic
			while($topicList->fetch()){
		?>
			<a href="Display clubs.php?topic=<?php echo $topic;?>"><?php echo $topic; ?></a>
			<?php
				echo "<hr />";
			?>
		<?php
			};
			$topicList->close();
		?>
		<h3> Upcoming Public Event(s): </h3>
		<?php
			$publicEvent->execute();
			while($publicEvent->fetch()){
				echo $pEname;
			}
		?>
	</body>
</html>

<?php
	mysqli_close($connection);
?>
